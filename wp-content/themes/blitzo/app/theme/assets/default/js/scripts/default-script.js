(function($){
 	
 	/**
 	 *	Since I cannot manipute the style of the comment form, I just manage it through
 	 *	javascript to set a particular bootstrap classes.
 	 */
    $('.comment-form').find('input[type="text"]').addClass('form-control'); 
    $('.comment-form').find('input[type="email"]').addClass('form-control'); 
    $('.comment-form').find('input[type="url"]').addClass('form-control'); 
    $('.comment-form').find('textarea').addClass('form-control'); 
    $('.comment-form').find('input[type="submit"]').addClass('btn btn-primary');


    
    /**
     *	This will manage the opened dropdown menu to be closed
     * 	once an scroll event has been triggered.
     */
    window.addEventListener('scroll', function(e) { 
        $('.navbar-collapse').removeClass('in');
        $('.dropdown').removeClass('open');
    });


    $('a[href="' + location.href + '"]').closest('li').addClass('active');
 

})(jQuery);
