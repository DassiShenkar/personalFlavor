<?php
include 'dbHandler.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, initial-scale = 1.0">
        <title></title>
        <link rel="stylesheet" href="includes/style.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="includes/scripts.js"></script>
    </head>
    <body id="searchResults">
    <div id="wrapper">
        <?php include("header.php"); ?>
        <main>
            <nav id="breadcrumbs">
                <ul>
                    <li><a href="index.php">עמוד הבית</a></li>
                    <div class="clear"></div>
                </ul>
            </nav>
            <form action="#" method="POST" id="sortBy">
                <span>מיין לפי</span>
                <label for="watched">
                    <input type="radio" name="sortBy" value="watched" id="watched" checked>
                    <span>נצפה</span>
                </label>
                <label for="popular">
                    <input type="radio" name="sortBy" value="popular" id="popular">
                    <span>פופולריות</span>
                </label>
                <label for="date">
                    <input type="radio" name="sortBy" value="date" id="date">
                    <span>תאריך</span>
                </label>
                <label for="level">
                    <input type="radio" name="sortBy" value="level" id="level">
                    <span>רמת קושי</span>
                </label>

            </form>
            <section id="results">
                <ul class="thumbs">
                    <div class="clear"></div>
                </ul>
            </section>
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
