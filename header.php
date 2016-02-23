<!DOCTYPE html>
<html>
<head>
</head>
<body>
<header>
    <section id="logo">
        <a href="home.php"></a>
        <h1>טעם אישי</h1>
        <h6>כי לכל אחד יש טעם משלו</h6>
    </section>
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
</body>
</html>