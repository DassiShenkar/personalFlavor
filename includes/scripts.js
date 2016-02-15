function init() {

    //func:  create recipe category list from json

    $.getJSON("data/categories.json", function (data) {
        $.each(data.categories, function () {
            $("#category-list").append("<a href='searchResults?category =" + this.name + "'>" + this.name + "</a>");
        });
    });

    //func:  collapse/fold toolbar section

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
}


