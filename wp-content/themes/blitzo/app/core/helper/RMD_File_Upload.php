<?php
namespace theme\rmd\core\helper;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 *  The class RMD_File_Upload will manage the file upload, validate them and save it into the wp database tables.
 */
/***
 *  HOW TO USE:
  
      $post_id = $_POST['post_id']; 
      $new_attr = array(
          'parent_post_id' => $post_id,
          'allowed_types' => array('doc', 'xls', 'ppt', 'docx', 'xlsx', 'pptx', 'pdf', 'jpeg', 'pjg', 'gif', 'png', 'csv'),
          'max_size' => 5 //mb
      ); 
      RMD_File_Upload::upload('my_folder_name_uploads', $new_attr);
      
      In view:
  
      RMD_File_Upload::display_validation_alert(); // to display the alert message.
   
 */

 
class RMD_File_Upload
{  

    /** 
     *  $default_attr - the property attribute that will be used upon file uploading process.
     *
     *  @key    string      input_name - the file input name.
     *  @key    integer     parent_post_id - the post id which you want the attachment depends on.
     *  @key    array       allowed_types - the file types that only be accepted during the uploadin process.
     *                          Office 2007 (docx, xlsx, pptx)
     *                          Office 97-2003 (doc, xls, ppt)
     *                          Other (pdf, jpeg, pjg, gif, png, csv)
     *  @key    integer     max_size - this will determine the maximum file size allowed (megabytes)
     */
    protected static $default_attr = array(
        'input_name' => '',
        'parent_post_id' => 0,
        'allowed_types' => array(),
        'max_size' => null 
    );


    /** 
     *  $upload_dir - the directory name where the file will be uploaded.
     */
    protected static $upload_dir = 'rmd_uploads'; // default value



    /** 
     *  The main method that manage the file uploading process.
     *
     *  @param  string      $upload_dir - the custom directory name where the file will be uploaded.
     *  @param  array       $new_attr - the custom attributes that will serve as a basis of file uploading process.
     *  @return void
     */
	public static function upload($upload_dir, $new_attr = array())
    {   
        self::$upload_dir = $upload_dir;

        $attr = array_merge(self::$default_attr, $new_attr);
         
        if( empty($attr['input_name'])) return;

        if ( isset($_FILES[$attr['input_name']]) ) 
        {   
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            require_once( ABSPATH . 'wp-admin/includes/media.php' );

            $files = $_FILES[$attr['input_name']];

            // The ID of the post this attachment is for.
            $parent_post_id = $attr['parent_post_id']; 
            $count = 0;  
            $error_count = 0;
            $success_count = 0;

            $validation_message = array();
            $have_error = FALSE;

            if( empty($files['name'][0]) ) {
                $have_error = TRUE;
                $validation_message[] = 'The input file is required';
            }

            foreach ($files['name'] as $count => $value) 
            {   
                if ($files['name'][$count]) {  

                    $file = array(
                        'name'     => $files['name'][$count],
                        'type'     => $files['type'][$count],
                        'tmp_name' => $files['tmp_name'][$count],
                        'error'    => $files['error'][$count],
                        'size'     => $files['size'][$count]
                    ); 

                    $valid_file = TRUE;

                    $is_file_already_exist = self::_is_file_already_exist($file['name']);
                    if( $is_file_already_exist ) { 
                        $validation_message[] = 'The '.$file['name'].' already exist.';
                        $valid_file = FALSE;
                        $have_error = TRUE;
                    } 

                    // Validate the file
                    $is_allowed_file_type = self::_is_allowed_file_type($file['name'], $attr['allowed_types']);
                    if( $is_allowed_file_type == FALSE) {
                        $validation_message[] = 'The '.$file['name'].' does not have an allowed file type.';
                        $valid_file = FALSE;
                        $have_error = TRUE;
                    } 

                    $is_allowed_file_size = self::_is_allowed_file_size($file['size'], $attr['max_size']);
                    if( $is_allowed_file_size == FALSE) {
                        $validation_message[] = 'The '.$file['name'].' already exceeded the maximum file size.';
                        $valid_file = FALSE;
                        $have_error = TRUE;
                    }

                    if( $have_error ) {
                        $error_count++;
                    } else {
                        $success_count++;
                    }

                    if( $valid_file ) {
                        $upload = self::_save_uploaded_file_into_dir($file);  
                        if( $upload ) {
                            $attach_id = self::_save_uploaded_file_as_post_attachment($upload['file'], $parent_post_id); 
                            self::_save_uploaded_file_attachment_metadata($attach_id, $upload['file']);
                        } 
                    }  
                }

                $count++; 

            } 
            
            if($success_count == $count) {
                $success_message = array('The file(s) was successfully uploaded.');
                self::set_validation_alert($success_message, 'success');
            } elseif($error_count == $count) {
                self::set_validation_alert($validation_message, 'error');
            } else {
                $success_message = array('Some of the file(s) was successfully uploaded.');
                $alert_messages = array_merge($success_message, $validation_message);
                self::set_validation_alert($alert_messages, 'info');
            }
            
        }
    }


