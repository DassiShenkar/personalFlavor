function init() {

    var menuItems = [];
    var sections = [];
    var numOfItems = 0;
    var index;

    menuItems = document.getElementById('searchMenu').getElementsByTagName('li');
    numOfItems = menuItems.length;

    for(index = 0; index < numOfItems; index++) {
        menuItems[index].addEventListener('click', function() {
            sections = this.getElementsByTagName('section');
            if (this.className == "close" && sections[0].className == "hide") {
                this.className = "open";
                sections[0].className = "show";
            }
            else {
                this.className = "close";
                sections[0].className = "hide";
            }
        });
    }
}


