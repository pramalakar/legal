<?php    
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 
 
class RMD_Resposive_Helper {

	public static function get_column_classes( $num ) 
	{ 
		switch ($num) {
		 	case 1:
		 		return 'col-xs-12';
		 		break;
		 	case 2:
		 		return 'col-xs-12 col-sm-6';
		 		break;
		 	case 3:
		 		return 'col-xs-12 col-sm-4 col-md-4';
		 		break;
		 	case 4:
		 		return 'col-xs-12 col-sm-6 col-md-3';
		 		break;
		 	case 6:
		 		return 'col-xs-6 col-sm-4 col-md-2';
		 		break;
		 	default:
		 		return;
		 		break;
		} 
	}


	public static function get_column_xs_class( $num ) 
	{ 
		return self::_get_column_class( 'xs', $num );
	}


	public static function get_column_md_class( $num ) 
	{ 
		return self::_get_column_class( 'md', $num ); 
	}


	public static function get_column_sm_class( $num ) 
	{ 
		return self::_get_column_class( 'sm', $num ); 
	}


	public static function get_column_lg_class( $num ) 
	{ 
		return self::_get_column_class( 'lg', $num ); 
	}


	private static function _get_column_class( $type, $num ) 
	{ 
		switch ($num) {
		 	case 1:
		 		return 'col-'.$type.'-12';
		 		break;
		 	case 2:
		 		return 'col-'.$type.'-6';
		 		break;
		 	case 3:
		 		return 'col-'.$type.'-4';
		 		break;
		 	case 4:
		 		return 'col-'.$type.'-3';
		 		break;
		 	case 6:
		 		return 'col-'.$type.'-2';
		 		break;
		 	default:
		 		return;
		 		break;
		} 
	}

}