function init() {

    var menuItems = [];
    var sections = [];
    var numOfItems = 0;
    var index;

    menuItems = document.getElementById('searchMenu').getElementsByTagName('li');
    numOfItems = menuItems.length;

    for(index = 0; index < numOfItems - 1; index++) {
        menuItems[index].addEventListener('click', function() {
            sections = this.getElementsByTagName('section');
            if (this.className == 'close' && sections[0].className == 'hide') {
                this.className = 'open';
                sections[0].className = 'show';
            }
            else {
                this.className = 'close';
                sections[0].className = 'hide';
            }
        });
    }

    var foods = [];
    var numOfFoods = 0;

    foods = document.getElementById('what').getElementsByTagName('span');
    numOfFoods = foods.length;

    for(index = 0; index < numOfFoods; index++) {
        foods[index].addEventListener('click', function() {
           this.className == 'selected' ? this.className = "" : this.className = 'selected';
        });
    }
}


