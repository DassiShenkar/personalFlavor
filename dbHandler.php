<?php
    include 'db.php';

    session_start();
    $username = $_SESSION['username'];

    function login($username, $password){
        include('db.php');
        if(isset($connection)){
            $query = "SELECT *
                      FROM tbl_users_53
                      WHERE username = '$username'
                      AND password = '$password'";
            $result = mysqli_query($connection, $query);
        }
        $row = mysqli_fetch_assoc($result);

        if(isset($connection)){
            mysqli_close($connection);
            unset($connection);
        }
        if ($row['userID'] == '0'){
            return array('status' => 'OK', 'uid' => $row['userID']);
        } else {
            return array('status' => 'User not found', 'uid' => null);
        }
    }

if (isset($_POST['category'])) {
    include 'db.php';
    $category = $_POST['category'];
    if (isset($connection)) {
        $query = "SELECT id, title, image
                          FROM tbl_recipe_53
                          WHERE category = '$category'";
        $result = mysqli_query($connection, $query);
        $json = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $json[$row['id']] = array(
                'title' => $row['title'],
                'image' => $row['image']
            );
        }
        echo json_encode($json);
    }
}

//function getRecipesByCategory($category){
//    include 'db.php';
//    if (isset($connection)) {
//        $query = "SELECT id, title, image
//                          FROM tbl_recipe_53
//                          WHERE category = '$category'";
//        $result = mysqli_query($connection, $query);
//        while ($row = mysqli_fetch_assoc($result)) {
//            $recipes[] = $row;
//        }
//        return array('status' => 'OK', 'recipes' => $recipes);
//    }
//}

//    function saveRecipe($editor) {
//        include ('db.php');
//        $rid = ;
//        $title = $_POST['title'];
//        $category = $_POST['category'];
//        $ingredients = $_POST['ingredients'];
//        $preparation = $_POST['$preparation'];
//        $image = $_POST['image'];
//
//        if(isset($connection)) {
//            $query = "SELECT  id
//                      FROM tbl_recipe_53
//                      WHERE id = '$rid'";
//            $result = mysqli_query($connection, $query);
//            $row = mysqli_fetch_assoc($result);
//            if(! $row){
//                $query = "INSERT INTO tbl_recipe_53(title, editorID, category, ingredients, preparation, image)
//						  VALUES('$title', '$editor', '$category', '$ingredients', '$preparation', '$image')";
//                mysqli_query($connection, $query);
//            }
//        }
//
//    }
?>
