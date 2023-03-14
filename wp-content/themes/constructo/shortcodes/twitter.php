<div class="submit-wrapper">
    <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" id="slug">
        <p>This is used for both for none page navigation and the parallax effect (if you do not have the navigation need you enter a unique slug if you want parallax effect to function).</p>
    </div>

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title">
        <p>Enter twitter element title.</p>
    </div>

    <div class="form-group">
        <label for="parallax">Parallax</label>
        <select id="parallax">
            <option value="false">False</option>
            <option value="true">True</option>
        </select>
        <p>If set to true, the background image will have the parallax effect (<a href="http://en.wikipedia.org/wiki/Parallax_scrolling">http://en.wikipedia.org/wiki/Parallax_scrolling</a>).</p>
    </div>

    <div class="form-group">
        <label for="parallaxOverlay">Parallax Overlay</label>
        <select id="parallaxOverlay">
            <option value="false">False</option>
            <option value="true">True</option>
        </select>
        <p>If set to true, it makes the background image darker.</p>
    </div>

    <div class="form-group">
        <label for="backgroundImageURL">Background image url</label>
        <input type="text" id="backgroundImageURL">
        <p>Enter background image url.</p>
    </div>

    <div class="form-group">
        <label for="twitterUsername">Twitter username</label>
        <input type="text" id="twitterUsername">
        <p>Twitter username hadle, like anpsthemes (<a href="https://twitter.com/anpsthemes">https://twitter.com/anpsthemes</a>)</p>
    </div>

    <div class="buttons">
        <input type="button" class="cancel" value="Cancel" onclick="anps_Cancel()" />
        <input type="button" class="submit" value="Insert" onclick="anps_getValue()" />
    </div>
</div>

<script>
function anps_getValue() { 
    slug = document.getElementById('slug').value;
    title = document.getElementById('title').value;
    parallax = document.getElementById('parallax').value;
    parallaxOverlay = document.getElementById('parallaxOverlay').value;
    backgroundImageURL = document.getElementById('backgroundImageURL').value;
    twitterUsername = document.getElementById('twitterUsername').value;

    window.parent.send_to_editor('[twitter title="' + title  + '" parallax="' + parallax + '" parallax_overlay="' + parallaxOverlay + '" slug="' + slug + '" image="' + backgroundImageURL + '"]' + twitterUsername + '[/twitter]');
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