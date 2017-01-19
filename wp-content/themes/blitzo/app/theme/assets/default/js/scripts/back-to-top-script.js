(function($){ 
	
	var backToTop = $('.back-to-top'); 

	backToTop.click(scrollTop);

	manageBackToTopButton();
    window.addEventListener('scroll', function(e) { 
        manageBackToTopButton();
    });
            	
    function manageBackToTopButton() {
    	var distanceY = window.pageYOffset || document.documentElement.scrollTop;
		 
	    if(distanceY > 200) {
	 		showBackToTopButton(); 
	 	} else {
	 		hideBackToTopButton(); 
	 	} 
    }

    function scrollTop(e) {
    	e.preventDefault();
		$("html, body").animate({scrollTop:0},500);
    }

    function showBackToTopButton() {
    	backToTop.show();
    }

    function hideBackToTopButton() {
    	backToTop.hide();
    } 

})(jQuery);