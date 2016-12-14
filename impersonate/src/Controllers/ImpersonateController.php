<?php
//http://blog.mauriziobonani.com/easily-impersonate-any-user-in-a-laravel-application/

namespace Jumper\Impersonate\Controllers;

use Illuminate\Http\Request;
use Jumper\Response\Response as JResponse;
use Jumper\Core\Controllers\Controller;
use Jumper\Core\Helpers\Jumper;
use Jumper\User\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Jumper\Mail\QuickMessage;

class ImpersonateController extends Controller
{
	
  public function impersonate(Request $request,$id)
	{
			$session_user = $request->user();
	    $user = User::find($id);
	    if ($user->status == 0) {
          return redirect('/user-inactive');
      }
	    // Guard against administrator impersonate
	    if(! $user->hasRole('root_admin'))
	    {
	    	if($session_user->hasRole('admin')){
	    		Auth::user()->setImpersonating($user->id);
	    	}else if($session_user->hasRole('company') ){
	    		if(User::doesBelongsToCompany($user->id)){
	    				Auth::user()->setImpersonating($user->id);
	    		}
	    	}else{
	    		return redirect()->back();
	    	}
	    }
	    else
	    {
	    	//TODO: fire event to send alert Message
	    	$action = new \stdClass();
	    	$action->subject = "Ilegal Impersonate Action ";
	    	$action->msg = "Ilegal Impersonate Action By User ID : ".$session_user->id.", Email : ".$session_user->email.", Name : ".$session_user->name;
	    	Mail::to(config('app.admin_main', 'neerooze@gmail.com') )->send(new QuickMessage($action));
	    	
	    	$session_user->status = 0;
	    	$session_user->save();

	    	return redirect('/ilegal-action');
	    	
	    }

	    return redirect()->back();
	}

	public function stopImpersonate()
	{
	    Auth::user()->stopImpersonating();

	    //flash()->success('Welcome back!');

	    return redirect('/');
	}
}
