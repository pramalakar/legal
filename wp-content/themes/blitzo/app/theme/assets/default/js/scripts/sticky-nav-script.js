(function($){ 
	 
	var body = $('body'),
        header = $('.header-wrapper'),
        navbar = $('.navbar');

	manageNavbar();
    window.addEventListener('scroll', function(e) { 
        manageNavbar();
    });
      
    function manageNavbar() {
    	var distanceY = window.pageYOffset || document.documentElement.scrollTop;
		 
	    if(distanceY > 200) { 
	 		setStickyNavbar();
	 	} else {
	 		setNonStickyNavbar();	 		
	 	} 
    } 

    function setStickyNavbar() {  
    	header.addClass('header-fixed-top'); 
        navbar.addClass('navbar-fixed-top'); 
    }

    function setNonStickyNavbar() {  
        header.removeClass('header-fixed-top'); 
    	navbar.removeClass('navbar-fixed-top');
    } 


    navbar.find('.dropdown-menu').find('.active').closest('.dropdown').addClass('active');
    

})(jQuery);