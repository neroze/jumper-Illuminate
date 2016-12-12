<?php

namespace Jumper\Core\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Jumper\Core\Helpers\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Auth;
use Jumper\Core\Helpers\Jumper;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, FileUploadTrait;
    // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // 
    public function __construct()
    {
    	
    // /	$this->data['user'] = $user->user();

			
    }
}
