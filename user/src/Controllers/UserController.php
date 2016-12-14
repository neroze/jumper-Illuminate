<?php

namespace Jumper\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Response;
use Jumper\Response\Response as JResponse;
use Jumper\Core\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Jumper\Core\Helpers\Jumper;
use Jumper\User\User;
use Jumper\User\Subscription;
use Illuminate\Support\Facades\Mail;
use Jumper\Mail\ThankyouMessage;

use Laravel\Cashier\Cashier;

class UserController extends Controller
{
    public function __construct($value = '')
    {
        //$this->middleware(['access_only_if_rool_as:root_admin|admin|company|compay_admin']);
    }

    public function index()
    {
        return view('jumperUser::index');
    }

    public function addNewUser(Request $request)
    {
        return User::save_user($request);
    }

    public function updateUser(Request $request, $id)
    {
        return User::save_user($request, $id);
    }

    public function allUsers(Request $request)
    {
        $user = $request->user();
        $users = User::getUsers($user);
        $role_meta = User::roleMeta($user);

        return JResponse::data(['role_meta' => $role_meta, 'users' => $users]);
    }

    public function deleteUser($id = '')
    {
        if (!Auth::user()->hasRole('root_admin')) {
            return JResponse::error('You do not have permission to delete user.');
        }
        $user = User::find(intval($id));
        if ($user) {
            $user->delete();
        }
        return JResponse::data('deleted');
    }

    public function updateUserStatus($id = '')
    {
        $user = User::find(intval($id));
        if ($user && !$user->hasRole('root_admin')) {
            if ($user->status == 1) {
                $user->status = 0;
            } else {
                $user->status = 1;
            }
            $user->save();
        }
        return JResponse::data($user);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            // verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }

    public function account()
    {
        $user = Auth::user();

        // $subscription = $user->subscription('main')->asStripeSubscription();

        // dd($subscription = $user->subscription('main')->user_id);

        // $subscription = $user->subscription('main')->asStripeSubscription();

        // $amount = $subscription->plan->amount;

        // echo Cashier::formatAmount(1000.00);

        // dd($subscription);

        // $invoices = $user->invoices();

        // $amount = number_format($amount / 100, 2);
        //

        return view('jumperUser::account', ['user' => $user]);
    }

    public function subscribe()
    {
        return view('jumperUser::subscribe');
    }

    public function process_subscription(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();
        if ($user->subscribed('main')) {
            return redirect(env('APP_PREFIX', 'jumper').'/user/account')->withMessage('You are already subscribed.');
            exit;
        }

        try {
            if ($user_subscription = $user->newSubscription('main', 'basic')->create($input['stripeToken'], ['email' => Auth::user()->email])) {
                $user = User::find($user_subscription->user_id);
                $subscription = $user->subscription('main')->asStripeSubscription();

                //$user_subscription = Subscription::where('stripe_id', $subscription->id)->first();
                $user_subscription->amount = $subscription->plan->amount;
                $user_subscription->amount_format = Cashier::formatAmount($user_subscription->amount);
                $user_subscription->subscription_ends_at = date('Y-m-d H:i:s', $subscription->current_period_end);

                $user_subscription->save();
                $user->status = 1;
                $user->trial_ends_at = null;
                $user->save();

               // email to user
                $message = 'Thank you so much for subscribing with our system. ';
                Mail::to($user->email)->send(new ThankyouMessage());
                // email to admin
                $message = 'We have new Subscription from '.$user->name.' ( '.$user->email.' ) ';
                Mail::to(config('app.admin_main', 'neerooze@gmail.com'))->send(new ThankyouMessage($message));

                return redirect(env('APP_PREFIX', 'jumper').'/user/account')->withMessage('You are succesfully subscribed.');
            }
        } catch (Exception $e) {
            return redirect(env('APP_PREFIX', 'jumper').'/user/subscribe')->withMessage('Something went wrong');
        }
        exit;
    }

    public function cancel_subscription(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();

        if ($user->subscribed('main')) {
            $user->subscription('main')->cancel();
            // Email to user
            $message = 'Your Subscription has been cancelled, Thank you for you using our system. ';
            Mail::to($user->email)->send(new ThankyouMessage());
            // Email to admin
            $message = 'Subscription cancelled by '.$user->name.' ( '.$user->email.' ) ';
            Mail::to(config('app.admin_main', 'neerooze@gmail.com'))->send(new ThankyouMessage($message));
            return redirect('admin/user/account')->withMessage('Your subscription is cancelled.');
            exit;
        }

        return redirect(env('APP_PREFIX', 'jumper').'/user/account');
        exit;
    }

    public function resume_subscription(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();
        if ($user->subscription('main')->cancelled()) {
            $user->subscription('main')->resume();
            // Email to user
            $message = 'Your Subscription has been resumed, Thank you for you using our system. ';
            Mail::to($user->email)->send(new ThankyouMessage());
            // Email to admin
            $message = 'Subscription Resumed been resumed by '.$user->name.' ( '.$user->email.' ) ';
            Mail::to(config('app.admin_main', 'neerooze@gmail.com'))->send(new ThankyouMessage($message));

            return redirect(env('APP_PREFIX', 'jumper').'/user/account')->withMessage('Your subscription is resumed succesfully.');
            exit;
        }

        return redirect(env('APP_PREFIX', 'jumper').'/user/account');
        exit;
    }

    public function saveProfilePic(Request $request)
    {
        $dir = 'profile_pic';
        $file = $this->saveFiles($request, $dir);
        if (!empty($file)) {
            return JResponse::data(User::saveProfilePic($file['file_name'], $request->educator_id));
        }

        return JResponse::error('File was not saved.');
    }

    public static function deleteProfilePic(Request $request)
    {
        $user = User::find($request->educator_id);
        $dir = 'uploads/profile_pic/';
        if (User::deleteFiles($user->profile_pic, $dir)) {
            $user->profile_pic = '';
            $user->save();
            return JResponse::data('Profile Image Deleted.');
        }
        return JResponse::error('Error while deleting profile Image.');
    }
}
