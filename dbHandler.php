<?php
session_start();

function login($username, $password)
{
    include('db.php');
    if (isset($connection)) {
        $query = "SELECT userID
                      FROM tbl_users_53
                      WHERE username = '$username'
                      AND password = '$password'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        if (isset($connection)) {
            mysqli_close($connection);
            unset($connection);
        }
        if (!$row) {
            $response = array('status' => 'FAILED', 'userID' => 'משתמש לא קיים. נסה שוב');
            return $response;
        } else {
            $uid = $row['userID'];
            $response = array('status' => 'OK', 'userID' => $uid);
            return $response;
        }
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
        case 'getWeeklyRecipe':
            getWeeklyRecipe();
            break;
        case 'getTopWriters':
            getTopWriters();
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
        case 'logout':
            logout();
            break;
    }
    if (isset($connection)) {
        mysqli_close($connection);
        unset($connection);
    }
}

function getRecipesByCategory()
{
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

function getWeeklyRecipe()
{
    include 'db.php';
    if (isset($connection)) {
        $query = "SELECT title, image, editorID, preparation, username
                  FROM tbl_recipe_53
                  INNER JOIN tbl_users_53
                  ON tbl_recipe_53.isWeekly = 1
                  AND tbl_recipe_53.editorID = tbl_users_53.userID";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        if (isset($connection)) {
            mysqli_close($connection);
            unset($connection);
        }
        echo json_encode($row);
    }
}

function getTopWriters()
{
    include 'db.php';
    if (isset($connection)) {
        $query = "SELECT editorID, username, count(editorID) as occurrence
                  FROM tbl_recipe_53
                  INNER JOIN tbl_users_53
                  ON tbl_recipe_53.editorID = tbl_users_53.userID
                  GROUP  BY editorID
                  ORDER BY occurrence DESC
                  LIMIT 5";
        $result = mysqli_query($connection, $query);
        $json = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $json[$row['editorID']] = array(
                'username' => $row['username'],
            );
        }
        if (isset($connection)) {
            mysqli_close($connection);
            unset($connection);
        }
        echo json_encode($json);
    }
}

function saveRecipe()
{
    include 'db.php';

    $title = $_POST['title'];
    $uid = $_SESSION['userID'];
    $category = $_POST['category'];
    $ingredients = $_POST['ingredients'];
    $preparation = $_POST['preparation'];
    $image = $_POST['imageUrl'];

    if (isset($_POST['rid'])) {
        $recipeID = $_POST['rid'];
        if (isset($connection)) {
            $query = "SELECT *
                      FROM tbl_recipe_53
                      WHERE id = '$recipeID'";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result);
            if (!$row) {
                $query = "INSERT INTO tbl_recipe_53(title, editorID, category, ingredients, preparation, image)
                              VALUES('$title', '$uid', '$category', '$ingredients', '$preparation', '$image')";
                mysqli_query($connection, $query);
                echo 'id not found: inserted' . json_encode($row);
            } else {
                $query = "SELECT *
                      FROM tbl_recipe_53
                      WHERE id = '$recipeID'
                      AND editorID = '$uid'
                      AND title = '$title'
                      AND category = '$category'
                      AND ingredients = '$ingredients'
                      AND preparation = '$preparation'
                      AND image = '$image'
                      ";
                $result = mysqli_query($connection, $query);
                $row = mysqli_fetch_assoc($result);
                if (!$row) {
                    $query = "UPDATE tbl_recipe_53
                              SET editorID = '$uid',
                                  title='$title',
                                  category = '$category',
                                  ingredients = '$ingredients',
                                  preparation = '$preparation',
                                  image = '$image'
                              WHERE id = '$recipeID'";
                    $result = mysqli_query($connection, $query);
                    echo json_encode($result);

                } else {
                    echo json_encode($result);
                }
            }
        }
    } else {
        if (isset($connection)) {
            $editorID = $_SESSION['userID'];
            $query = "INSERT INTO tbl_recipe_53(title, editorID, category, ingredients, preparation, image)
                              VALUES('$title', '$editorID', '$category', '$ingredients', '$preparation', '$image')";
            $result = mysqli_query($connection, $query);
        }
        echo 'no id. created new' . json_encode($result);
    }

    if (isset($connection)) {
        mysqli_close($connection);
        unset($connection);
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
        $query = "SELECT id, title, image
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
        $query = "SELECT id, title, image
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
