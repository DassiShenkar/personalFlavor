<?php
    include ('dbHandler.php');
    $username = null;
    $password = null;

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['username']) && isset($_POST["password"])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $response = login($username, $password);

            if($response['status'] == 'OK') {
                $_SESSION['username'] = $username;
                $_SESSION['userID'] = $response['uid'];
                $url = "home.php";
                header("Location:".$url);
            }
            else {
                $error = "index.php?error=".$response['status'];
                header("Location:".$error);
            }
        }
        else {
            header('Location: index.php');
        }
    }
    else {
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, initial-scale = 1.0">
        <title>טעם אישי - כניסה או הרשמה</title>
        <link rel="stylesheet" href="includes/style.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="includes/picturefill.min.js" async></script>
        <script src="includes/scripts.js"></script>
    </head>
    <body id="loginPage">
        <div id="wrapper">
            <header>
                <a id="logo" href="#"></a>
                    <form action="#" method="GET" id="searchBox" class="hide">
                        <input type="search" placeholder="אני רוצה לבשל..." results="3" autosave="saved-searches">
                    </form>
                    <a id="logged" href="#" class="hide">ברוך הבא,
                        <strong>בר ירון</strong>
                    </a>
                <div class="clear"></div>
            </header>
            <main>
                 <form id="login" method="post" autocomplete="on" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                    <label for="username">
                        <span>שם משתמש</span>
                        <input id="username" name="username" type="text" autofocus  required placeholder="שם משתמש" title="שם משתמש" >
                    </label>
                    <label for="password">
                        <span>סיסמא</span>
                        <input id="password" name="password" type="password" required placeholder="********" title="יסמא" >
                    </label>
                    <input type="submit" value="הרשם">
                     <p id="response">
                         <?php
                            if(isset($_GET["error"])) {
                                echo $_GET["error"];
                            }
                         ?>
                     </p>
                </form>
                <footer class="hide">
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
            <div class="clear"></div>
        </div>
        <script>
            (function(){
                init();
            })();
        </script>
    </body>
</html>
<?php } ?>