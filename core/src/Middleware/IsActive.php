<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        if ($user->status == 0) {
            Auth::logout();
            return redirect('/user-inactive');
        }
        else if($user->status == 2){

           $url = $request->url();
            if(strpos( $url,"user/account") > 0 
                || strpos( $url,"user/subscribe") > 0 
                || strpos( $url,"user/process-subscription") 
                || strpos( $url,"users/stop-impersonate") ){
            }else{
                return redirect('/upgrade-account');
            }
           
        }else if($user->status == 1){
            $url = $request->url();
            if(strpos( $url,"user/account") > 0 
                || strpos( $url,"user/subscribe") > 0 
                || strpos( $url,"user/process-subscription") 
                || strpos( $url,"users/stop-impersonate") ){
                //echo "Yes upgrade page";
            }else if($user->trial_ends_at != null && Carbon::now()  > $user->trial_ends_at ){
                return redirect('/trail-ends');
            }else if(!$user->subscribed('main')){
                if($user->trial_ends_at != null && Carbon::now()  < $user->trial_ends_at ){

                }else {
                    return redirect('/invalid-subscription');
                }
            }
        }
        return $next($request);
    }
}
