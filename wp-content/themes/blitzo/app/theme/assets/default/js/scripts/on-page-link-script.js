(function($){ 

	if($('a[href^="#"]').length) {
		$('a[href^="#"]').click(function(event) {
			var id = $(this).attr("href");
			var offset = 80;
			if($(id).length) {
				var target = $(id).offset().top - offset;
				$('html, body').animate({scrollTop:target}, 500);
			} 
			event.preventDefault();
		});  
	} 

})(jQuery);

