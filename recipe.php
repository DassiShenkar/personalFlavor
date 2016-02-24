<?php
include 'dbHandler.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, initial-scale = 1.0">
        <title>טעם אישי - מתכון</title>
        <link href='https://fonts.googleapis.com/css?family=Arimo:700&subset=hebrew,latin' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
              integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="includes/style.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
                integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
                crossorigin="anonymous"></script>
        <script src="includes/scripts.js"></script>
    </head>
    <body id="recipe-page">
    <div id="wrapper">
        <?php include("header.php"); ?>
        <main>
            <nav id="breadcrumbs">
                <ul>
                    <li><a href="index.php">עמוד הבית</a></li>
                </ul>
            </nav>
            <form id="recipe" method="post">
                <section id="recipe_header">
                    <h1 id="recipe_title" class="view_mode"></h1>
                    <label for="edit_title" class=" edit_mode hide">
                        <h4>ערוך שם מתכון</h4>
                        <input type="text" id="edit_title" class="recipe_title" name="title" required
                               placeholder="שם המתכון">
                    </label>
                    <ul id="edit_recipe_menu" class="view_mode">
                        <li><a href="#" id="star" class="notFavorite"></a></li>
                        <li><a href="#" id="print"></a></li>
                        <li><a href="" id="edit"></a></li>
                    </ul>
                    <div class="clear"></div>
                </section>
                <section id="recipe_content">
                    <label for="edit_category" class="edit_mode hide">
                        <h4>בחר קטגוריה</h4>
                        <select name="category" id="edit_category" class="edit_mode hide"></select>
                    </label>
                    <h4 class="view_mode">חומרים</h4>
                    <p id="ingredients" class="view_mode"></p>
                    <label for="edit_ingredients" class="edit_mode hide">
                        <h4>ערוך רשימת חומרים</h4>
                        <textarea id="edit_ingredients" name="ingredients" class="ingredients edit_mode hide"
                                  rows="10"></textarea>
                    </label>
                    <h3 class="view_mode">אופן ההכנה</h3>
                    <p id="preparation" class="view_mode"></p>
                    <label for="edit_preparation" class="edit_mode hide">
                        <h4>ערוך אופן הכנה</h4>
                        <textarea id="edit_preparation" name="preparation" class="preparation edit_mode hide"
                                  rows="10"></textarea>
                    </label>
                </section>
                <img id="recipe_image" src="" alt="" title="">
                <input type="file" name="image" id="upload_image" class="edit_mode hide">
                <div class="clear"></div>
                <input id="saveBtn" type="submit" class="edit_mode hide" value="שמור">
            </form>
            <div class="clear"></div>
        </main>
        <?php include("toolbar.php"); ?>
        <div class="clear"></div>
        <?php include("footer.php"); ?>
    </div>
    <script>
        (function () {
            init();
        })();
    </script>
    </body>
</html>