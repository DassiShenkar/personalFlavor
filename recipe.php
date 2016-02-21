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
            <a id="logo" href="home.php"></a>
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
                <ul class="breadcrumbs">
                    <li><a href="index.php">עמוד הבית</a></li>
                    <div class="clear"></div>
                </ul>
            </nav>
            <form id="recipe" method="post" action="">
               <section id="recipe_header">
                   <h1 id="recipe_title" class="view_mode"></h1>
                   <label for="edit_title" class=" edit_mode hide">
                       <h5>ערוך שם מתכון</h5>
                       <input type="text" id="edit_title" class="recipe_title" name="title" placeholder="שם המתכון">
                   </label>
                   <ul id="edit_recipe_menu" class="view_mode">
                       <li><a href="#" id="star"></a></li>
                       <li><a href="#" id="print"></a></li>
                       <li><a href="" id="edit"></a></li>
                       <div class="clear"></div>
                   </ul>
                   <div class="clear"></div>
               </section>
                <section id="recipe_content">
                    <h4 class="view_mode">קטגוריה</h4>
                    <p id="recipe_category"></p>
                    <label for="edit_category" class="edit_mode hide">
                        <h5>בחר קטגוריה</h5>
                        <select name="category" id="edit_category" class="edit_mode hide"></select>
                    </label>
                    <h4 class="view_mode">חומרים</h4>
                    <p id="ingredients" class="view_mode"></p>
                    <label for="edit_ingredients" class="edit_mode hide">
                        <h5>ערוך רשימת חומרים</h5>
                        <textarea id="edit_ingredients" name="ingredients" class="ingredients edit_mode hide"  rows="10"></textarea>
                    </label>
                    <h3 class="view_mode">אופן ההכנה</h3>
                    <p id="preparation" class="view_mode"></p>
                    <label for="edit_preparation" class="edit_mode hide">
                        <h5>ערוך אופן הכנה</h5>
                        <textarea id="edit_preparation" name="preparation" class="preparation edit_mode hide"  rows="10"></textarea>
                    </label>
                </section>
                <img id="recipe_image" src="" alt="" title="">
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
        <?php include("toolbar.php"); ?>
        <div class="clear"></div>
    </div>
    <script>
        (function(){
            init();
        })();
    </script>
    </body>
</html>