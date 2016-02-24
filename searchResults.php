<?php
include 'dbHandler.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, initial-scale = 1.0">
        <title>טעם אישי - תוצאות חיפוש</title>
        <link rel="stylesheet" href="includes/style.css">
        <link href='https://fonts.googleapis.com/css?family=Arimo:700&subset=hebrew,latin' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
              integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
                integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
                crossorigin="anonymous"></script>
        <script src="includes/scripts.js"></script>
    </head>
    <body id="searchResults">
    <div id="wrapper">
        <?php include("header.php"); ?>
        <main>
            <nav id="breadcrumbs">
                <ul>
                    <li><a href="index.php">עמוד הבית</a></li>
                </ul>
            </nav>
            <form action="#" method="POST" id="sortBy">
                <h3>מיין לפי</h3>
                <input type="radio" name="sortBy" value="watched" id="watched" checked>
                <label for="watched">נצפה</label>
                <input type="radio" name="sortBy" value="popular" id="popular">
                <label for="popular">פופולריות</label>
                <input type="radio" name="sortBy" value="date" id="date">
                <label for="date">תאריך </label>
                <input type="radio" name="sortBy" value="difficulty" id="difficulty">
                <label for="difficulty">רמת קושי</label>
            </form>
            <section id="results">
                <ul class="thumbs">
                </ul>
            </section>
        </main>
        <?php include("toolbar.php"); ?>
        <div class="clear"></div>
        <?php include("footer.php"); ?>
        <div class="clear"></div>
    </div>
    <script>
        (function () {
            init();
        })();
    </script>
    </body>
</html>
