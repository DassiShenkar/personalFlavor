function init() {

    var currentUrl = document.location.href;

    /*
     * toolbar
     * create category cloud from json
     * */

    $.getJSON('data/categories.json', function (json) {
        var categoryElement;
        $.each(json.categories, function () {
            categoryElement = $('<input id=' + this.id + ' type="radio" name="category"' + 'value=' + (this.name).replace(' ', '-') + '><label class="category" for=' + this.id + '>' + this.name + '</label>');
            $("#category-list").append(categoryElement);
        });
    });

    /*
     * toolbar
     * collapse menu sections
     * */

    $('#searchMenu').find("h3").click(function () {
        var sectionName = this.id.split("-");
        if (this.className == "open") {
            this.className = "initial";
            $('#searchMenu').find("section#" + sectionName[0] + "-list")[0].className = "hide";
        }
        else if (this.className == "initial") {
            this.className = "open";
            $('#searchMenu').find("section#" + sectionName[0] + "-list")[0].className = "show";
        }
    });

    /*
     * toolbar
     * submit search form
     * for now: only search by category is implemented
     * */

    $('#searchForm').submit(function (evt) {
        var category = $('input[name=category]:checked', '#searchForm').val();
        var cid = null;
        $.getJSON('data/categories.json', function (json) {
            $.each(json.categories, function () {
                if (this.name == category.replace("-", " ")) {
                    cid = this.id;
                    document.location.href = "searchResults.php?category=" + this.id;
                }
            });
        });
        evt.preventDefault();
    });

    /*
     * home
     * */

    if (currentUrl.indexOf("home") != -1) {
        favorites(); //gallery shows favorites by default
        getWeeklyRecipe();
        getTopWriters();
    }

    /*
     * home
     * get recipe of the week
     * */

    function getWeeklyRecipe() {
        var datastring = 'action=getWeeklyRecipe';
        var article = $('#weeklyRecipe');
        $.ajax({
            type: 'POST',
            url: 'dbHandler.php',
            cache: true,
            data: datastring,
            success: function (data) {
                var recipe = JSON.parse(data);
                var weeklyElement = '<picture><source srcset=' + recipe.image + ' media="(min-width: 1000px)" title=' + recipe.title + '>'
                    + '<source srcset=' + recipe.image + ' media="(max-width: 999px)" title=' + recipe.title + '>'
                    + '<img srcset=' + recipe.image + ' alt=' + recipe.image + ' title=' + recipe.title + '></picture><section>'
                    + '<h2>מתכון השבוע</h2>'
                    + '<section  id="content">'
                    + '<h4>' + recipe.title + '</h4>'
                    + '<h4 id="editor">מאת <a href="#">' + recipe.username + '</a></h4><p>' + recipe.preparation + '</p>'
                    + '</section></section><div class="clear"></div>';
                article.append(weeklyElement);
            }
        });
    }

    /*
     * home
     * get the 5 writers
     * that contributed the largest num of recipes
     * */

    function getTopWriters() {
        var feedElement = $('#feed');
        var datastring = 'action=getTopWriters';
        var article = $('#topWriters');
        $.ajax({
            type: 'POST',
            url: 'dbHandler.php',
            cache: true,
            data: datastring,
            success: function (data) {
                var writters = JSON.parse(data);
                var topWritersList = $("#topWriters").find('ol');
                var topwritters = '';
                $.each(writters, function (key, value) {
                    topwritters += "<li><a href=recipe.php?" + this.username + ">" + this.username + "</a></li>";
                });
                topWritersList.append(topwritters);
            }
        });
    }

    /*
     * home
     * logout
     * */

    $('#logged').click(function () {
        document.location.href = "index.php";
    });

    /*
     * home
     * get user favorite recipes
     * */

    $('#favorites').click(function () {
        if ((this.className).indexOf('active') != -1) {
            this.className += '';
        }
        else {
            var navItems = $('#mainNav').find('li');
            $.each(navItems, function (index, item) {
                item.className = "";
            });
            this.className += 'active';
            favorites();
        }
    });

    function favorites() {
        var datastring = 'action=getFavorites';
        var list = $('#gallery');
        var gallery = "";
        $('#gallery').empty();
        $.ajax({
            type: 'POST',
            url: 'dbHandler.php',
            cache: true,
            data: datastring,
            success: function (data) {
                var recipes = JSON.parse(data);
                $.each(recipes, function (key, value) {
                    gallery += "<a href=recipe.php?rid=" + this.id + "><img src=" + this.image + "><h3>" + this.title + "</h3></a>";
                });
                list.append('<div id="responsive-images">' + gallery + '</div>');
                createGallery();
            }
        });
    }

    /*
     * home
     * get the recipes
     * the user edited
     * */

    $('#myRecipes').click(function () {
        if ((this.className).indexOf('active') != -1) {
            return;
        }
        else {
            var navItems = $('#mainNav').find('li');
            $.each(navItems, function (index, item) {
                item.className = "";
            });
            this.className = 'active';
            var datastring = 'action=getMyRecipes';
            var list = $('#gallery');
            var gallery = "";
            $('#gallery').empty();
            $.ajax({
                type: 'POST',
                url: 'dbHandler.php',
                cache: true,
                data: datastring,
                success: function (data) {
                    var recipes = JSON.parse(data);
                    $.each(recipes, function (key, value) {
                        gallery += "<a href=recipe.php?rid=" + this.id + "><img src=" + this.image + "><h3>" + this.title + "</h3></a>";
                    });
                    list.append('<div id="responsive-images">' + gallery + '</div>');
                    createGallery();
                }
            });
        }
    });


    /*
     * home
     * slider galley code from external source
     * */

    function createGallery() {
        $("#responsive-images").lightSlider({
            item: 3,
            autoWidth: true,
            slideMove: 3, //
            slideMargin: 10,

            addClass: '',
            mode: "slide",
            useCSS: true,
            cssEasing: 'ease',
            easing: 'linear',

            speed: 400,
            auto: false,
            loop: false,
            slideEndAnimation: true,
            pause: 2000,

            keyPress: false,
            controls: false,
            prevHtml: '',
            nextHtml: '',

            rtl: true,
            adaptiveHeight: false,

            vertical: false,
            verticalHeight: 500,
            vThumbWidth: 100,

            thumbItem: 10,
            pager: true,
            gallery: false,
            galleryMargin: 5,
            thumbMargin: 5,
            currentPagerPosition: 'middle',

            enableTouch: true,
            enableDrag: true,
            freeMove: true,
            swipeThreshold: 40,

            responsive: [
                {
                    breakpoint: 800,
                    settings: {
                        item: 3,
                        slideMove: 1,
                        slideMargin: 6,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        item: 2,
                        slideMove: 1
                    }
                }
            ]
        });
    }


    /*
     * searchResults
     * create breadcrumbs
     * */

    if (currentUrl.indexOf("searchResults") != -1) {
        var cid = (decodeURIComponent(currentUrl)).split("=")[1];
        $.getJSON('data/categories.json', function (json) {
            $.each(json.categories, function () {
                if (this.id == cid) {
                    var breadcrumbs = '<li><a href="#">תוצאות חיפוש:' + this.name + '</a></li><div class="clear"></div>';
                    $('#breadcrumbs > ul').append(breadcrumbs);
                }
            });
        });
        var datastring = 'action=getByCategory&category=' + cid;
        $.ajax({
            type: 'POST',
            url: 'dbHandler.php',
            cach: true,
            data: datastring,
            success: function (data) {
                var recipes = JSON.parse(data);
                var list = $('.thumbs');
                $.each(recipes, function (key, value) {
                    list.append('<li><a href="recipe.php?rid=' + key + '"><img src=' + this.image + '><h4>' + this.title + '</h4></a></li>');
                });
            }
        });
    }


    /*
     * single recipe page
     * get user favorite recipes
     * */

    if (currentUrl.indexOf("recipe") != -1) {
        var rid = (decodeURIComponent(currentUrl)).split("=")[1];
        var datastring = 'action=getRecipe' + '&rid=' + rid;
        $.ajax({
            type: 'POST',
            url: 'dbHandler.php',
            cach: true,
            data: datastring,
            success: function (data) {
                var recipe = JSON.parse(data);
                if (currentUrl.indexOf('edit_mode') != -1) {
                    $('#edit_title').val(recipe.title);
                    $('#edit_ingredients').val(recipe.ingredients);
                    $('#edit_preparation').val(recipe.preparation);
                    $('#recipe_image').attr("src", recipe.image);
                }
                else {
                    $('#recipe_title').text(recipe.title);
                    $('#recipe_image').attr("src", recipe.image);
                    $('#ingredients').text(recipe.ingredients);
                    $('#preparation').text(recipe.preparation);
                }

                var cid = recipe.category;

                $.getJSON('data/categories.json', function (json) {
                    $.each(json.categories, function () {
                        if (this.id == cid) {
                            var breadcrumbs = '<li><a href="#">תוצאות חיפוש:' + this.name + '</a></li><li><a href="#">' + recipe.title + '</a></li><div class="clear"></div>';
                            $('#breadcrumbs > ul').append(breadcrumbs);
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

            if (currentUrl.indexOf('edit_mode') == -1) {
                this.href = currentUrl.replace('#', '') + '&edit_mode=true';
                currentUrl = this.href;
            }

        });

        /*
         * recipe
         * add recipe to favorites
         * */

        $('#star').click(function () {
            var starElement = this;
            var params = location.search.substring(1);
            var paramsobj = JSON.parse('{"' + decodeURI(params).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g, '":"') + '"}');
            var rid = paramsobj.rid;
            var dataString = 'action=like&rid=' + rid;

            $.ajax({
                type: "POST",
                url: "dbHandler.php",
                data: dataString,
                cache: true,
                success: function (html) {
                    if ((starElement.className).indexOf("not") != -1) {
                        starElement.className = "isFavorite";
                    }
                    else {
                        starElement.className = "notFavorite";
                    }
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
                var rid = null;
                var dataString;
                var params = location.search.substring(1);
                var paramsobj = JSON.parse('{"' + decodeURI(params.replace(/&/g, "\",\"").replace(/=/g, "\":\"")) + '"}')
                var title = $('#edit_title').val();
                var category = $('#edit_category').val();
                var ingredients = $('#edit_ingredients').val();
                var preparation = $('#edit_preparation').val();
                var imageUrl = $('#recipe_image').attr("src");
                if (!paramsobj.rid) {
                    dataString = 'action=saveRecipe&&title=' + title + '&category=' + category + '&ingredients=' + ingredients + "&preparation=" + preparation + "&imageUrl=" + imageUrl;
                }
                else {
                    rid = paramsobj.rid;
                    dataString = 'action=saveRecipe&rid=' + rid + '&title=' + title + '&category=' + category + '&ingredients=' + ingredients + "&preparation=" + preparation + "&imageUrl=" + imageUrl;
                }
                $.ajax({
                    type: "POST",
                    url: "dbHandler.php",
                    data: dataString,
                    cache: true,
                    success: function (data) {
                        document.location.href = 'recipe.php?rid=' + data;
                    }
                });
                evt.preventDefault();
            });
        }
    }
}


