<?php
    include ('dbHandler.php');
    $username = null;
    $password = null;

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['username']) && isset($_POST["password"])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $response = login($username, $password);

            if($response == 'OK') {
                $_SESSION['username'] = $username;
                $_SESSION['userID'] = $response['uid'];
                $url = "home.php";
                header("Location:".$url);
            }
            else {
                $error = "index.php?error=".$response;
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
        <title>טעם אישי - כניסת משתמש</title>
        <link href='https://fonts.googleapis.com/css?family=Arimo:700&subset=hebrew,latin' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="includes/style.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="includes/scripts.js"></script>
    </head>
    <body id="loginPage">
        <div id="wrapper">
            <header>
                <section id="logo">
                    <a href="#"></a>
                    <h1>טעם אישי</h1>
                    <h6>כי לכל אחד יש טעם משלו</h6>
                </section>
            </header>
            <main>
                 <form id="login" method="post" autocomplete="on" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
                    <label for="username">
                        <span>שם משתמש</span>
                        <input type="text" id="username" name="username"  autofocus  required placeholder="שם משתמש" title="שם משתמש" >
                    </label>
                    <label for="password">
                        <span>סיסמא</span>
                        <input type="password" id="password" name="password"  required placeholder="********" title="סיסמא">
                    </label>
                    <input type="submit" class="btn" value="התחבר">
                     <p id="response">
                         <?php
                            if(isset($_GET["error"])) {
                                echo $_GET["error"];
                            }
                         ?>
                     </p>
                </form>
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