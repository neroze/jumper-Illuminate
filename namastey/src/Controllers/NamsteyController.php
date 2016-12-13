<?php

namespace Jumper\Namstey\Controllers;

use Jumper\Response\Response as JResponse;

class NamsteyController extends Controller
{
    public function hi()
    {
        return JResponse::data('Hi');

        return view('namastey::index');
    }

    public function hello()
    {
        return JResponse::data('Hello');
    }
}
