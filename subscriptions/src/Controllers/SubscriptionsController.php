<?php

namespace Jumper\Subscriptions\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Jumper\Subscriptions\Subscription;
use Jumper\User\User;
use Jumper\Core\Controllers\Controller;

class SubscriptionsController extends Controller
{

    /**
     * Instantiate a new new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['access_only_if_rool_as:root_admin']);
    }
    
    public function index(Request $request)
    {
        $user = $request->user();
        if(!$user->hasRole('root_admin') && !$user->hasRole('admin')){
            abort(403);
        }
        return view('jumperSubscriptions::index');
    }

    public function allOrders()
    {  
        $orders = Subscription::with('user')->orderBy('id',"desc")->get();
        return $orders;
    }

}
