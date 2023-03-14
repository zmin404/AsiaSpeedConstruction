"use strict";
jQuery(document).ready(function($) {
	/*hiding display_meta_box_heading() function*/
	$('.showhide').hide();

	if ($('.hideall-trigger').is(':checked')) {
		$('.hideall').hide();
	}

	if ($('.showhide-trigger').is(':checked')) {
		$('.showhide').show();
	}

	$('.showhide-trigger').click(function() {
		if ($('.showhide-trigger').is(':checked')) {
			$('.showhide').show();
		}
		else {
			$('.showhide').hide();
		}
	});

	$('.hideall-trigger').click(function() {
		if ($('.showhide-trigger').is(':checked')) {
			$('.showhide-trigger').prop('checked', false);
		}

		if ($('.hideall-trigger').is(':checked')) {
			$('.hideall').hide();
		}  else {
			$('.hideall').show();
			$('.showhide').hide();
		}
	});
});

/* Widget Icon select */

function anpsIconFormat(state) {
	if (!state.id) { return jQuery('<span class="anps-icon-text">' + state.text + '</span>'); }

	return jQuery('<i class="fa ' + state.element.value + '"></i> <span class="anps-icon-text">' + state.text + '</span>');
}

;jQuery(function($) {

	function createPicker() {
		var pickerClass = 'anps-iconpicker-list-wrapper';

		$('body').append('<div class="' + pickerClass + '">');
		var picker = $('.' + pickerClass);

		picker.append('<div class="anps-iconpicker-search"><input data-list=".anps-iconpicker-list" placeholder="Search"></div>');
		picker.append('<ul class="anps-iconpicker-list">');

        addIcons();

	   	return picker;
	}

	var picker = createPicker();
	var currentPicker = false;

    function addIcons() {
        $.ajax({
            method: 'GET',
            url: anps.ajaxurl,
            dataType: 'json',
            data: {
                action: 'anps_get_icons_list'
            },
            success: function (icons) {
                $('.anps-iconpicker-list').append('<li data-icon=""></li>');

                for (var iconSet in icons) {
                    $('.anps-iconpicker-list').append('<li class="anps-iconpicker-list__title">' + iconSet + '</li>');

                    icons[iconSet].forEach(function(icon) {
                        var iconCode = Object.keys(icon)[0];
                        var iconName = icon[iconCode];
            	   		$('.anps-iconpicker-list').append('<li class="anps-iconpicker-list__item" title="' + iconName + '" data-icon="' + iconCode + '"><i class="' + iconCode + '"></i><span>' + iconName + '<span></li>');
            	   	});
                }


            },
        });
    }

	function initPickerFields() {
		$('.anps-iconpicker button, .anps-iconpicker-list li').unbind('click');

		$('body').on('click', '.anps-iconpicker button', function(e) {
			e.stopPropagation();
            e.stopImmediatePropagation();

			var el = $(this).parent('.anps-iconpicker');

			if( currentPicker && el.hasClass('anps-current-picker') ) {
				picker.hide();
				currentPicker.removeClass('anps-current-picker');
			} else {
				picker.show();

				picker.css({
					'left': el.offset().left + 'px',
					'top': (el.offset().top + el.height() + 5) + 'px',
				});

				$('.anps-selected').removeClass('anps-selected');

				if( el.find('input').val() ) {
					$('[data-icon="' + el.find('input').val() + '"]').addClass('anps-selected');
				} else {
					$('[data-icon=""]').addClass('anps-selected');
				}

				currentPicker = el;
				$('.anps-current-picker').removeClass('anps-current-picker');
				currentPicker.addClass('anps-current-picker');
			}
		});

		$('.anps-iconpicker-list-wrapper').on('click', '.anps-iconpicker-list__item', function(e) {
			e.stopPropagation();

			if( currentPicker ) {
				currentPicker.find('i').attr('class', $(this).attr('data-icon'))
				currentPicker.find('input').val($(this).attr('data-icon')).trigger('change');

				$('.anps-selected').removeClass('anps-selected');
				$(this).addClass('anps-selected');
			}
		});
	}

	initPickerFields();

	/* Close event */

	$('html').on('click', function() {
		$('.anps-current-picker').removeClass('anps-current-picker');
		picker.hide();
	});

	$('.anps-iconpicker-list-wrapper').on('click', function(e) {
		e.stopPropagation();
	});

	/* Add text search */

	$('.anps-iconpicker-search input').hideseek({
        ignore: '.anps-iconpicker-list__title',
    });

	$( document ).on( 'widget-added widget-updated', initPickerFields );
});

/*!
 * Repeater v1.0.0
 *
 * Author: Anpsthemes
 * Description: Change the form to allow multiple versions of the same fields
 */
;jQuery(function($) {
	$.fn.repeater = function() {
		/* When an input is changed, trigger an update */
		this.on('change', '[data-anps-repeat] input', function() {
			repeatChange($(this).parents('[data-anps-repeat]'));
		});

        /* Color picker */
        window.colorChange = function(el) {
            setTimeout(function(){
                repeatChange($(el).parents('[data-anps-repeat]'));
            }, 1);
        };

		/* Add the content of the visible fields to the hidden one */
		function repeatChange(el) {
			var fields = el.find('[data-anps-repeat-item]').map(function() {
				var field = $(this).find('input:not([type="button"]):not([type="submit"])').map(function() {
					if( $(this).attr('type') === 'checkbox' ) {
						return $(this).prop('checked');
					} else {
						return $(this).val();
					}
				}).get().join(';');

				return field;
			}).get().join('|');

			el.find('[data-anps-repeat-field]').val(fields);
		}

		/* Remove field */
		this.on('click', '[data-anps-repeat-remove]', function() {
			var parent = $(this).parents('[data-anps-repeat]');

			if(parent.find('[data-anps-repeat-item]').length > 1) {
				$(this).parents('[data-anps-repeat-item]').remove();
				repeatChange(parent);
			}
		});

		/* Add field */
		this.on('click', '[data-anps-repeat-add]', function() {
			var parent = $(this).parents('[data-anps-repeat]');
			var container = parent.find('[data-anps-repeat-items]');
			parent.find('[data-anps-repeat-item]:first-of-type').clone().appendTo(container);

			var newItem = parent.find('[data-anps-repeat-item]:last-of-type');

			newItem.find('input').val('').attr('checked', false);
			newItem.find('.anps-iconpicker .fa').attr('class', 'fa');
            newItem.find('.wp-picker-container').replaceWith('<input class="anps-color-picker" type="text" value="" />');
            anpsInitColorPicker(newItem);

			repeatChange(parent);
		});

		/* Return this to allow chaining */
		return this;
	}
});

jQuery(function($) {
	/* Add repeater for widgets */
	$('.widget-liquid-right').repeater();
	$('#anps_hide_portfolio_meta').repeater();
	$('#anps_team_social_meta').repeater();
	$('#customize-theme-controls').repeater();
});

/* Color picker */

jQuery(function($) {
    window.anpsInitColorPicker = function (widget) {
        if (typeof jQuery.fn.wpColorPicker !== 'function') {
            return false;
        }

        var options = {
            change: function(event, ui) {
                window.colorChange(this);
            },
            clear: function() {
                window.colorChange(this);
            }
        }

        widget.find( '.anps-color-picker' ).wpColorPicker(options);
    };

    window.anpsColorPickerUpdate = function(event, widget) {
        anpsInitColorPicker(widget);
    };

    window.anpsColorPickerReady = function() {
        $('#widgets-right .widget:has(.anps-color-picker)').each(function() {
            anpsInitColorPicker($(this));
        });
    };
});