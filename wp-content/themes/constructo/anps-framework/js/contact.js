jQuery(document).ready(function( $ ) {     

    function addNew(index) { 
        
         var data = '';
         
         data += '<div class="form_fields" id="form_fields_' + (index + 2) + '">';
         data += '<div class="input" style="display: none"><label for="label_' + (index + 2) + '">Label</label> <input type="text" name="label_' + (index + 2) + '"/></div>';    
         data += '<div class="input"><label for="input_type_' + (index + 2) + '">Input type</label> <select class="contact-change" name="input_type_' + (index + 2) + '"><option value="text" selected="selected">Text</option> <option value="textarea">Textarea</option><option value="dropdown">Dropdown</option><option value="checkbox">Checkbox</option><option value="radio">Radio</option><option value="captcha">Captcha</option></select></div>';
         data += '<div class="input contact-required"><label for="is_required_' + (index + 2) + '">Required</label> <input type="checkbox" name="is_required_' + (index + 2) + '" /></div>';
         data += '<div class="input contact-placeholder"><label for="placeholder_' + (index + 2) + '">Placeholder</label> <input type="text" name="placeholder_' + (index + 2) + '" /></div>';
         data += '<div class="input contact-validation"><label for="validation_' + (index + 2) + '">Validation</label><select name="validation_' + (index + 2) + '"><option value="none" selected="selected">None</option><option value="email">Email</option><option value="number">Number</option><option value="phone">phone</option><option value="text_only">Text only</option></select></div>';
         data += '<div class="input label-place-val contact-textarea" style="display: none"><label for="textarea_' + (index + 2) + '">Textarea</label><textarea name="textarea_' + (index + 2) + '" id="textarea_' + (index + 2) + '"></textarea></div>';
         data += '<div class="input label-place-val contact-public" style="display: none"><label for="public_key_' + (index + 2) + '">Public key</label><input type="text" name="public_key_' + (index + 2) + '" value=""></div>';
         data += '<div class="input label-place-val contact-private" style="display: none"><label for="private_key_' + (index + 2) + '">Private key</label><input type="text" name="private_key_' + (index + 2) + '" value=""></div>';

         data += '<div class="remove-add"><input type="button" class="remove" value="-"><input class="add" type="button" value="+"></div>';
       
         data +='</div>'
         $('.form_fields_wrapper .form_fields').eq(index).after(data);

         reCheck();
         
         $('.form_fields_wrapper').find("input[type=button].add").unbind('click');
         $('.form_fields_wrapper').find("input[type=button].add").bind('click', function(event) {
             var index = $(this).parent().parent().index();
             addNew(index);
         });

         $('.form_fields_wrapper').find("input[type=button].remove").unbind('click');
         $('.form_fields_wrapper').find("input[type=button].remove").bind('click', function(event) {
            var index = $(this).parent().parent().index();
            removeOld(index);
         });

        $(".contact-change").change(function() {
            onSelectChange($(this));
        });
         
    }
    
    function removeOld(index) {
        $('.form_fields').eq(index).remove();
        reCheck()
    }
    
    
    function reCheck() {
         $('.form_fields_wrapper .form_fields').each(function(index){
             $('.form_fields').eq(index).attr('id','form_fields_' + (index + 1))
             
             $('.form_fields').eq(index).children().eq(0).children('label').attr('for','label_' + (index + 1));
             $('.form_fields').eq(index).children().eq(0).children('input').attr('name','label_' + (index + 1));
             
             $('.form_fields').eq(index).children().eq(1).children('label').attr('for','input_type_' + (index + 1));
             $('.form_fields').eq(index).children().eq(1).children('select').attr('name','input_type_' + (index + 1));
             
             $('.form_fields').eq(index).children().eq(2).children('label').attr('for','is_required_' + (index + 1));
             $('.form_fields').eq(index).children().eq(2).children('input').attr('name','is_required_' + (index + 1));
             
             $('.form_fields').eq(index).children().eq(3).children('label').attr('for','placeholder_' + (index + 1));
             $('.form_fields').eq(index).children().eq(3).children('input').attr('name','placeholder_' + (index + 1));
             
             $('.form_fields').eq(index).children().eq(4).children('label').attr('for','validation_' + (index + 1));
             $('.form_fields').eq(index).children().eq(4).children('select').attr('name','validation_' + (index + 1));
         });    
     }
    
    $('.form_fields_wrapper .form_fields .add').click(function(){ 
        var index = $(this).parent().parent().index();
        addNew(index);
    });
    
    $('.form_fields_wrapper .form_fields .remove').click(function(){
        var index = $(this).parent().parent().index();
        removeOld(index);
    });
    
  	
  	$(".contact-change").change(function() {

        onSelectChange($(this));

    });

    function onSelectChange(el) {
        el.parent().parent().children(".contact-validation, .contact-required, .contact-placeholder, .contact-required, .contact-textarea, .contact-public, .contact-private").hide();

        if(el.val() == "text" || el.val() == "textarea") {

            el.parent().parent().children(".contact-validation, .contact-required, .contact-placeholder").show();

        } else if(el.val() == "dropdown" || el.val() == "checkbox" || el.val() == "radio") {

            el.parent().parent().children(".contact-required, .contact-textarea").show();

        } else if(el.val() == "captcha") {

            el.parent().parent().children(".contact-public, .contact-private").show();

        } else {
            console.log("Error!");
        }
    }
    
});

