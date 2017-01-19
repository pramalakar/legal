<?php 
namespace theme\rmd\core\helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

 
class RMD_File_Download 
{

	/**
	 * Force download - this is the default method.
	 *
	 * @param  string $file_path
	 * @param  string $filename
	 */
	public static function download_file_force( $file_path ) 
	{
		$path_parts = pathinfo($file_path);
 		$filename = $path_parts['basename'];
 		
		$parsed_file_path = self::parse_file_path( $file_path );

		self::download_headers( $parsed_file_path['file_path'], $filename );

		if ( ! self::readfile_chunked( $parsed_file_path['file_path'] ) ) {
			self::download_error( __( 'File not found' ) );
		}
		exit;
	}

	/**
	 * Parse file path and see if its remote or local.
	 *
	 * @param  string $file_path
	 * @return array
	 */
	public static function parse_file_path( $file_path ) 
	{
		$wp_uploads     = wp_upload_dir();
		$wp_uploads_dir = $wp_uploads['basedir'];
		$wp_uploads_url = $wp_uploads['baseurl'];

		// Replace uploads dir, site url etc with absolute counterparts if we can
		$replacements = array(
			$wp_uploads_url                  => $wp_uploads_dir,
			network_site_url( '/', 'https' ) => ABSPATH,
			network_site_url( '/', 'http' )  => ABSPATH,
			site_url( '/', 'https' )         => ABSPATH,
			site_url( '/', 'http' )          => ABSPATH
		);

		$file_path        = str_replace( array_keys( $replacements ), array_values( $replacements ), $file_path );
		$parsed_file_path = parse_url( $file_path );
		$remote_file      = true;

		// See if path needs an abspath prepended to work
		if ( file_exists( ABSPATH . $file_path ) ) {
			$remote_file = false;
			$file_path   = ABSPATH . $file_path;

		// Check if we have an absolute path
		} elseif ( ( ! isset( $parsed_file_path['scheme'] ) || ! in_array( $parsed_file_path['scheme'], array( 'http', 'https', 'ftp' ) ) ) && isset( $parsed_file_path['path'] ) && file_exists( $parsed_file_path['path'] ) ) {
			$remote_file = false;
			$file_path   = $parsed_file_path['path'];
		}

		return array(
			'remote_file' => $remote_file,
			'file_path'   => $file_path
		);
	}
 

 	/**
	 * Set headers for the download.
	 *
	 * @param  string $file_path
	 * @param  string $filename
	 * @access private
	 */
	private static function download_headers( $file_path, $filename ) 
	{
		self::check_server_config();
		self::clean_buffers();
		nocache_headers();

		header( "X-Robots-Tag: noindex, nofollow", true );
		header( "Content-Type: " . self::get_download_content_type( $file_path ) );
		header( "Content-Description: File Transfer" );
		header( "Content-Disposition: attachment; filename=\"" . $filename . "\";" );
		header( "Content-Transfer-Encoding: binary" );

        if ( $size = @filesize( $file_path ) ) {
        	header( "Content-Length: " . $size );
        }
	}



	/**
	 * readfile_chunked.
	 *
	 * Reads file in chunks so big downloads are possible without changing PHP.INI - http://codeigniter.com/wiki/Download_helper_for_large_files/.
	 *
	 * @param   string $file
	 * @return 	bool Success or fail
	 */
	public static function readfile_chunked( $file ) 
	{
		$chunksize = 1024 * 1024;
		$handle    = @fopen( $file, 'r' );

		if ( false === $handle ) {
			return false;
		}

		while ( ! @feof( $handle ) ) {
			echo @fread( $handle, $chunksize );

			if ( ob_get_length() ) {
				ob_flush();
				flush();
			}
		}

		return @fclose( $handle );
	}


	/**
	 * Die with an error message if the download fails.
	 *
	 * @param  string $message
	 * @param  string  $title
	 * @param  integer $status
	 * @access private
	 */
	private static function download_error( $message, $title = '', $status = 404 ) 
	{
		if ( ! strstr( $message, '<a ' ) ) {
			$message .= ' <a href="' . esc_url( home_url() ) . '" class="wc-forward">' . __( 'Go to homepage', 'woocommerce' ) . '</a>';
		}
		wp_die( $message, $title, array( 'response' => $status ) );
	}
  

	/**
	 * Get content type of a download.
	 * @param  string $file_path
	 * @return string
	 * @access private
	 */
	private static function get_download_content_type( $file_path ) 
	{
		$file_extension  = strtolower( substr( strrchr( $file_path, "." ), 1 ) );
		$ctype           = "application/force-download";

		foreach ( get_allowed_mime_types() as $mime => $type ) {
			$mimes = explode( '|', $mime );
			if ( in_array( $file_extension, $mimes ) ) {
				$ctype = $type;
				break;
			}
		}

		return $ctype;
	}


	/**
	 * Check and set certain server config variables to ensure downloads work as intended.
	 */
	private static function check_server_config() 
	{
		if ( function_exists( 'set_time_limit' ) && false === strpos( ini_get( 'disable_functions' ), 'set_time_limit' ) && ! ini_get( 'safe_mode' ) ) {
			@set_time_limit( 0 );
		}
		if ( function_exists( 'get_magic_quotes_runtime' ) && get_magic_quotes_runtime() && version_compare( phpversion(), '5.4', '<' ) ) {
			set_magic_quotes_runtime( 0 );
		}
		if ( function_exists( 'apache_setenv' ) ) {
			@apache_setenv( 'no-gzip', 1 );
		}
		@ini_set( 'zlib.output_compression', 'Off' );
		@session_write_close();
	}

	/**
	 * Clean all output buffers.
	 *
	 * Can prevent errors, for example: transfer closed with 3 bytes remaining to read.
	 *
	 * @access private
	 */
	private static function clean_buffers() 
	{
		if ( ob_get_level() ) {
			$levels = ob_get_level();
			for ( $i = 0; $i < $levels; $i++ ) {
				@ob_end_clean();
			}
		} else {
			@ob_end_clean();
		}
	}

	 

	
} // end of RMD_File_Download


