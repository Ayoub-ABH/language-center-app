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

if(isset($_POST['AjouterFichier'])) 
{
    $user_id = $_SESSION['EtudiantID'];
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));



    $upload_folder = 'upload/diplomes/';

    if (empty($_FILES['file']['name'])) {
        $_SESSION['status'] = "Aucun fichier sélectionné";
        header('location: etudiant_fichiers.php');
        exit;
    }
    // Check file size and type
    if ($file_type !== 'pdf') {
        $_SESSION['status'] = "Le fichier doit être un PDF";
        header('location: etudiant_fichiers.php');
        exit;
    }
    if ($file_size > 6 * 1024 * 1024) {
        $_SESSION['status'] = "Le fichier doit être moins de 6 Mo";
        header('location: etudiant_fichiers.php');
        exit;
    }
    // Generate a unique file name
    $new_file_name = uniqid() .'_'. $file_name;
    $path = $upload_folder . $new_file_name;
    
    $query = "INSERT INTO fichiers (path, name, userID, uploadDateTime) VALUES ('$path', '$new_file_name', $user_id, NOW())";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        if (move_uploaded_file($file_tmp, $upload_folder . $new_file_name)) {
            $_SESSION['success'] = "Le fichier a été ajouté avec succès";
            header('location: etudiant_fichiers.php');
        } else {
            // File not saved
            $_SESSION['status'] = "Une erreur s'est produite lors de l'enregistrement du fichier";
            header('location: etudiant_fichiers.php');
        }
    } else {
        $_SESSION['status'] = "Une erreur s'est produite lors de l'ajout du fichier";
        header('location: etudiant_fichiers.php');
    }
}

if(isset($_POST['supprimerFichier']))
{

    $file_id = $_POST['fichierID'];
    $file_path = $_POST['fichierPath'];


    echo $file_id;
    $query = "DELETE FROM fichiers WHERE fileID = $file_id";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        if (unlink($file_path)) {
            $_SESSION['success'] = "Le fichier a été supprimé avec succès";
            header('location: etudiant_fichiers.php');
        } else {
            $_SESSION['status'] = "Une erreur s'est produite lors de la suppression du fichier";
            header('location: etudiant_fichiers.php');
        }
    } else {
        $_SESSION['status'] = "Une erreur s'est produite lors de la suppression du fichier";
        header('location: etudiant_fichiers.php');
    }
}


?>