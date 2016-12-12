<?php

namespace Jumper\Response;

class Response
{
	public static function error($data='')
	{
		return array('stat'=> false , "msg" => $data);
	}

	public static function data($data='')
	{
		return array('stat'=> true, "data" => $data);
	}
}
