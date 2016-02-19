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
        <link type="text/css" rel="stylesheet" href="lightslider.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script src="includes/lightslider.js"></script>
        <script src="includes/picturefill.min.js" async></script>
        <script src="includes/scripts.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <header>
                <a id="logo" href="#"></a>
                    <form action="#" method="GET" id="searchBox">
                        <input type="search" placeholder="אני רוצה לבשל..." results="3" autosave="saved-searches">
                    </form>
                    <a id="logged" href="#">ברוך הבא,
                        <strong>
                            <?php
                                echo $_SESSION['username'];
                            ?>
                        </strong>
                    </a>
                <div class="clear"></div>
            </header>
            <main>
                <nav id="mainNav" class="navbar-inverse navbar-static-top" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav nav-tabs nav-justified navbar-nav">
                                <li class="active"><a href="home.php">המתכונים שאהבתי</a></li>
                                <li><a href="home.php">מתכונים שערכתי</a></li>
                                <li><a href="home.php">נצפה לאחרונה</a></li>
                            </ul>
                        </div>
                </nav>
<!--                <nav id="mainNav">-->
<!--                    <ul class="nav nav-tabs nav-justified">-->
<!--                        <li role="presentation" class="active"><a href="#">המתכונים שאהבתי</a></li>-->
<!--                        <li role="presentation"><a href="#">מתכונים שערכתי</a></li>-->
<!--                        <li role="presentation"><a href="#">נצפה לאחרונה</a></li>-->
<!--                    </ul>-->
<!--                </nav>-->
                <section id="gallery">
                    <ul id="responsive">
                        <li>
                            <a href="#">
                                <img src="" alt="">
                                <h3></h3>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="" alt="">
                                <h3></h3>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="" alt="">
                                <h3></h3>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="" alt="">
                                <h3></h3>
                            </a>
                        </li>
                    </ul>
                </section>
                <section id="feed">
                    <article id="weeklyRecipe">
                        <picture>
                            <!--[if IE 9]><video style="display: none;"><![endif]-->
                            <source srcset="./images/cake.jpg" media="(min-width: 1000px)" title="מתכון השבוע">
                            <source srcset="./images/cake_large.jpg" media="(max-width: 999px)" title="מתכון השבוע">
                            <!--[if IE 9]></video><![endif]-->
                            <img srcset="./images/cake.jpg" alt="מתכון השבוע" title="מתכון השבוע">
                        </picture>
                        <section>
                            <h2>מתכון השבוע</h2>
                            <section  id="content">
                                <h4>סופלה שוקולד</h4>
                                <h4 id="editor">מאת <a href="#">שלום לוי</a></h4>
                                <p>סופלה שוקולד קל ומהיר להכנה...</p>
                            </section>
                        </section>
                        <div class="clear"></div>
                    </article>
                    <article id="topWriters">
                        <section>
                            <h2>כותבים מובילים</h2>
                            <ol>
                                <li><a href="#">שלום לוי</a></li>
                                <li><a href="#">לירן כהן</a></li>
                                <li><a href="#">איציק בר</a></li>
                                <li><a href="#">אהובה רוזנשטיין</a></li>
                                <li><a href="#">גלעד ארדן</a></li>
                            </ol>
                        </section>
                    </article>
                    <div class="clear"></div>
                </section>
                <div class="clear"></div>
            </main>
            <section id="tools">
                <a id="addBtn" href="recipe.php?edit_mode=true" class="btn">
                    <span>הוסף מתכון</span>
                    <svg id="plus_icon" xmlns="http://www.w3.org/2000/svg" version="1.1" x="0px" y="0px" viewBox="0 0 100 125"
                         enable-background="new 0 0 100 100" xml:space="preserve">
                        <path fill="#000000" d="M50,5C25.2,5,5,25.2,5,50s20.2,45,45,45s45-20.2,45-45S74.8,5,50,5z M77,54.5H54.5V77h-9V54.5H23v-9h22.5V23  h9v22.5H77V54.5z"/>
                    </svg>
                </a>
                <ul id="searchMenu">
                    <li id="category" class="close">
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
        </div>
        <script>
            (function(){
                init();
            })();
        </script>
    </body>
</html>