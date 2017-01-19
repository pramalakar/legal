<?php 
namespace theme\rmd\core\helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

 
class RMD_Date
{    
	private static $default_timezone = 'Asia/Manila';


    /**
     *  get_current_date - this will get the current date based on the set timezone.
     *
     *  @return date    Current data.   
     */
    public static function get_current_date()
    {
        date_default_timezone_set(self::$default_timezone);
        return date('Y-m-d H:i:s');
    }

	
	public static function convert_date_format($date, $cur_format, $new_format)
    {
        date_default_timezone_set(self::$default_timezone);

        $delimeter  = $cur_format[1];
        $first_char = $cur_format[0];

        $arr_date = explode($delimeter,$date);

        $month = ($first_char == 'Y' || $first_char == 'y')? $arr_date[1] : $arr_date[0];
        $day   = ($first_char == 'Y' || $first_char == 'y')? $arr_date[2] : $arr_date[1];
        $year  = ($first_char == 'Y' || $first_char == 'y')? $arr_date[0] : $arr_date[2];
     
        return date($new_format, mktime(0,0,0,$month,$day,$year)); // h,mn,s,m,d,y
         
    }


    public static function convert_date_string($date)
    {
        date_default_timezone_set(self::$default_timezone);

        $arr_date = explode('-',$date);

        $month = $arr_date[1];
        $day   = $arr_date[2];
        $year  = $arr_date[0];
     
        return date('F d, Y', mktime(0,0,0,$month,$day,$year)); 
    }
     

    public static function convert_time_format($time, $format)
    {
        date_default_timezone_set(self::$default_timezone);

        if($format == 12){ 
            return DATE("g:i A", STRTOTIME($time)); // 24 to 12 
        } else { 
            return DATE("H:i", STRTOTIME($time));   // 12 to 24
        } 
    }


    public static function create_date_string($date) 
    {
        date_default_timezone_set(self::$default_timezone);

    	$date_created = date_create($date);
		return date_format($date_created,"F d, Y @ h:i A");   
    }

} // end of RMD_Date
	 

 