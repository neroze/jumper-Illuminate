<?php
namespace Jumper\Dashboard\Controllers;
use Illuminate\Http\Request;
use Illuminate\Response;
use Jumper\Response\Response as JResponse;
use Jumper\Core\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Jumper\Core\Helpers\Jumper;
use Jumper\Role\Role;
use Jumper\User\User;
use Illuminate\Support\Facades\Artisan;
use App\Mail\SendCertificateExpireEmail;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller{

     public function index(Request $request)
    {
    		$total_paid_amt = 0;
	    	$user = $request->user();
	  		$users_status = User::getUsers($user);
	  		$role  = [];
	        $roles_meta = User::roleMeta($user);
	        if($roles_meta){
	            foreach ($roles_meta as $key => $val) {
	                $role[] = $val->id;
	            }
	        }
    	
        if(!empty($role)){
            $role = Role::with('users') ->whereIn('id', $role)->get();
        }
    	
    		if($user->hasRole('root_admin')  ){
            if(!$total_balance = self::getCurrentStripeTotalBalace()){
                $total_balance = 0;
            }
            
        }
    	return view('dash::index', compact('role','users_status','user','total_balance','total_paid_amt'));
    }

    public static function getCurrentStripeTotalBalace()
    {
    	\Stripe\Stripe::setApiKey(self::getStripeKey());
    	return \Stripe\Balance::retrieve();
    }

    /**
     * Get the Stripe API key.
     *
     * @return string
     */
    public static function getStripeKey()
    {
        if ($key = getenv('STRIPE_SECRET')) {
            return $key;
        }

    }

    public static function getTotalPayedAmount($user)
    {
		    \Stripe\Stripe::setApiKey(self::getStripeKey());
		    if($user->stripe_id){
		    	$res = \Stripe\Customer::retrieve($user->stripe_id);
				$total_paid = 0;
		    	if($res){
		    		if(isset($res->subscriptions)){
		    		
		    			foreach ($res->subscriptions->data as $key => $val) {
		    				
		    					$total_paid += $val->plan->amount;

		    			}
		    			return $total_paid / 100;
		    		}
		    	}
		    }
	    	return 0;
    }


    public function allAbooutToExpireCertificates(Request $request,$due = false)
    {
        $user = $request->user();
        $about_to_expire_certificates = Training::allAbooutToExpireCertificates($user,$due);
        
        return view('site.training.about_to_expire_certificates',compact('about_to_expire_certificates'));
    }

    public function fireNotification()
    {
        $exitCode = Artisan::call('fdc:certificates', [
            '--sendEmail' => true
        ]);

        if($exitCode){
            JResponse::data(['stat' => true, 'data' => $exitCode ]);
        }

        JResponse::error(['stat' => false, 'data' => $exitCode ]);
    }

    public function sendNotificationToEducator(Request $request)
    {
        $data = $request->all();
        $data['training_title'] = $data['title'];
    
        $data['expire_date'] = Jumper::ausDate($data['expire_date']);
        $mail = Mail::to($data['educator_email'])->send(new SendCertificateExpireEmail($data));
        //$mail = Mail::to("neerooze@gmail.com")->send(new SendCertificateExpireEmail($data));

        return JResponse::data('Email Sent');
    }
}