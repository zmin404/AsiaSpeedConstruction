<div class="submit-wrapper">
    <div class="form-group">
        <label for="text">Text</label>
        <input type="text" id="text">
        <p>Text that appears inside the button</p>
    </div>

    <div class="form-group">
        <label for="link">Link</label>
        <input type="text" id="link">
        <p>Can contain either an URL (i.e. http://www.anpsthemes.com) or an anchor link (#contact)</p>
    </div>

    <div class="form-group">
        <label for="target">Link</label>
        <select id="target">
            <option value="_self">_self</option>
            <option value="_blank">_blank</option>
            <option value="_parent">_parent</option>
            <option value="_top">_top</option>
        </select>
        <p>This attribute specifies where to display the linked resource. Can be set to _self, _blank, _parent or _top (<a target="_blank" href="https://developer.mozilla.org/en-US/docs/Web/HTML/Element/a">read more about these values</a>).</p>
    </div>

    <div class="form-group">
        <label for="size">Size</label>
        <select id="size">
            <option value="small">Small</option>
            <option value="medium">Medium</option>
            <option value="large">Large</option>
        </select>
        <p>Determines the button size. Can be set to either small, medium of large.</p>
    </div>

    <div class="form-group last">
        <label for="style">Style</label>
        <select id="style">
            <option value="style-1">Style 1</option>
            <option value="style-2">Style 2</option>
            <option value="style-3">Style 3</option>
            <option value="style-4">Style 4</option>
        </select>
        <p>This changes the button styling. Can be set to either style-1, style-2 or style-3.</p>
    </div>

    <div class="buttons">
        <input type="button" class="cancel" value="Cancel" onclick="anps_Cancel()" />
        <input type="button" class="submit" value="Insert" onclick="anps_getValue()" />
    </div>
</div>

<script>
function anps_getValue() { 
    text = document.getElementById('text').value;
    link = document.getElementById('link').value;
    target = document.getElementById('target').value;
    size = document.getElementById('size').value;
    style = document.getElementById('style').value;

    window.parent.send_to_editor('[button link="' + link + '" target="' + target + '" size="' + size + '" style_button="' + style + '"]' + text + '[/button]');
}
function anps_Cancel() {
    window.parent.send_to_editor(' ');
}
</script>

<style>
    body {
        color: #222;
        font-size: 13px;
        font-family: 'Arial';
        padding: 0 20px;
    }

    .buttons {
        text-align: center;
    }

    label {
        display: block;
        margin-top: 25px;
        margin-bottom: 8px;
    }

    .form-group p {
        border-bottom: 1px solid #ddd;
        color: #999;
        padding-bottom: 20px;
    }

    .form-group.last p {
        border: none;
    }

    input[type="text"], select {
        border: 1px solid #ddd;
        -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.07);
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.07);
        background-color: #FFF;
        color: #333;
        padding: 7px 9px;
        -webkit-transition: .05s border-color ease-in-out;
        transition: .05s border-color ease-in-out;
        width: 100%;
    }

    input[type="button"] {
        border-radius: 3px;
        cursor: pointer;
        display: inline-block;
        font-size: 13px;
        padding-bottom: 10px;
        padding-top: 8px;
        text-align: center;
    }

    .cancel {
        background-color: #F7F7F7;
        -webkit-box-shadow: #FFF 0px 1px 0px 0px inset, rgba(0, 0, 0, 0.0784314) 0px 1px 0px 0px;
        box-shadow: #FFF 0px 1px 0px 0px inset, rgba(0, 0, 0, 0.0784314) 0px 1px 0px 0px;
        border: 1px solid #CCC;
        color: #555;
        padding-left: 22px;
        padding-right: 22px;
    }

    .cancel:hover {
        background-color: #FAFAFA;
        border-color: #999;
        color: #222;
    }

   .submit {
        background-color: #1E8CBE;
        border: 1px solid #0074A2;
        -webkit-box-shadow: rgba(120, 200, 230, 0.6) 0px 1px 0px 0px inset;
        box-shadow: rgba(120, 200, 230, 0.6) 0px 1px 0px 0px inset;
        color: #fff;
        padding-left: 32px;
        padding-right: 32px;
   }

   .submit:hover {
        opacity: .9;
   }
</style>