function init() {

    var currentUrl = document.location.href;

    /*
     * toolbar
     * create category cloud from json
     * */

    $.getJSON('data/categories.json', function (json) {
        $.each(json.categories, function () {
            var button = $("<button category=" + (this.name).replace(" ", "-") + ">" + this.name + "</button>");
            $("#category-list").append(button);
            button.click(function() {
                var category = this.getAttribute("category");
                var cid = 0;
                $.each(json.categories, function() {
                    if(this.name.indexOf(category.replace("-", " ")) != -1) {
                        cid = this.id;
                    }
                })
                $.post('toolbar.php', {'category': cid}, function(data){
                    $.each(function(recipe){
                        var id = recipe.id;
                        alert(id);
                    })
                    document.location.href = 'searchResults.php?category=' + category.replace("-", " ");
                });
            });
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

    /* home */

    if(currentUrl.indexOf("home") != -1) {
        $("#responsive").lightSlider({
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

    /* recipe */


    if (currentUrl.indexOf("recipe") != -1) {

        /*
         * recipe
         * toggle between view_mode and edit_mode
         * */

        $('#edit').click(function () {

            if(currentUrl.indexOf('edit_mode') == -1) {
                this.href = currentUrl.replace('#', '') + '?edit_mode=true';
                currentUrl = this.href;
            }

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
             *  create category cloud from json
             * */

            $.getJSON("data/categories.json", function (data) {
                $.each(data.categories, function () {
                    $("#edit_category").append("<option value=" + this.name + ">" + this.name + "</option>");
                });
            });


            /*
             * recipe edit_mode
             *  handle recipe image upload
             * */

            //$('#upload_image').change(function (evt) {
            //    var file = evt.target.files[0];
            //    if (file.type.match('image.*')) {
            //        var reader = new FileReader();
            //        reader.onload = (function (file) {
            //            return function (evt) {
            //                $('.recipe_image').attr("src", evt.target.result);
            //                $('.recipe_image').attr("title", encodeURI(file.name));
            //                $('.recipe_image').attr("alt", encodeURI(file.name));
            //            };
            //        })(file);
            //        reader.readAsDataURL(file);
            //    }
            //});

            /*
             * recipe edit_mode
             *  save recipe
             * */

            $('#recipe').submit(function () {
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
                    success: function (html) {
                        console.log("success");
                    }
                });
                return false;
            });
        }
    }
}


