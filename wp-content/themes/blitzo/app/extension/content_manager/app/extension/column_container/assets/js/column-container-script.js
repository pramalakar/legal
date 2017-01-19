
(function($){

	var columnType = $('#rmd_cc_metabox_column_type');
	var columnTypeValue = columnType.val();

	showColumsContentMetabox(columnTypeValue);

	columnType.on('change', function(){ 
		var columnTypeValue = $(this).val();
		showColumsContentMetabox(columnTypeValue); 
	});


	function hideAllCustomColumnContentMetabox() {

		$('#rmd_cc_column_metabox_id2').hide();
		$('#rmd_cc_metabox_column_2_container_style').hide();

		$('#rmd_cc_column_metabox_id3').hide();
		$('#rmd_cc_metabox_column_3_container_style').hide();

		$('#rmd_cc_column_metabox_id4').hide();
		$('#rmd_cc_metabox_column_4_container_style').hide();

	}

	function showAllCustomColumnContentMetabox() {

		$('#rmd_cc_column_metabox_id2').show();
		$('#rmd_cc_metabox_column_2_container_style').show();

		$('#rmd_cc_column_metabox_id3').show();
		$('#rmd_cc_metabox_column_3_container_style').show();

		$('#rmd_cc_column_metabox_id4').show();
		$('#rmd_cc_metabox_column_4_container_style').show();

	}


	function showSpecificColumnContentMetabox(num) {

		$('#rmd_cc_column_metabox_id'+num).show();
		$('#rmd_cc_metabox_column_'+num+'_container_style').show(); 

	}


	function showColumsContentMetabox(columnTypeValue) {

		var num = 1;

		hideAllCustomColumnContentMetabox();

		switch (columnTypeValue) {
			case '1col':
			default:
				num = 1;
				break;
			case '2col':
			case '123col':
			case '213col':
			case '134col': 
			case '314col': 
				num = 2;
				break; 
			case '3col':
				num = 3;
				break; 
			case '4col':
				num = 4;
				break;   
		}
 
		switch (num) { 
			case 2:  
				showSpecificColumnContentMetabox(2);
				break; 
			case 3: 
				showSpecificColumnContentMetabox(2);
				showSpecificColumnContentMetabox(3);
				break; 
			case 4:
				showSpecificColumnContentMetabox(2);
				showSpecificColumnContentMetabox(3);
				showSpecificColumnContentMetabox(4);
				break;   
		}
		
	}


})(jQuery);