<?php
include('dbconfig.php');
session_start();




if (isset($_POST['registerbtn'])) {

    // Informations de l'étudiant
    $etudiant_nom = $_POST['etudiant_nom'];
    $etudiant_prenom = $_POST['etudiant_prenom'];
    $cin = $_POST['cin'];
    $email = $_POST['email'];
    $tele = $_POST['tele'];
    $adresse = $_POST['adresse'];

    // Chemin de sauvegarde des fichiers
    $uploadPath = 'uploads/';

    // Traitement du fichier CV
    $cvFileName = $_FILES['cv']['name'];
    $cvTempName = $_FILES['cv']['tmp_name'];
    $cvFilePath = $uploadPath . $cvFileName;
    move_uploaded_file($cvTempName, $cvFilePath);

    // Traitement des fichiers de diplômes
    $diplome1FileName = $_FILES['diplome1']['name'];
    $diplome1TempName = $_FILES['diplome1']['tmp_name'];
    $diplome1FilePath = $uploadPath . $diplome1FileName;
    move_uploaded_file($diplome1TempName, $diplome1FilePath);

    $diplome2FileName = $_FILES['diplome2']['name'];
    $diplome2TempName = $_FILES['diplome2']['tmp_name'];
    $diplome2FilePath = $uploadPath . $diplome2FileName;
    move_uploaded_file($diplome2TempName, $diplome2FilePath);

    // Insérer les données dans la base de données
    $query = "INSERT INTO etudiants (Etudiant_name, Etudiant_prenom, CIN, Email, Tele, Adresse, CV, Diplome1, Diplome2) 
              VALUES ('$etudiant_nom', '$etudiant_prenom', '$cin', '$email', '$tele', '$adresse', '$cvFilePath', '$diplome1FilePath', '$diplome2FilePath')";

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Étudiant enregistré avec succès";
        header('Location: your_success_page.php');
    } else {
        $_SESSION['status'] = "Erreur lors de l'enregistrement de l'étudiant";
        header('Location: your_error_page.php');
    }
}

?>




