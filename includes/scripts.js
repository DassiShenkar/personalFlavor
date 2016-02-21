function init() {

    var currentUrl = document.location.href;

    /*
     * toolbar
     * create category cloud from json
     * */

    $.getJSON('data/categories.json', function (json) {
        $.each(json.categories, function () {
            var categoryElement = $('<input type="radio" name="category"' + 'value=' + (this.name).replace(' ', '-') + '>' + '<span>' + this.name + '</span></input>');
            $("#category-list").append(categoryElement);
        });
    });

    /*
     * toolbar
     * collapse menu sections
     * */

    $('#searchMenu').find("h3").click(function() {
        var sectionName =this.id.split("-");
        if(this.className == "open"){
            this.className = "initial";
            $('#searchMenu').find("section#" + sectionName[0] +  "-list")[0].className = "hide";
        }
        else if(this.className == "initial"){
            this.className = "open";
            $('#searchMenu').find("section#" + sectionName[0] +  "-list")[0].className = "show";
        }
    });

    $('#searchForm').submit(function(evt){
        var category = $('input[name=category]:checked', '#searchForm').val();
        var cid = null;
        $.getJSON('data/categories.json', function(json){
            $.each(json.categories, function () {
                if(this.name == category.replace("-", " ")){
                    cid = this.id;
                    document.location.href = "searchResults.php?category=" + this.id;
                }
            });
        });
        evt.preventDefault();
    });


    /* searchResults */
    if(currentUrl.indexOf("searchResults")!= -1) {
        var cid = (decodeURIComponent(currentUrl)).split("=")[1];
        $.getJSON('data/categories.json', function(json) {
            $.each(json.categories, function() {
                if(this.id == cid){
                    $('#breadcrumbs > ul').append('<li><a href="#">תוצאות חיפוש:'+ this.name +'</a></li>');
                }
            });
        });
        var datastring = 'action=getByCategory&category=' + cid;
        $.ajax({
           type: 'POST',
            url: 'dbHandler.php',
            cach: true,
            data: datastring,
            success: function(data) {
                    var recipes = JSON.parse(data);
                    var list = $('.thumbs');
                $.each(recipes, function(key, value){
                   list.append('<li><a href="recipe.php?rid=' + key + '"><img src=' + this.image + '><h4>' + this.title + '</h4></a></li>');
                });
            }
        });
    }

    /* home */

    if(currentUrl.indexOf("home") != -1) {
        var datastring = 'action=getFavorites';
        $.ajax({
            type: 'POST',
            url: 'dbHandler.php',
            cache: true,
            data: datastring,
            success: function(data) {
                var recipes = JSON.parse(data);
                var list = $('#responsive-images');
                $.each(recipes, function (key, value) {
                    var galleryThumb = $("<a href=recipe.php?rid=" + this.id + "><img src=" + this.image + "><h3>" + this.title + "</h3></a>");
                    list.append(galleryThumb);
                });
                $("#responsive-images").lightSlider({
                    item: 3,
                    autoWidth: true,
                    slideMove: 1, // slidemove will be 1 if loop is true
                    slideMargin: 10,

                    addClass: '',
                    mode: "slide",
                    useCSS: true,
                    cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
                    easing: 'linear', //'for jquery animation',////

                    speed: 400, //ms'
                    auto: false,
                    loop: false,
                    slideEndAnimation: true,
                    pause: 2000,

                    keyPress: false,
                    controls: true,
                    prevHtml: '',
                    nextHtml: '',

                    rtl:true,
                    adaptiveHeight:false,

                    vertical:false,
                    verticalHeight:500,
                    vThumbWidth:100,

                    thumbItem:10,
                    pager: true,
                    gallery: false,
                    galleryMargin: 5,
                    thumbMargin: 5,
                    currentPagerPosition: 'middle',

                    enableTouch:true,
                    enableDrag:true,
                    freeMove:true,
                    swipeThreshold: 40,

                    responsive : [
                        {
                            breakpoint:800,
                            settings: {
                                item:3,
                                slideMove:1,
                                slideMargin:6,
                            }
                        },
                        {
                            breakpoint:480,
                            settings: {
                                item:2,
                                slideMove:1
                            }
                        }
                    ],

                    onBeforeStart: function (el) {},
                    onSliderLoad: function (el) {},
                    onBeforeSlide: function (el) {},
                    onAfterSlide: function (el) {},
                    onBeforeNextSlide: function (el) {},
                    onBeforePrevSlide: function (el) {}
                });
            }
        });

    }

    $('#myRecipes').click(function () {
        this.className = 'active';
        var datastring = 'action=getMyRecipes';
        $.ajax({
            type: 'POST',
            url: 'dbHandler.php',
            cache: true,
            data: datastring,
            success: function (data) {
                var recipes = JSON.parse(data);
                var list = $('#responsive-images');
                list.empty();
                $.each(recipes, function (key, value) {
                    var galleryThumb = $("<a href=recipe.php?rid=" + this.id + "><img src=" + this.image + "><h3>" + this.title + "</h3></a>");
                    list.append(galleryThumb);
                });
            }
        });
    });

    /* recipe */


    if (currentUrl.indexOf("recipe") != -1) {
        var rid = (decodeURIComponent(currentUrl)).split("=")[1];
        var datastring = 'action=getRecipe' + '&rid=' + rid;
        $.ajax({
            type: 'POST',
            url: 'dbHandler.php',
            cach: true,
            data: datastring,
            success: function(data) {
                var recipe = JSON.parse(data);
                $('#recipe_title').text(recipe.title);
                $('#recipe_image').attr("src", recipe.image);
                $('#ingredients').text(recipe.ingredients);
                $('#preparation').text(recipe.preparation);

                var cid = recipe.category;

                $.getJSON('data/categories.json', function(json) {
                    $.each(json.categories, function() {
                        if(this.id == cid){
                            $('#breadcrumbs > ul').append('<li><a href="#">תוצאות חיפוש:'+ this.name +'</a></li>');
                            $('#breadcrumbs > ul').append('<li><a href="#">' + recipe.title +'</a></li>');
                        }
                    });
                });
            }
        });


        /*
         * recipe
         * toggle between view_mode and edit_mode
         * */

        $('#edit').click(function () {

            if(currentUrl.indexOf('edit_mode') == -1) {
                this.href = currentUrl.replace('#', '') + '&edit_mode=true';
                currentUrl = this.href;
            }

        });

        $('#star').click(function(){
            var params = location.search.substring(1);
            var paramsobj = JSON.parse('{"' + decodeURI(params).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}');
            var rid = paramsobj.rid;
            var dataString = 'action=like&rid=' + rid;

            $.ajax({
                type: "POST",
                url: "dbHandler.php",
                data: dataString,
                cache: true,
                success: function (html) {
                    console.log("success");
                }
            });
        });

        /*
         * recipe edit_mode
         * */

        if (currentUrl.indexOf("edit_mode") != -1) {

            var view_elements = $('#recipe-page').find('main').find('.view_mode');
            var edit_elements = $('#recipe-page').find('main').find('.edit_mode');
            var className;

            $.each(view_elements, function (index, value) {
                value.className += " hide";
            });
            $.each(edit_elements, function (index, value) {
                className = value.className.split(" ")[0] += ' edit_mode show';
                value.className = className;
            });

            /*
             * recipe edit_mode
             *  create category list from json
             * */

            $.getJSON("data/categories.json", function (data) {
                $.each(data.categories, function () {
                    $("#edit_category").append("<option value=" + this.id + ">" + this.name + "</option>");
                });
            });

            /*
             * recipe edit_mode
             *  save recipe
             * */


            $('#recipe').submit(function (evt) {
                var params = location.search.substring(1);
                var paramsobj = JSON.parse('{"' + decodeURI(params).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g, '":"') + '"}');
                var rid = paramsobj.rid;
                var title = $('#edit_title').val();
                var category = $('#edit_category').val();
                var ingredients = $('#edit_ingredients').val();
                var preparation = $('#edit_preparation').val();
                var imageUrl = $('#recipe_image').attr("src");
                var dataString = 'action=saveRecipe&rid=' + rid + '&title=' + title + '&category=' + category + '&ingredients=' + ingredients + "&preparation=" + preparation + "&imageUrl=" + imageUrl;

                $.ajax({
                    type: "POST",
                    url: "dbHandler.php",
                    data: dataString,
                    cache: true,
                    success: function (html) {
                        console.log("success");
                    }
                });
                evt.preventDefault();
            });
        }
    }
}


