<?php
include ('dbconfig.php');
session_start();




if (isset ($_POST['modiferEtudiant'])) {
    if (isset ($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $etudiant_id = $_SESSION['EtudiantID'];
        $etudiant_name = $_POST['etudiant_nom'];
        $etudiant_prenom = $_POST['etudiant_prenom'];
        $etudiant_cin = $_POST['cin'];
        $etudiant_email = $_POST['email'];
        $etudiant_tele = $_POST['tele'];
        $etudiant_adresse = $_POST['adresse'];
        $niveau_etude = $_POST['niveau_etude'];
        $serie_bac = $_POST['serie_bac'];
        $annee_bac = $_POST['annee_bac'];
        $intitule_diplome = $_POST['intitule_diplome'];
        $annee_diplome = $_POST['annee_diplome'];
        $specialite = $_POST['specialite'];
        $filename = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $destination = 'upload/images/' . $filename;
        move_uploaded_file($tmp_name, $destination);

        // Check if all attributes are not empty
        if (!empty ($etudiant_name) && !empty ($etudiant_prenom) && !empty ($etudiant_cin) && !empty ($etudiant_email) && !empty ($etudiant_tele) && !empty ($etudiant_adresse)) {
            $query = "UPDATE etudiants SET 
                  Etudiant_name = '$etudiant_name', 
                  Etudiant_prenom = '$etudiant_prenom', 
                  CIN = '$etudiant_cin', 
                  Email = '$etudiant_email', 
                  Tele = '$etudiant_tele', 
                  Adresse = '$etudiant_adresse', 
                  niveau_etude = '$niveau_etude', 
                  serie_bac = '$serie_bac', 
                  annee_bac = '$annee_bac', 
                  intitule_diplome = '$intitule_diplome', 
                  annee_diplome = '$annee_diplome', 
                  Specialite = '$specialite' , 
                  Image = '$filename'
                  WHERE EtudiantID = $etudiant_id";
                   
            $query_run = mysqli_query($connection, $query);
           

            if ($query_run) {
                $_SESSION['success'] = "Votre information est mise à jour avec succès" . mysqli_error($connection);
                header('location: etudiant_espace.php');
            } else {
                $_SESSION['status'] = "Votre information n'est pas mise à jour" . mysqli_error($connection);
                header('location: etudiant_espace.php');
            }
        } else {
            $_SESSION['status'] = "Veuillez remplir tous les champs";
            header('location: etudiant_espace.php');
        }
    }
}


if (isset ($_POST['AjouterFichier'])) {
    $user_id = $_SESSION['EtudiantID'];
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));





    $upload_folder = 'upload/diplomes/';

    if (empty ($_FILES['file']['name'])) {
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
    $uniq_file_name = uniqid() . '_' . $file_name;
    $path = $upload_folder . $uniq_file_name;

    $query = "INSERT INTO fichiers (path, name, userID, uploadDateTime) VALUES ('$path', '$file_name', $user_id, NOW())";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        if (move_uploaded_file($file_tmp, $upload_folder . $uniq_file_name)) {
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

if (isset ($_POST['supprimerFichier'])) {

    $file_id = $_POST['fichierID'];
    $file_path = $_POST['fichierPath'];


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


if (isset ($_POST['downloadFichier'])) {
    $file_id = $_POST['fichierID'];
    $file_path = $_POST['fichierPath'];

    if (file_exists($file_path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    } else {
        $_SESSION['status'] = "Le fichier n'existe pas";
        header('location: etudiant_fichiers.php');
    }

}

// login
if (isset ($_POST['login_btn'])) {
    $cin = $_POST['cin'];
    $password = $_POST['password'];

    $query = "SELECT * FROM etudiants WHERE CIN = '$cin' AND Password = '$password'";
    $query_run = mysqli_query($connection, $query);

    if (mysqli_num_rows($query_run) > 0) {
        // valid
        $row = mysqli_fetch_assoc($query_run);
        $_SESSION['EtudiantID'] = $row['EtudiantID'];
        $_SESSION['Etudiant_name'] = $row['Etudiant_name'];
        header('location: etudiant_update_password.php');
    } else {
        // invalid
        $_SESSION['status'] = "CIN ou mot de passe incorrect";
        header('location: etudiant_log.php');
    }
}

// logout
if (isset ($_POST['logout_btn'])) {
    session_destroy();
    unset($_SESSION['EtudiantID']);
    unset($_SESSION['Etudiant_name']);
    header('location: etudiant_log.php');
}







// changement de mot de passe 
if (isset($_POST['changer_mdp_btn'])) {
   
    if (isset($_POST['ancien_mot_de_passe'], $_POST['nouveau_mot_de_passe']) && !empty($_POST['ancien_mot_de_passe']) && !empty($_POST['nouveau_mot_de_passe'])) {
        
        $ancien_mot_de_passe = $_POST['ancien_mot_de_passe'];
        $nouveau_mot_de_passe = $_POST['nouveau_mot_de_passe'];

        $ancien_mot_de_passe = mysqli_real_escape_string($connection, $ancien_mot_de_passe);
        $nouveau_mot_de_passe = mysqli_real_escape_string($connection, $nouveau_mot_de_passe);

        $etudiant_id = $_SESSION['EtudiantID'];

        $query = "SELECT * FROM etudiants WHERE EtudiantID = '$etudiant_id' AND Password = '$ancien_mot_de_passe'";
        $query_run = mysqli_query($connection, $query);

        if (mysqli_num_rows($query_run) == 1) { 
            $update_query = "UPDATE etudiants SET Password = '$nouveau_mot_de_passe' WHERE EtudiantID = '$etudiant_id'";
            if (mysqli_query($connection, $update_query)) {
                $_SESSION['status'] = "Le mot de passe a été mis à jour avec succès.";
            } else {
                $_SESSION['status'] = "Erreur lors de la mise à jour du mot de passe: " . mysqli_error($connection);
            }
        } else {
            $_SESSION['status'] = "L'ancien mot de passe est incorrect.";
        }
    } else {
        $_SESSION['status'] = "Veuillez remplir tous les champs.";
    }

    header('location: etudiant_espace.php');
    exit();
} else {
    header('location: etudiant_log.php'); 
    exit();
}

?>
