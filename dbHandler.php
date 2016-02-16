<?php
    include('db.php');

    $first_get_query = "SELECT * FROM tbl_recipe_53 order by title desc";
    $result = mysqli_query($connection, $first_get_query);
    if(!$result) {
        die("DB query failed");
    }

    if(isset($_POST['title'])) {
        $title = mysqli_real_escape_string($connection, $_POST['title']);
        $category = mysqli_real_escape_string($connection, $_POST['category']);
        $ingredients = mysqli_real_escape_string($connection, $_POST['ingredients']);
        $preparation = mysqli_real_escape_string($connection, $_POST['preparation']);
        $image = mysqli_real_escape_string($connection, $_POST['image']);

        //SET
        $query_set = "INSERT INTO tbl_recipe_53(title, category, ingredients, preparation, image) VALUES (N'$title',N'$category' , N'$ingredients', N'$preparation', N'$image')";
        $result = mysqli_query($connection, $query_set);

        //GET
        $query_set = "SELECT * FROM tbl_recipe_53 order by title desc";
        $result = mysqli_query($connection, $query_set);
    }

    //GET
    echo "<ul>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<li><h2>" . $row["title"] . "</h2></li>";
    }
    echo "</ul>";

    mysqli_free_result($result);

    mysqli_close($connection);
?>