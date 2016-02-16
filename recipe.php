<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, initial-scale = 1.0">
        <title>סטייק של בית</title>
        <link rel="stylesheet" href="includes/style.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="includes/scripts.js"></script>
    </head>
    <body id="recipe-page">
    <div id="wrapper">
        <header>
            <a id="logo" href="index.html"></a>
            <form action="#" method="GET" id="searchBox">
                <input type="search" placeholder="אני רוצה לבשל..." results="3" autosave="saved-searches">
            </form>
            <a id="login" href="#">ברוך הבא,
                <strong>בר ירון</strong>
            </a>
            <div class="clear"></div>
        </header>
        <main>
            <nav id="breadcrumbs">
                <ul >
                    <li><a href="login.html">עמוד הבית</a></li>
                    <li><a href="searchResults.html">חיפוש: בשר ועוף</a></li>
                    <li><a href="#">סטייק של בית</a></li>
                    <div class="clear"></div>
                </ul>
            </nav>
            <form id="recipe" method="post">
               <section id="recipe_header">
                   <h1 class="recipe_title view_mode" >סטייק של בית</h1>
                   <label for="edit_title" class=" edit_mode hide">
                       <h5>ערוך שם מתכון</h5>
                       <input type="text" id="edit_title" class="recipe_title" name="title" placeholder="שם המתכון">
                   </label>
                   <ul id="edit_recipe_menu" class="view_mode">
                       <li><a href="#" id="star"></a></li>
                       <li><a href="#" id="print"></a></li>
                       <li><a href="#" id="edit"></a></li>
                       <div class="clear"></div>
                   </ul>
                   <div class="clear"></div>
               </section>
                <section id="recipe_content">
                    <h4 class="view_mode"></h4>
                    <label for="edit_category" class="edit_mode hide">
                        <h5>בחר קטגוריה</h5>
                        <select name="category" id="edit_category" class="edit_mode hide"></select>
                    </label>
                    <h4 class="view_mode">חומרים</h4>
                    <p class="ingredients view_mode"></p>
                    <label for="edit_ingredients" class="edit_mode hide">
                        <h5>ערוך רשימת חומרים</h5>
                        <textarea id="edit_ingredients" name="ingredients" class="ingredients edit_mode hide"  rows="10"></textarea>
                    </label>
                    <h3 class="view_mode">אופן ההכנה</h3>
                    <p class="preparation view_mode"></p>
                    <label for="edit_preparation" class="edit_mode hide">
                        <h5>ערוך אופן הכנה</h5>
                        <textarea id="edit_preparation" name="preparation" class="preparation edit_mode hide"  rows="10"></textarea>
                    </label>
                </section>
                <img class="recipe_image" src="" alt="" title="">
                <input type="file" name="image" id="upload_image" class="edit_mode hide">
                <div class="clear"></div>
                <input type="submit"  class="btn edit_mode hide" value="שמור">
            </form>
            <div class="clear"></div>
            <footer>
                <ul>
                    <li><a href="#">אודות</a></li>
                    <li><a href="#">מפת אתר</a></li>
                    <li><a href="#">תנאי שימוש</a></li>
                    <li><a href="#">דרושים</a></li>
                    <li><a href="#">כתבו לנו</a></li>
                    <li><a id="copyright" href="#">Copyright &copy 2015</a></li>
                </ul>
                <div class="clear"></div>
            </footer>
        </main>
        <section id="tools">
            <a id="addBtn" href="#" class="btn">
                <span>הוסף מתכון</span>
                <svg id="plus_icon" xmlns="http://www.w3.org/2000/svg" version="1.1" x="0px" y="0px" viewBox="0 0 100 125"
                         enable-background="new 0 0 100 100" xml:space="preserve">
                        <path fill="#000000" d="M50,5C25.2,5,5,25.2,5,50s20.2,45,45,45s45-20.2,45-45S74.8,5,50,5z M77,54.5H54.5V77h-9V54.5H23v-9h22.5V23  h9v22.5H77V54.5z"/>
                    </svg>
            </a>
            <ul id="searchMenu">
                <li class="close">
                    <h3>מה מבשלים ?</h3>
                    <section id="category-list" class="hide">
                    </section>
                </li>
                <li class="close">
                    <h3>סגנון ?</h3>
                    <section class="hide"></section>
                </li>
                <li class="close">
                    <h3>רמת קושי ?</h3>
                    <section class="hide"></section>
                </li>
                <li class="close">
                    <h3>בחר מצרכים</h3>
                    <section>
                        <input type="text" class="searchBoxWithImg" placeholder="בא לי במתכון...">
                    </section>
                </li>
            </ul>
            <input type="submit" value="חפש" id="searchBtn" href="#" class="btn">
        </section>
        <div class="clear"></div>
    </div>
    <script>
        (function(){
            init();
        })();
    </script>
    </body>
</html>