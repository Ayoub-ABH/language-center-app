<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changement de mot de passe</title>
    <link rel="stylesheet" type="text/css" href="css/log.css?v=1.0">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <img src="img/logo_min.png" alt="Logo" class="logo">
            <h1>Willkommen</h1>
            <form action="etudiant_controller.php" class="form" method="POST">
                <?php
                    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                        echo '<h6 class="bg-danger  text-white"> ' . $_SESSION['status'] . ' </h6>';
                        unset($_SESSION['status']);
                    }
                ?>
                <input type="password" name="ancien_mot_de_passe" id="" placeholder="Ancien mot de passe" value="<?php echo isset($_SESSION['ancien_mot_de_passe']) ? $_SESSION['ancien_mot_de_passe'] : ''; ?>"> <br>
                <input type="password" name="nouveau_mot_de_passe" id="" placeholder="Nouveau mot de passe"> <br>
                <button type="submit" name="changer_mdp_btn" id="changer_mdp">Changer le mot de passe</button>
            </form>
        </div>
    </div>


    <script src="script.js" src="js/log.js"></script>
</body>

</html>
<?php
include 'includes/scripts.php';
?>