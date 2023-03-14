<div class="submit-wrapper">
    <div class="form-group">
        <label for="category">Category</label>
        <input type="text" id="category">
        <p>Slug of the posts category. Can be also set to All to display posts from all categories.</p>
    </div>
    <div class="form-group">
        <label for="number">Number of posts per page</label>
        <input type="text" id="number">
        <p>Number of posts to be displayed at once.</p>
    </div>
    <div class="form-group">
        <label for="columns">Columns</label>
        <select id="columns">
            <option value="3">4 columns</option>
            <option value="3">3 columns</option>
        </select>
        <p>The number of posts in a row.</p>
    </div>
    <div class="form-group">
        <label for="orderby">Order By</label>
        <select id="orderby">
            <option value="">Default</option>
            <option value="date">Date</option>
            <option value="ID">Id</option>
            <option value="title">Title</option>
            <option value="name">Name</option>
            <option value="author">Author</option>
        </select>
        <p>The way the posts will be ordered.</p>
    </div>
    <div class="form-group">
        <label for="order">Order</label>
        <select id="order">
            <option value="default">Default</option>
            <option value="ASC">Ascending</option>
            <option value="DESC">Descending</option>
        </select>
        <p>In which order the posts will be displayed.</p>
    </div>
    <div class="form-group">
        <label for="type">Blog Type</label>
        <select id="type">
            <option value=""></option>
            <option value="grid">Grid</option>
            <option value="masonry">Masonry</option>
        </select>
        <p>The styling of blog posts.</p>
    </div>
    <div class="buttons">
        <input type="button" class="cancel" value="Cancel" onclick="anps_Cancel()" />
        <input type="button" class="submit" value="Insert" onclick="anps_getValue()" />
    </div>
</div>
<script>
function anps_getValue() { 
    number = document.getElementById('number').value;
    category = document.getElementById('category').value;
    columns = document.getElementById('columns').value;
    type = document.getElementById('type').value;
    order = document.getElementById('order').value;
    orderby = document.getElementById('orderby').value;
    window.parent.send_to_editor('[blog orderby="' + orderby + '" order="' + order + '" type="' + type + '" columns="' + columns + '" category="' + category + '"]' + number + '[/blog]');
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