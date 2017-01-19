/**
 *	CONTACT FORM VALIDATOR SCRIPT
 *	--------------------------------
 */

var ContactFormValidator = function () {
  	
  	var contactForm = $('#rmdContactForm');
  	var alertContainer = contactForm.find('#rmdAlertContainer');

	var validateForm = function () { 

		contactForm.validate({ 
			focusInvalid: false,
			onfocusout: false,
      		onkeyup: false,
			rules: {
				rmd_cf_name: {
					required: {
				        depends:function(){
				            $(this).val($.trim($(this).val()));
				            return true;
				        }
				    },
				},  
				rmd_cf_email: {
					required: {
				        depends:function(){
				            $(this).val($.trim($(this).val()));
				            return true;
				        }
				    },
				    email: true
				},    
			},
			errorClass: "text-danger invalid",
    		errorElement: "em",
			messages: { 
				rmd_cf_name: {
					required: '<strong>Name</strong> is a required field.',
				},  
				rmd_cf_email: {
					required: '<strong>Email Address</strong> is a required field.',
					email: '<strong>Email Address</strong> field requires a valid email address',
				} 
			}, 		
			success: function(label, element) {  
			 	var formGroup = $(element).closest('.form-group'); 
				formGroup.removeClass('has-error').addClass('has-success'); 
			}, 
		    highlight: function(element) {   // <-- fires when element has error
			    $(element).closest('.form-group').removeClass('has-success').addClass('has-error'); 
			},
			unhighlight: function(element) { // <-- fires when element is valid
			    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); 
			},
			invalidHandler: function(e,validator) {

				// This part is a way of adding css class error to a particulat input. 
		    	$('.form-group').removeClass('has-error');

			    //validator.errorList contains an array of objects, where each object has properties "element" and "message".  element is the actual HTML Input.
			    for (var i=0;i<validator.errorList.length;i++){
			    	var obj = validator.errorList[i]; 
			    	var formGroup = $(obj.element).closest('.form-group'); 

			    	formGroup.addClass('has-error'); 
			    }
			    // orderFormErrorContainer.offset().top - 60
 				$('html,body').animate({ scrollTop: alertContainer.offset().top - 150 }, 'slow');
			},
			showErrors: function(errorMap, errorList) { 

				// This is where i iterate all the error messages and place it in the particular container. 
				if($.isEmptyObject(errorMap) === false) {
					alertContainer.empty();
					var alertHtml = '<div class="rmd-cf-alert alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><div class="errors"></div></div>';
					alertContainer.append(alertHtml);
	                $.each(errorMap, function(fieldName, errMsg) {
	                	alertContainer.find('.rmd-cf-alert').find('.errors').append('<p>'+errMsg+'</p>');
	                });
				}
                
            },   
			submitHandler: function(form) {  
				form.submit();
			}
		});

	}
	 

	return {

		init: function () {     
			validateForm();  
		},
 
	}

}();

jQuery(document).ready(function() { 
    ContactFormValidator.init();
});  

 
 