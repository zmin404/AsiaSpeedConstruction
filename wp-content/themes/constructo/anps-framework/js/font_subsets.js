"use strict";
jQuery(document).ready(function($) { 
    /* Selecting google fonts and showing subsets/variantions */    
    $('#font_type_1').change(function() {
        fonts_subsets("1");
    });
    $('#font_type_2').change(function() {
        fonts_subsets("2");
    });
    $('#font_type_navigation').change(function() {
        fonts_subsets("navigation");
    });
});

function fonts_subsets(index) {    
    var data = {
         'action': 'font_subsets',
         'font_value': $("#font_type_"+index).val()
     };
    jQuery.post(ajax_font_object.ajax_font_url, data, function(data) {  
            if(data == 0) { 
                $("#font_subsets_"+index).empty();
            } else { 
                $("#font_subsets_"+index).empty(); 
                $.each($.parseJSON(data), function(i, item) { 
                    $('#font_subsets_'+index).append("<input type='checkbox' name='font_type_"+index+"_subsets[]' value='"+item+"'>"+item+"<br />");                    
                });
            }
     }); 
}