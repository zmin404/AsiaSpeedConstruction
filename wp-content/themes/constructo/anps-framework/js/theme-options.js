"use strict";

jQuery(document).ready(function($) {
    /* Menu type */
    $('.onoff').hide();
    $('#headerstyle > label > input').change(function() {
        if($(this).is(':checked')) {
            var get_id_to_show = '.' + $(this).closest("label").attr("id");
            //alert (get_id_to_show);
            $('.onoff').hide(100);
            //alert (get_id_to_show);
            $(get_id_to_show).show(200);
            }
    }).change();


    $('#auto_adjust_logo').change(function() {
        if($(this).is(':checked')) {
            $('.onoff').hide(100);
            }
            else {
                $('.onoff').show(100);
            }
    }).change();

$('#custom-header-bg-vertical-wrap').hide;
    $('.vertical-menu-switch').change(function() {
        if($(this).is(':checked')) {
                $('#custom-header-bg-vertical-wrap').show(100);
            }
            else {
                $('#custom-header-bg-vertical-wrap').hide(100);
            }
    }).change();

    $(".style-images").each(function( index ) {
        if( $("input[type=radio]").eq(index).is(':checked')) {
            $(".style-images").eq( index ).css({
                "border":"2px solid #2187c0",
                "cursor":"default"
            });
        }
    });

    $(".style-images").click(function(){

        $("input[type=radio]").eq( $(this).index(".style-images") ).click();

        $(".style-images").each(function( index ) {
            $(".style-images").eq( index ).css({
                "border":"2px solid #efefef",
                "cursor":"pointer"
            });
        });

        $(this).css({
            "border":"2px solid #2187c0",
            "cursor":"default"
        });
    });

    $(window).on('scroll', function(){
       var ScrollTop = $(window).scrollTop();
       $('.submit-right button.fixsave').css('transform', 'translateY(' + ( ScrollTop + 100 )+ 'px)');
    })

    $('.envoo-dummy input.dummy').on('click', function(e) {
        if ($('.demo-twice').length) {
            var reply = confirm(anps.dummy_text);

            if (reply) {
                $('.absolute.fullscreen.importspin').addClass('visible');
            }

            return reply;
        } else {
            $('.absolute.fullscreen.importspin').addClass('visible');
        }
    });

    if( $('#copy-clipboard').length ) {
        /* Copy to clipboard */
        var clipboard = new Clipboard('#copy-clipboard');
    }

    $('.has-preview').on('change', function () {
        var $preview = $('[data-preview="' + $(this).attr('id') + '"]');
        var src = $(this).val();
        if (src !== '') {
            $preview.removeClass('hidden');
            $preview.html('<img src="' + $(this).val() + '" />');
        } else {
            $preview.addClass('hidden');
            $preview.html('');
        }
    });
});
