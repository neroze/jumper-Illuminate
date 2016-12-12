<?php
namespace Jumper\Core\Helpers;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

/**
*
*/
class Jumper
{
	public static function validate($data, $rules){
        $validator = Validator::make($data, $rules );
        if($validator->fails()){
            throw new \Exception( json_encode( $validator->errors()->all() ));
        }
    }

    public static function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
	}

    public static function ausDate($date='', $withTime = true)
    {
        if($withTime){
            return Carbon::createFromFormat('Y-m-d g:i:s', $date)->format('d/m/Y');
        }else{
            return Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
        }
    }
}