    /**
     *  This method will manage to check if the file already exist.
     *
     *  @param  string      $filename - the filename of the uploaded file usualy grabbed from the $_FILES['input_name']['name'].
     *  @return boolean     Return true if exist otherwise false.
     */
    protected static function _is_file_already_exist($filename)
    {    
        //$filename = str_replace(' ', '-', $filename); 
        $filename = sanitize_file_name( $filename ); 
        // sanitize_file_name is a wp function
        $file_path = self::_get_upload_dir_path().'/'.$filename;
        return (file_exists($file_path))? TRUE : FALSE;
    }


    /**  
     *  This method will check if the upload directory has already been created otherwise it will create a new one 
     *  based on the custom directory name.
     *
     *  @return string      return the relative path of the custom root directory which will besed on $upload_dir.
     */
    protected static function _get_upload_dir() 
    { 
        $upload_dir = self::$upload_dir; 
        /*
        Return of wp_upload_dir()
        array (
            'path' => string 'C:\wamp\www\rmdwriter/wp-content/uploads/2016/07' (length=48)
            'url' => string 'http://localhost/rmdwriter/wp-content/uploads/2016/07' (length=53)
            'subdir' => string '/2016/07' (length=8)
            'basedir' => string 'C:\wamp\www\rmdwriter/wp-content/uploads' (length=40)
            'baseurl' => string 'http://localhost/rmdwriter/wp-content/uploads' (length=45)
            'error' => boolean false
        );
        */
        $upload = wp_upload_dir();
        $upload_basedir = $upload['basedir'];
        $upload_new_dir = $upload_basedir.'/'.$upload_dir;
        if (! is_dir($upload_new_dir)) {
            $mkdir = mkdir( $upload_new_dir, 0755 );
            return ( $mkdir )? $upload_dir : FALSE; 
        }

        return $upload_dir;
    }


    /**
     *  This method will manage to set a custom directory to set on the 'upload_dir' filter hook.
     *  The data within it will be used on wp_upload_dir() function and also basis of wp_handle_upload().
     *
     *  @param  array   $upload - the attribute came from the 'upload_dir' hook of wp.
     *  @return array   Return the customized upload data attribute.
     *                  For instance:
     *                  array (
     *                       'path' => string 'C:\wamp\www\rmdwriter/wp-content/uploads/2016/07' (length=48)
     *                       'url' => string 'http://localhost/rmdwriter/wp-content/uploads/2016/07' (length=53)
     *                       'subdir' => string '/2016/07' (length=8)
     *                       'basedir' => string 'C:\wamp\www\rmdwriter/wp-content/uploads' (length=40)
     *                       'baseurl' => string 'http://localhost/rmdwriter/wp-content/uploads' (length=45)
     *                       'error' => boolean false
     *                   );
     */
    public static function manage_custom_upload_dir($upload) 
    {  
        $upload_dir = self::$upload_dir; 

        $upload['subdir']   = '/'.$upload_dir.$upload['subdir'];
        $upload['path']     = $upload['basedir'].$upload['subdir'];
        $upload['url']      = $upload['baseurl'].$upload['subdir'];
        return $upload;
    }


    /**
     *  This method will manage to grab the upload directory path.
     *  Form instance: 'C:\wamp\www\rmdwriter/wp-content/uploads/2016/07'
     *
     *  @return string      Return the upload directory path - 'C:\wamp\www\rmdwriter/wp-content/uploads/2016/07'.
     */
    protected static function _get_upload_dir_path()
    {  
        add_filter('upload_dir', array("\\theme\\rmd\\core\\helper\\RMD_File_Upload",'manage_custom_upload_dir'), 10, 1); 
        $wp_upload_dir = wp_upload_dir();  
        $upload_dir_path = $wp_upload_dir['path'];
        remove_filter('upload_dir', array("\\theme\\rmd\\core\\helper\\RMD_File_Upload",'manage_custom_upload_dir'), 10, 1);
        return $upload_dir_path;
    }


