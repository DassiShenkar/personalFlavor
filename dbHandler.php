<?php
session_start();
$username = $_SESSION['username'];

function login($username, $password)
{
    include('db.php');
    if (isset($connection)) {
        $query = "SELECT *
                      FROM tbl_users_53
                      WHERE username = '$username'
                      AND password = '$password'";
        $result = mysqli_query($connection, $query);
    }
    $row = mysqli_fetch_assoc($result);

    if (isset($connection)) {
        mysqli_close($connection);
        unset($connection);
    }

    if ($row['userID'] == '0') {
        return array('status' => 'OK');
    } else {
        return array('status' => 'User not found');
    }
}

if (isset($_POST['action'])) {
    include 'db.php';
    $action = $_POST['action'];
    switch ($action) {
        case 'getRecipe':
            getRecipeById();
            break;
        case 'getByCategory':
            getRecipesByCategory();
            break;
        case 'saveRecipe':
            saveRecipe();
            break;
        case 'like':
            addFavorite();
            break;
        case 'getFavorites':
            getFavorites();
            break;
        case 'getMyRecipes':
            getMyRecipes();
            break;
    }
    if (isset($connection)) {
        mysqli_close($connection);
        unset($connection);
    }
}

function getRecipesByCategory(){
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
            if (isset($connection)) {
                mysqli_close($connection);
                unset($connection);
            }
            echo json_encode($json);
        }
    }
}

function getRecipeById()
{
    if (isset($_POST['rid'])) {
        include 'db.php';
        $rid = $_POST['rid'];
        if (isset($connection)) {
            $query = "SELECT *
                  FROM tbl_recipe_53
                  WHERE id = '$rid'";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result);
            if (isset($connection)) {
                mysqli_close($connection);
                unset($connection);
            }
            echo json_encode($row);
        }
    }
}

function saveRecipe()
{
    include 'db.php';
    $recipeID = $_POST['rid'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $ingredients = $_POST['ingredients'];
    $preparation = $_POST['preparation'];
    $image = $_POST['imageUrl'];

    if (isset($connection)) {
        $query = "SELECT *
                      FROM tbl_recipe_53
                      WHERE title = '$title'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        if (!$row) {
            $editorID = $_SESSION['userID'];
            $query = "INSERT INTO tbl_recipe_53(title, editorID, category, ingredients, preparation, image)
                              VALUES('$title', '$editorID', '$category', '$ingredients', '$preparation', '$image')";
            mysqli_query($connection, $query);
        }
        if (isset($connection)) {
            mysqli_close($connection);
            unset($connection);
        }
        echo 'success';
    }
}

function addFavorite()
{
    include 'db.php';
    $rid = $_POST['rid'];
    $uid = $_SESSION['userID'];

    if (isset($connection)) {
        $query = "SELECT *
                  FROM tbl_favorite_53
                  WHERE userID = '$uid'
                  AND recipeID = '$rid'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        if (!$row) {
            $query = "INSERT INTO tbl_favorite_53(userID, recipeID)
                              VALUES('$uid', '$rid')";
            mysqli_query($connection, $query);
        }
        if (isset($connection)) {
            mysqli_close($connection);
            unset($connection);
        }
        echo 'success';
    }
}

function getFavorites()
{
    include 'db.php';
    $uid = $_SESSION['userID'];
    if (isset($connection)) {
        $query = "SELECT *
                  FROM tbl_recipe_53
                  WHERE id in (
                    SELECT recipeID
                    FROM tbl_favorite_53
                    WHERE userID = '$uid')";

        $result = mysqli_query($connection, $query);
        $json = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $json[$row['id']] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'image' => $row['image']
            );
        }
        if (isset($connection)) {
            mysqli_close($connection);
            unset($connection);
        }
        echo json_encode($json);
    }
}

function getMyRecipes()
{
    include 'db.php';
    $uid = $_SESSION['userID'];
    if (isset($connection)) {
        $query = "SELECT *
                  FROM tbl_recipe_53
                  WHERE editorID = '$uid'";

        $result = mysqli_query($connection, $query);
        $json = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $json[$row['id']] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'image' => $row['image']
            );
        }
        if (isset($connection)) {
            mysqli_close($connection);
            unset($connection);
        }
        echo json_encode($json);
    }
}

?>
