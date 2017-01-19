(function($){

	var wrapper = $('.rmd-gallery-wrapper.lightbox');
	var imageLink = wrapper.find('.image-link');
	var lightboxModal = $('.ligtbox-modal');
	var lightboxModalBackdrop = $('.ligtbox-modal-backdrop');
	var parentWrapper = '';

	function openModal() {
		lightboxModal.show(); 
		lightboxModalBackdrop.show();
	}

	function closeModal() {
	  	lightboxModal.hide();
	  	lightboxModalBackdrop.hide();
	}
  
	function plusSlides(number) {
		if(parentWrapper != '') {
			showSlides(parentWrapper, slideIndex += number);
		}
	}

	function currentSlide(parentWrapper, number) {
	  	showSlides(parentWrapper, slideIndex = number);
	}

	function showSlides(parentWrapper, index) { 

	  	var items = parentWrapper.find('.item-container');
	  	var modalCaption = lightboxModal.find('.caption');
	  	var modalNumberText = lightboxModal.find('.number-text');
	  	var modalImage = lightboxModal.find('.image');

	  	var itemsLen = items.length; 

	  	if (index > itemsLen) {slideIndex = 1}
	  	if (index < 1) {slideIndex = itemsLen}
	   
	  	var imageSrc = items.eq(slideIndex-1).data('image'); 
	  	var imageCaption = items.eq(slideIndex-1).data('caption'); 
	  	var imageNum = items.eq(slideIndex-1).data('number'); 
 	 

 		var numberTextLabel = imageNum+' / '+itemsLen;
	  	modalNumberText.html(numberTextLabel);
	  	modalCaption.html(imageCaption);
	  	modalImage.attr('src',imageSrc); 
 		modalImage.attr('alt',imageCaption); 
	} 

	lightboxModalBackdrop.find('.close').on('click', function(){
		closeModal();
	});

	lightboxModalBackdrop.on('click', function(){
		closeModal();
	});
	 
	lightboxModal.find('.prev').on('click', function(){
		plusSlides(-1)
	});

	lightboxModal.find('.next').on('click', function(){
		plusSlides(1)
	});


	imageLink.on('click', function(e){
		e.preventDefault();
		parentWrapper = $(this).closest('.rmd-gallery-wrapper'); 
		
		if(lightboxModal.length) {
			var number = $(this).find('.item-container').data('number'); 
			openModal();
			currentSlide(parentWrapper, number);  
		}  
	});



})(jQuery)