    /**
     *  This method will manage to grab the upload directory url.
     *  Form instance: ''http://localhost/rmdwriter/wp-content/uploads/2016/07''
     *
     *  @return string      Return the upload directory url - ''http://localhost/rmdwriter/wp-content/uploads/2016/07''.
     */
    protected static function _get_upload_dir_url()
    { 
        add_filter('upload_dir', array("\\theme\\rmd\\core\\helper\\RMD_File_Upload",'manage_custom_upload_dir'), 10, 1); 
        $wp_upload_dir = wp_upload_dir();  
        $upload_dir_url = $wp_upload_dir['url'];
        remove_filter('upload_dir', array("\\theme\\rmd\\core\\helper\\RMD_File_Upload",'manage_custom_upload_dir'), 10, 1);
        return $upload_dir_url;
    }


    /**
     *  This method will manage to check if the file has an allowed file type.
     *
     *  @param  string      $filename - the filename of the uploaded file.
     *  @param  array       $allowed_type - the list of allowed firl types. Ex. array('doc', 'xls', 'ppt')
     *  @return boolean     Return true if the file has an allowed file type otherwise false.
     */
    protected static function _is_allowed_file_type($filename, $allowed_types)
    {
        if( empty($allowed_types) ) return TRUE;

        $file_type = pathinfo($filename,PATHINFO_EXTENSION); 
        return (in_array($file_type, $allowed_types))? TRUE : FALSE; 
    }  


    /**
     *  This method will manage to check if the file has an allowed file size.
     *
     *  @param  intger      $file_size - the file size of the uploaded file.
     *  @param  intger      $max_size - the maximum allowed file size. (megabytes)
     *  @return boolean     Return true if the file has an allowed file size otherwise false.
     */
    protected static function _is_allowed_file_size($file_size, $max_size)
    {   
        if( empty($max_size) ) return TRUE;

        $max_size_in_bytes = $max_size * 1000000; 
        return ($file_size > $max_size_in_bytes)? FALSE : TRUE;
    } 



    /**
     *  This method will manage to save the uploaded file into the custom directory.
     *
     *  @param  array           $file - the file data attribute.
     *                          $file = array(
     *                               [name] => Array ( [0] => sherry-research-paperpresidential-elections.docx ) 
     *                               [type] => Array ( [0] => application/vnd.openxmlformats-officedocument.wordprocessingml.document )
     *                               [tmp_name] => Array ( [0] => C:\wamp\tmp\php3236.tmp )
     *                               [error] => Array ( [0] => 0 )
     *                               [size] => Array ( [0] => 18215 ) 
     *                              ) 
     *  @return array|boolean   Return array if success otherwise false.
     *                          array (
     *                              [file] => C:\wamp\www\rmdwriter/wp-content/uploads/2016/07/sherry-research-paperpresidential-elections.docx
     *                              [url] => http://localhost/rmdwriter/wp-content/uploads/2016/07/sherry-research-paperpresidential-elections.docx
     *                              [type] => application/vnd.openxmlformats-officedocument.wordprocessingml.document
     *                          )
     *
     */
    protected static function _save_uploaded_file_into_dir($file)
    {  
        add_filter('upload_dir', array("\\theme\\rmd\\core\\helper\\RMD_File_Upload",'manage_custom_upload_dir'), 10, 1);
        $wp_upload_dir = wp_upload_dir(); 
        
        $upload_overrides = array( 'test_form' => false ); 

        /*
        Return of wp_handle_upload()
        array (
            [file] => C:\wamp\www\rmdwriter/wp-content/uploads/2016/07/sherry-research-paperpresidential-elections.docx
            [url] => http://localhost/rmdwriter/wp-content/uploads/2016/07/sherry-research-paperpresidential-elections.docx
            [type] => application/vnd.openxmlformats-officedocument.wordprocessingml.document
        )
        */   
        $movefile = wp_handle_upload( $file, $upload_overrides );
        if ( $movefile && ! isset( $movefile['error'] ) ) {
            //echo "File is valid, and was successfully uploaded.\n";
            //var_dump( $movefile );
            remove_filter('upload_dir', array("\\theme\\rmd\\core\\helper\\RMD_File_Upload",'manage_custom_upload_dir'), 10, 1);
            return $movefile;
        } else {
            /**
             * Error generated by _wp_handle_upload()
             * @see _wp_handle_upload() in wp-admin/includes/file.php
             */
            //echo $movefile['error'];
            return false;
        }
    }


