<?php
include ('dbconfig.php');
session_start();



// login
if (isset ($_POST['login_btn'])) {
    $cin = $_POST['cin'];
    $password = $_POST['password'];

    $query = "SELECT * FROM professeurs WHERE CIN = '$cin' AND Password = '$password'";
    $query_run = mysqli_query($connection, $query);

    if (mysqli_num_rows($query_run) > 0) {
        // valid
        $row = mysqli_fetch_assoc($query_run);
        $_SESSION['ProfesseurID'] = $row['ProfesseurID'];
        $_SESSION['Professeur_name'] = $row['Professeur_name'];
        header('location: prof_espace.php');
    } else {
        // invalid
        $_SESSION['status'] = "CIN ou mot de passe incorrect";
        header('location: prof_log.php');
    }
}

// logout
if (isset ($_POST['logout_btn'])) {
    session_destroy();
    unset($_SESSION['ProfesseurID']);
    unset($_SESSION['Professeur_name']);
    header('location: log.php');
}

?>
