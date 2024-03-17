<?php
    session_start();
    if (isset($_SESSION['EtudiantID'])) {
        header('location: etudiant_espace.php');
    }
    // include 'includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etudiant login</title>
    <link rel="stylesheet" type="text/css" href="css/log.css?v=1.0">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <img src="img/logo_min.png" alt="Logo" class="logo">
            <h1>Willkommen</h1>
<<<<<<< HEAD
=======
            <h6>Espace Etudiant</h6>
>>>>>>> a8a4c66109726189c9ae83bb2012ccb0140e87db
            <form action="etudiant_controller.php" class="form" method="POST">
                <?php
                    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                        echo '<h6 class="bg-danger  text-white"> ' . $_SESSION['status'] . ' </h6>';
                        unset($_SESSION['status']);
                    }
                ?>
                <input type="text" name="cin" id="" placeholder="CIN"> <br>
                <input type="password" name="password" id="" placeholder="Password"> <br>
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