    /**
     *  This method will manage to save the uploaded file as post attachment in wp posts table.
     *
     *  @param  string          $filename - the file name of the uploaded file.
     *  @param  integer         $parent_post_id - the post id where you want the attachment to depends on.
     *  @return int|boolean     Return the attachment post id if success otherwise false.
     */
    protected static function _save_uploaded_file_as_post_attachment($filename, $parent_post_id)
    {
        // Check the type of file. We'll use this as the 'post_mime_type'.
        // Retrieve the file type from the file name.
        // Return: array( ['ext'] - Extension (eg 'jpg') ['type'] - Mime Type (eg 'image/jpeg') )
        $filetype = wp_check_filetype( basename( $filename ), null ); 
        $guid = self::_get_upload_dir_url().'/'.basename( $filename );

        // Prepare an array of post data for the attachment.
        $attachment = array(
            'guid'           => $guid,
            'post_mime_type' => $filetype['type'],
            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );

        // Insert the attachment.
        // Returns the resulting post ID (int) on success or 0 (int) on failure.
        $response = wp_insert_attachment( $attachment, $filename, $parent_post_id );
        if( $response > 0 ) {
            return $response;
        } else {
            return FALSE;
        }

    }



    /**
     *  This method will manage to save the uploaded file attachment metadata.
     *
     *  @param  interger    $attach_id - the attachment post id.
     *  @param  string      $filename - the file name of the uploaded file.
     *  @return boolean     Return the value from the update_post_meta().   
     *                          update_post_meta() - Returns meta_id if the meta doesn't exist, otherwise returns true on success and false on failure. 
     *                          NOTE: If the meta_value passed to this function is the same as the value that is already in the database, 
     *                          this function returns false. 
     */
    protected static function _save_uploaded_file_attachment_metadata($attach_id, $filename)
    {
        // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
        require_once( ABSPATH . 'wp-admin/includes/image.php' );

        // Generate the metadata for the attachment, and update the database record.
        $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );

        //Returns value from update_post_meta()
        // update_post_meta() - Returns meta_id if the meta doesn't exist, otherwise returns true on success and false on failure. 
        // NOTE: If the meta_value passed to this function is the same as the value that is already in the database, 
        // this function returns false.
        return wp_update_attachment_metadata( $attach_id, $attach_data );
    }

    
    /**
     *  This method will manage to set the alert message within the $_SESSION variable for later use 
     *  of 'display_validation_alert' method.
     *
     *  @param  array       $messages - the custom alert messages.
     *  @param  string      $type - the type will determine the mode of the alert message, if it is an error or success mode.
     *  @return void
     */
    protected static function set_validation_alert(array $messages = array(), $type = 'success')
    {
        $_SESSION['rmd_file_upload_alert'] = array( 'messages'=> $messages, 'type'=> $type);
    }


    /**
     *  This method will manage to display the alert messages based on the $_SESSION['rmd_file_upload_alert'] variable.
     *  
     *  @return void.
     */
    public static function display_file_upload_alert() 
    {
        if( ! isset($_SESSION['rmd_file_upload_alert'])) return;

        $messages = $_SESSION['rmd_file_upload_alert']['messages'];
        $type     = $_SESSION['rmd_file_upload_alert']['type'];

        $css_class = '';

        if($type == 'success') {
            $css_class = 'woocommerce-message';
        }elseif($type == 'error') {
            $css_class = 'woocommerce-error';
        }elseif($type == 'info') {
            $css_class = 'woocommerce-info';
        }
        
        $li_str = '';
        foreach ($messages as $key => $value) {
            $li_str .= '<li>'.$value.'</li>';
        }
        ?>
        <ul class="<?php echo $css_class; ?>">
            <?php echo $li_str; ?>
        </ul> 
        <?php 

        unset($_SESSION['rmd_file_upload_alert']);
    }  

}
	 


