<?php

session_start();
if (isset($_SESSION['username'])){
    header('location: dashboard.php');
}
// include 'includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css"  href="css/log.css?v=1.0">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <h1>Welcome</h1>
            <form  action="code.php" class="form" method="POST">
                    <?php
                            if(isset($_SESSION['status']) && $_SESSION['status'] !='')
                            {
                                echo '<h6 class="bg-danger  text-white"> '.$_SESSION['status'].' </h6>';
                                unset($_SESSION['status']);
                            }

                ?>
          
                <input type="text" name="user" id="" placeholder="Username"> <br>
                <input type="password" name="pass" id="" placeholder="Password"> <br>
                <button type="submit" name="login_btn" id="login">Log In</button>
            </form>
        </div>
    </div>


    <script src="script.js" src="js/log.js"></script>
</body>
</html>
<?php
include 'includes/scripts.php';
?>