<?php
include 'dbHandler.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, initial-scale = 1.0">
        <title>טעם אישי</title>
        <link rel="stylesheet" href="includes/style.css">
        <link type="text/css" rel="stylesheet" href="lightslider.css"/>
        <link href='https://fonts.googleapis.com/css?family=Arimo:700&subset=hebrew,latin' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
              integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
                integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
                crossorigin="anonymous"></script>
        <script src="includes/lightslider.js"></script>
        <script src="includes/picturefill.min.js" async></script>
        <script src="includes/scripts.js"></script>
    </head>
    <body>
    <div id="wrapper">
        <?php include("header.php"); ?>
        <main>
            <nav id="mainNav" class="navbar-inverse navbar-static-top">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav nav-tabs nav-justified navbar-nav">
                        <li id="favorites" class="active">המתכונים שאהבתי</li>
                        <li id="myRecipes" class="">מתכונים שערכתי</li>
                        <li id="recentlyViewed" class="">נצפה לאחרונה</li>
                    </ul>
                </div>
            </nav>
            <section id="gallery">
            </section>
            <section id="feed">
                <article id="topWriters">
                    <h2>כותבים מובילים</h2>
                    <ol></ol>
                </article>
                <article id="weeklyRecipe">
                </article>
            </section>
            <div class="clear"></div>
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