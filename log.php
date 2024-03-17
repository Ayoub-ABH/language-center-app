<<<<<<< HEAD
=======
<?php

session_start();
if (isset($_SESSION['username'])) {
    header('location: dashboard.php');
}
// include 'includes/header.php';
?>
>>>>>>> a8a4c66109726189c9ae83bb2012ccb0140e87db
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="css/log.css?v=1.0">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <img src="img/logo_min.png" alt="Logo" class="logo">
            <h1>Willkommen</h1>
            <form action="code.php" class="form" method="POST">
                <?php
<<<<<<< HEAD
                session_start();
=======
>>>>>>> a8a4c66109726189c9ae83bb2012ccb0140e87db
                if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                    echo '<h6 class="bg-danger  text-white"> ' . $_SESSION['status'] . ' </h6>';
                    unset($_SESSION['status']);
                }
<<<<<<< HEAD
                ?>
                <div class="styled-select">
                    <select id="userType" name="user_type">
                        <option value="admin" selected>Espace Administrateur</option>
                        <option value="student">Espace Étudiant</option>
                        <option value="teacher">Espace Enseignant</option>
                    </select>
                </div>
=======

                ?>

>>>>>>> a8a4c66109726189c9ae83bb2012ccb0140e87db
                <input type="text" name="user" id="" placeholder="Username"> <br>
                <input type="password" name="pass" id="" placeholder="Password"> <br>
                <button type="submit" name="login_btn" id="login">Log In</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById("userType").addEventListener("change", function () {
            var userType = this.value;
            if (userType === "student") {
                window.location.href = "etudiant_log.php"; 
            }
        });

        document.getElementById("login").addEventListener("click", function () {
            document.querySelector("form").submit();
        });
    </script>
</body>

</html>
