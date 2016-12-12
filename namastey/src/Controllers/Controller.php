<?php

namespace Jumper\Namstey\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use App\Http\Controllers\Traits\FileUploadTrait;

class Controller extends BaseController
{
		public $data = [];
    //use AuthorizesRequests, DispatchesJobs, ValidatesRequests, FileUploadTrait;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
