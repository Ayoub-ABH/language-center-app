<?php
include('dbconfig.php');
session_start();

if(isset($_POST['modiferEtudiant']))
{
    $etudiant_id = $_SESSION['EtudiantID'];
    $etudiant_name = $_POST['etudiant_nom'];
    $etudiant_prenom = $_POST['etudiant_prenom'];
    $etudiant_cin = $_POST['cin'];
    $etudiant_email = $_POST['email'];
    $etudiant_tele = $_POST['tele'];
    $etudiant_adresse = $_POST['adresse'];

    // Check if all attributes are not empty
    if(!empty($etudiant_name) && !empty($etudiant_prenom) && !empty($etudiant_cin) && !empty($etudiant_email) && !empty($etudiant_tele) && !empty($etudiant_adresse)) {
        $query = "UPDATE etudiants SET Etudiant_name = '$etudiant_name', Etudiant_prenom = '$etudiant_prenom', CIN = '$etudiant_cin', Email = '$etudiant_email', Tele = '$etudiant_tele', Adresse = '$etudiant_adresse' WHERE EtudiantID = $etudiant_id";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            $_SESSION['success'] = "Votre information est mise à jour avec succès";
            header('location: etudiant_espace.php');
        } else {
            $_SESSION['status'] = "Votre information n'est pas mise à jour";
            header('location: etudiant_espace.php');
        }
    } else {
        $_SESSION['status'] = "Veuillez remplir tous les champs";
        header('location: etudiant_espace.php');
    }
}

?>