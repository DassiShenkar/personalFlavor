<?php
    include_once 'dbHandler.php';
    if(isset($_POST['category']) && strlen(trim($_POST["category"])) > 0) {
        $result = getRecipesByCategory($_POST['category']);
        if($result['status'] == 'OK') {
            echo $result['recipes'];
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title; ?></title>
</head>
<body>
<section id="tools">
    <a id="addBtn" href="recipe.php?edit_mode=true" class="btn">
        <span>הוסף מתכון</span>
        <svg id="plus_icon" xmlns="http://www.w3.org/2000/svg" version="1.1" x="0px" y="0px" viewBox="0 0 100 125"
                         enable-background="new 0 0 100 100" xml:space="preserve">
                        <path fill="#000000" d="M50,5C25.2,5,5,25.2,5,50s20.2,45,45,45s45-20.2,45-45S74.8,5,50,5z M77,54.5H54.5V77h-9V54.5H23v-9h22.5V23  h9v22.5H77V54.5z"/>
                    </svg>
    </a>
    <ul id="searchMenu">
        <li id="category">
            <h3 id="category-title" class="initial">מה מבשלים ?</h3>
            <section id="category-list" class="hide">
            </section>
        </li>
        <li id="style">
            <h3 id="style-title" class="initial">סגנון ?</h3>
            <section id="style-list" class="hide"></section>
        </li>
        <li id="level">
            <h3 id="level-title"  class="initial">רמת קושי ?</h3>
            <section id="level-list" class="hide"></section>
        </li>
        <li id="ingredient">
            <h3 id="ingredient-title" class="initial">בחר מצרכים</h3>
            <section id="ingredient-list">
                <input type="text" class="searchBoxWithImg" placeholder="בא לי במתכון...">
            </section>
        </li>
    </ul>
    <input type="submit" value="חפש" id="searchBtn" href="#" class="btn">
</section>
</body>
</html>