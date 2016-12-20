<?php

namespace App\Http\Middleware;

use Closure;
use Log;
use Auth;

class AccessOnlyIfRoolAs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {
        $user = $request->user();
        $role = explode("|", $role);
        if(Auth::check()){
            if($user->isImpersonating()){
                if($user->hasRole('educator') || $user->hasRole("coordinator")){
                    return redirect('/');
                }
            } else if (!$request->user()->hasRole($role)) {
                $user = $request->user();
                Log::warning("ID : ".$user->id." | Name : ".$user->name." | "." Email : ".$user->email." tried to Access to Unauthorized link : ".$request->fullUrl());
                return abort(403, 'Unauthorized action.');

            }
        }
        
        return $next($request);
       
    }
}
