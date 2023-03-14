jQuery(document).ready(function( $ ) {
    var currentlyClickedElement = '';

    $('.color-pick-color').bind("click", function(){
        currentlyClickedElement = this;
    });

    $('.color-pick-color').ColorPicker({
        onSubmit: function(hsb, hex, rgb, el) {
            $(el).css("background","#"+hex);
            $(el).attr("data-value", "#"+hex);
            $(el).parent().children(".color-pick").val("#"+hex);
            $(el).ColorPickerHide();
        },
        onBeforeShow: function () {
            $(this).ColorPickerSetColor($(this).attr("data-value"));
        },
        onChange: function (hsb, hex, rgb) {
            $(currentlyClickedElement).css("background","#"+hex);
            $(currentlyClickedElement).attr("data-value", "#"+hex);
            $(currentlyClickedElement).parent().children(".color-pick").val("#"+hex);
            liveButtons($(currentlyClickedElement).parents('.input').find('[data-button]').data('button'));
        }
    })
    .bind('keyup', function(){
        $(this).ColorPickerSetColor(this.value);
    });


    $('.color-pick').on('keyup', function(){
        $(this).parent().children(".color-pick-color").css("background", $(this).val());
        liveButtons($(this).parents('.input').find('[data-button]').data('button'));
    });

    /* Button live change */

    function liveButtonsPrep() {
        $('[data-button]').each(function() {
            $('body').append('<style id="anps-btn-style--' + $(this).data('button') + '"></style>');
        });
    }
    liveButtonsPrep();

    function changeButton(selector, bgColor, color, bgColorHover, colorHover, borderColor, borderColorHover) {
        var styles = '';
        if (bgColor !== undefined) {
            styles += 'background-color: ' + bgColor + ' !important;';
        }
        styles += 'color: ' + color + ' !important;';
        if (borderColor !== undefined) {
            styles += 'border: 2px solid ' + borderColor + ' !important;';
        }

        var stylesHover = '';
        if (bgColorHover !== undefined) {
            stylesHover += 'background-color: ' + bgColorHover + ' !important;';
        }
        stylesHover += 'color: ' + colorHover + ' !important;';
        if (borderColorHover !== undefined) {
            stylesHover += 'border: 2px solid ' + borderColorHover + ' !important;';
        }

        $('#anps-btn-style--' + selector).append('body .btn.btn--' + selector + ' { ' + styles + ' }');
        $('#anps-btn-style--' + selector).append('body .btn.btn--' + selector + ':hover, body .btn.btn--' + selector + ':focus { ' + stylesHover + ' }');
    }

  	function liveButtons(button) {
        liveButtonsPrep();

        $('#anps-btn-style--' + button).empty();

        var bgColor = $('[data-bg=' + button + ']').next().val();
        var color = $('[data-color=' + button + ']').next().val();
        var bgColorHover = $('[data-bgHover=' + button + ']').next().val();
        var colorHover = $('[data-colorHover=' + button + ']').next().val();
        var borderColor = $('[data-border=' + button + ']').next().val();
        var borderColorHover = $('[data-borderHover=' + button + ']').next().val();

        changeButton(button, bgColor, color, bgColorHover, colorHover, borderColor, borderColorHover);
  	}

    window.anpsGetColors = function() {
        var allColors = [];

        $('.color-pick').each(function() {
            allColors.push($(this).val());
        });

        console.log(allColors);
    };

    // 17 - var default = new Array("" , "", "", "", "", "");
    var default_val = ["#727272", "#292929", "#d54900", "#000000", "#d54900", "", "", "", "#0f0f0f", "#c1c1c1", "#f9f9f9", "#ffffff", "#fff", "#000", "#d54900", "#000", "#d54900", "#ffffff", "", "", "#f8f8f8", "#292929", "#242424", "#d9d9d9", "#fff", "#fff", "#d54900", "#3a3a3a", "#d9d9d9", "#0f0f0f", "#030303", "#ffffff", "#d54900", "#ffffff", "#292929", "#fff", "#d54900", "#fff", "#d54900", "#fff", "#000000", "#fff", "#ffffff", "#ffffff", "#242424", "#ffffff", "#d54b00", "#242424", "#d54b00", "#fff", "#242424", "#fff", "#c3c3c3", "#fff", "#737373", "#fff"];
    var yellow = ["#727272", "#292929", "#f9e60d", "#000000", "#f9e60d", "", "", "", "#0f0f0f", "#c1c1c1", "#f9f9f9", "#ffffff", "#fff", "#000", "#f9e60d", "#000", "#f9e60d", "#ffffff", "", "", "#f8f8f8", "#292929", "#242424", "#d9d9d9", "#fff", "#fff", "#f9e60d", "#3a3a3a", "#d9d9d9", "#0f0f0f", "#030303", "#ffffff", "#f9e60d", "#ffffff", "#292929", "#fff", "#f9e60d", "#fff", "#d54900", "#fff", "#000000", "#fff", "#ffffff", "#ffffff", "#242424", "#ffffff", "#f9e60d", "#242424", "#f9e60d", "#fff", "#242424", "#fff", "#c3c3c3", "#fff", "#737373", "#fff"];
    var blue = ["#727272", "#292929", "#3aaedf", "#000000", "#3aaedf", "", "", "", "#0f0f0f", "#c1c1c1", "#f9f9f9", "#ffffff", "#fff", "#000", "#3aaedf", "#000", "#3aaedf", "#ffffff", "", "", "#f8f8f8", "#292929", "#242424", "#d9d9d9", "#fff", "#fff", "#3aaedf", "#3a3a3a", "#d9d9d9", "#0f0f0f", "#030303", "#ffffff", "#3aaedf", "#ffffff", "#292929", "#fff", "#3aaedf", "#fff", "#3aaedf", "#fff", "#000000", "#fff", "#ffffff", "#ffffff", "#242424", "#ffffff", "#3aaedf", "#242424", "#3aaedf", "#fff", "#242424", "#fff", "#c3c3c3", "#fff", "#737373", "#fff"];
    var green = ["#727272", "#292929", "#43b425", "#000000", "#43b425", "", "", "", "#0f0f0f", "#c1c1c1", "#f9f9f9", "#ffffff", "#fff", "#000", "#43b425", "#000", "#43b425", "#ffffff", "", "", "#f8f8f8", "#292929", "#242424", "#d9d9d9", "#fff", "#fff", "#43b425", "#3a3a3a", "#d9d9d9", "#0f0f0f", "#030303", "#ffffff", "#43b425", "#ffffff", "#292929", "#fff", "#43b425", "#fff", "#43b425", "#fff", "#000000", "#fff", "#ffffff", "#ffffff", "#242424", "#ffffff", "#43b425", "#242424", "#43b425", "#fff", "#242424", "#fff", "#c3c3c3", "#fff", "#737373", "#fff"];

    $("#predefined_colors label").bind("click", function(){
        var table;
        switch($('input', this).val()) {
            case "default" :
                table = default_val;
                break;
            case "yellow" :
                table = yellow;
                break;
            case "blue" :
                table = blue;
                break;
            case "green" :
                table = green;
                break;
        }
        $(".color-pick").each(function(index){
            $(".color-pick").eq(index).val(table[index]);
            $(".color-pick").eq(index).parent().children(".color-pick-color").css("background", table[index]);
            $(".color-pick").eq(index).parent().children(".color-pick-color").attr("data-value", table[index]);
        });
    });
    $(".input-type").change(function(){
        if($(this).val() == "dropdown") {
            $(this).parent().parent().children(".validation").hide();
            $(this).parent().parent().children(".label-place-val").children("label").html("Values");
        }
        else {
            $(this).parent().parent().children(".validation").show();
            $(this).parent().parent().children(".label-place-val").children("label").html("Placeholder");
        }
    });
});
