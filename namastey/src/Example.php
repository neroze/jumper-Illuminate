<?php

namespace Jumper\Namstey;

// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Auth\AuthenticationException;
// use Illuminate\Notifications\Notifiable;
// use Zizaco\Entrust\Traits\EntrustUserTrait;
// use Laravel\Cashier\Billable;
use Illuminate\Support\Facades\Auth;

class Example //extends Authenticatable
{
    // use Notifiable;
 //  use EntrustUserTrait;
 //  use Billable;

   public function test()
   {
       $user = Auth::user();
       dd($user);

       return  $user;
   }
}
