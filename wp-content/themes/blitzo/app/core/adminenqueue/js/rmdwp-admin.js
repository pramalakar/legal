
/**
 *	This is intended for the color picker 1
 *	-----------------------------------------
 */
jQuery(document).ready(function($){

	 $('.rmd-color-picker').each(function(index, element) {
		var $el = $(this);			
		var myOptions = {
			
			defaultColor: $el.data('std'),
			change: function(event, ui){},
			clear: function() {},
			hide: true,
			palettes: true
		};
		 
		$el.wpColorPicker(myOptions);
	});

});




/**
 *	This is intended for the color picker 2
 *	-------------------------------------------
 */ 
jQuery(document).ready(function($){ 
   
    $(".rmd-color-picker-2").on("focus", function(){

    	var colorPicker = $(".rmd-color-picker-cp-2"); 
	    colorPicker.hide();

    	var newColorPicker = $(this).siblings(".rmd-color-picker-cp-2");
    	newColorPicker.farbtastic(this);
        newColorPicker.show(); 

    });

    $(".rmd-color-picker-2").on("blur", function(){

    	var colorPicker = $(".rmd-color-picker-cp-2"); 
	    colorPicker.hide();

        if($(this).val() == "") $(this).val("#"); 

    }); 

});




/**
 *	This is intended for the media uploader
 *	-------------------------------------------
 */
jQuery(document).ready(function($){
 
	$('body .rmdwp-media-wrapper').on('click', '.rmdwp-upload-media', function(e){
		e.preventDefault();

		var mediaUploader; 
		var $this = $(this);
		var removeCaption = $this.siblings('.rmdwp-hidden-input-remove-caption').val();
		 
		if( mediaUploader ) {
			mediaUploader.open();
			return;
		} 

		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: $this.siblings('.rmdwp-media-modal-heading').val(),
			button: {
				text: $this.siblings('.rmdwp-media-modal-button').val()
			},
			multiple: false
		});

		mediaUploader.on('select', function(){
			attachment = mediaUploader.state().get('selection').first().toJSON();
			$this.siblings('.rmdwp-hidden-input').val(attachment.url);
			$this.siblings('.rmdwp-media-container').empty().append('<img src="'+attachment.url+'" />');
			$this.after('<a href="#" class="rmdwp-remove-media">'+removeCaption+'</a>');  
			$this.remove();
		});

		mediaUploader.open(); 
	});


	$('body .rmdwp-media-wrapper').on('click', '.rmdwp-remove-media', function(e){
		e.preventDefault();
		var $this = $(this);
		var uploadCaption = $this.siblings('.rmdwp-hidden-input-upload-caption').val();
 
		$this.siblings('.rmdwp-hidden-input').val(''); 
		$this.siblings('.rmdwp-media-container').empty();

		$this.after('<a href="#" class="rmdwp-upload-media">'+uploadCaption+'</a>');  
		$this.remove();
	});

});



/**
 *	This is intended for the file uploader
 *	------------------------------------------
 */
jQuery(document).ready(function($){
 
	$('body').on('click', '.rmdwp-upload-file', function(e){
		e.preventDefault();

		var fileUploader; 
		var $this = $(this);
		var removeCaption = $this.siblings('.rmdwp-hidden-input-remove-caption').val();
		 
		if( fileUploader ) {
			fileUploader.open();
			return;
		} 

		fileUploader = wp.media.frames.file_frame = wp.media({
			title: $this.siblings('.rmdwp-file-modal-heading').val(),
			button: {
				text: $this.siblings('.rmdwp-file-modal-button').val()
			},
			multiple: false
		});

		fileUploader.on('select', function(){
			attachment = fileUploader.state().get('selection').first().toJSON();
			$this.siblings('.rmdwp-hidden-input').val(attachment.url);
			$this.siblings('.rmdwp-file-container').empty().append('<div>'+attachment.url+'</div>');
			$this.after('<a href="#" class="rmdwp-remove-file btn btn-danger btn-block">'+removeCaption+'</a>');  
			$this.remove();
		});

		fileUploader.open(); 
	});


	$('body').on('click', '.rmdwp-remove-file', function(e){
		e.preventDefault();
		var $this = $(this);
		var uploadCaption = $this.siblings('.rmdwp-hidden-input-upload-caption').val();
 
		$this.siblings('.rmdwp-hidden-input').val(''); 
		$this.siblings('.rmdwp-file-container').empty();

		$this.after('<a href="#" class="rmdwp-upload-file btn btn-success btn-block">'+uploadCaption+'</a>');  
		$this.remove();
	});

});