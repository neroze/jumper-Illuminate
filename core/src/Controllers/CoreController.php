<?php

namespace Jumper\Core\Controllers;

use Illuminate\Support\Facades\Auth;
use Jumper\Core\Helpers\Jumper;

class CoreController extends Controller
{
    public static $data;

    public static function init()
    {
        if (Auth::check()) {
            self::$data['user'] = Auth::user();
            if (self::$data['user']->profile_pic) {
                self::$data['avator'] = '/uploads/profile_pic/'.self::$data['user']->profile_pic;
            } else {
                self::$data['avator'] = Jumper::get_gravatar(self::$data['user']->email);
            }
        }
    }

    public function dash()
    {
        // /self::init();
        $data = self::$data;

        return view('jumperCore::index', compact('data'));
    }
}
