jQuery(document).ready(function( $ ) {
	
	$("#is-boxed").bind("click", function(){
		if ( $("#is-boxed").is(':checked') ) {
			
			$("#pattern-select-wrapper").show();
			if ($(".admin-patern-select img#selected-pattern").index() == 0) {
				$("#patern-type-wrapper, #custom-patern-wrapper").show();
			}
			
		} else {
			$("#pattern-select-wrapper").hide();
			$("#patern-type-wrapper, #custom-patern-wrapper").hide();
		}
	}); 
	
	$(".admin-patern-select img").bind("click", function() {
		$(".admin-patern-radio input").eq($(this).index()).click();
		
		$(".admin-patern-select img").removeAttr("id");
		$(this).attr("id", "selected-pattern");
		
		if ( $(this).index() == 0 ) {
			$("#patern-type-wrapper, #custom-patern-wrapper").show();
		} else {
			$("#patern-type-wrapper, #custom-patern-wrapper").hide();
		}
		
	});
	$(".patern-type input").change(function() {
		if( $(this).val() == "custom color" ) {
			$("#custom-patern-wrapper").hide();
			$("#custom-background-color-wrapper").show();
		} else {
			$("#custom-patern-wrapper").show();
			$("#custom-background-color-wrapper").hide();
		}
	});
});