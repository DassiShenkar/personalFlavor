function init() {

    //create recipe category list from json

    $.getJSON("data/categories.json", function (data) {
        $.each(data.categories, function () {
            $("#category-list").append("<a href='searchResults?category =" + this.name + "'>" + this.name + "</a>");
        });
    });

    $.getJSON("data/categories.json", function (data) {
        $.each(data.categories, function () {
            $("#edit_category").append("<option value=" + this.name + ">" + this.name + "</option>");
        });
    });

    //collapse toolbar section

    $('#searchMenu').children().click(function () {

        if(this.className == "close"){
            this.className = "open";
            $(this).find("section")[0].className = "show";
        }
        else {
            this.className = "close";
            $(this).find("section")[0].className = "hide";
        }
    });

    //toggle between view_mode and edit_mode

    $('#edit').click(function () {
        var view_elements = $('#recipe-page').find('main').find('.view_mode');
        var edit_elements = $('#recipe-page').find('main').find('.edit_mode');
        var className;

        $.each(view_elements, function(index, value){
            value.className += " hide";
        });
        $.each(edit_elements, function(index, value){
            className = value.className.split(" ")[0] += ' edit_mode show';
            value.className = className;
        });
    });

    //handle recipe image upload

    $('#upload_image').change(handleFileSelect);

    function handleFileSelect(evt) {
        var file = evt.target.files[0];
        if(file.type.match('image.*')){
            var reader = new FileReader();
            reader.onload = (function(file){
                return function(evt) {
                    $('.recipe_image').attr("src", evt.target.result);
                    $('.recipe_image').attr("title", encodeURI(file.name));
                    $('.recipe_image').attr("alt", encodeURI(file.name));
                };
            })(file);
            reader.readAsDataURL(file);
        }
    }

    $('#recipe').submit(function() {
        var title = $('#edit_title').val();
        var category = $('#edit_category').val();
        var ingredients = $('#edit_ingredients').val();
        var preparation = $('#edit_preparation').val();
        var imageUrl = $('#upload_image');
        var dataString = 'title=' + title + '&category=' + category + '&ingredients=' + ingredients + "&preparation=" + preparation + "&imageUrl=" + imageUrl;

        $.ajax({
            type: "POST",
            url: "dbHandler.php",
            data: dataString,
            cache: true,
            success: function(html) {
                console.log("success");
            }
        });
        return false;
    });
}


