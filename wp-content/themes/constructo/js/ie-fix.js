jQuery(function($){
    $(".persons li:nth-of-type(3n)").css("margin-right", "0");
    $(".posts li:nth-of-type(4n)").css("margin-right", "0");
    $(".logos li:first").css("border", "none");
    $('input[type="text"]').each(function(index){
        $('input[type="text"]').eq(index).val($('input[type="text"]').eq(index).attr("placeholder"));
    });
    $('textarea').each(function(index){
        $('textarea').eq(index).val($('textarea').eq(index).attr("placeholder"));
    });
    $('input[type="text"], textarea').on("focus", function(){
        if( $(this).val() == $(this).attr("placeholder") ) {
            $(this).val("");
        }
    });
});