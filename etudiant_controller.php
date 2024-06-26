<?php
include ('dbconfig.php');
session_start();


if (isset($_POST['modiferEtudiant'])) {
  
    $etudiant_id = $_SESSION['EtudiantID'];
    $etudiant_nom = $_POST['etudiant_nom'];
    $etudiant_prenom = $_POST['etudiant_prenom'];
    $cin = $_POST['CIN'];
    $email = $_POST['email'];
    $tele = $_POST['tele'];
    $adresse = $_POST['adresse'];
    $niveau_etude = $_POST['niveau_etude'];
    $serie_bac = $_POST['serie_bac'];
    $annee_bac = $_POST['annee_bac'];
    $intitule_diplome = $_POST['intitule_diplome'];
    $annee_diplome = $_POST['annee_diplome'];
    $specialite = $_POST['specialite'];
    $parcours_souhaite = $_POST['parcours_souhaite'];
    $mois_stage = $_POST['mois_stage'];
    $experience = $_POST['experience'];
    $mot_de_passe = $_POST['ancien_mot_de_passe'];
    $nouveau_mot_de_passe = $_POST['nouveau_mot_de_passe'];

    if (!empty($mot_de_passe) && !empty($nouveau_mot_de_passe)) {
        $query = "SELECT * FROM etudiants WHERE EtudiantID = $etudiant_id AND Password = '$mot_de_passe'";
        $query_run = mysqli_query($connection, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $query = "UPDATE etudiants SET Password = '$nouveau_mot_de_passe' WHERE EtudiantID = $etudiant_id";
            $query_run = mysqli_query($connection, $query);
        } else {
            $_SESSION['status'] = "Mot de passe incorrect";
            header('location: etudiant_espace.php');
            exit;
        }
    }

    $filename = $_FILES['image']['name'];

    if (!empty($filename)) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $destination = 'upload/images/' . $filename;
        $imageFileType = strtolower(pathinfo($destination, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $_SESSION['status'] = "Le fichier doit être une image";
            header('location: etudiant_espace.php');
            exit;
        } else if ($_FILES['image']['size'] > 6 * 1024 * 1024) {
            $_SESSION['status'] = "Le fichier doit être moins de 6 Mo";
            header('location: etudiant_espace.php');
            exit;
        } else {
            // Vérification si le fichier existe déjà
            if (!file_exists($destination)) {
                // Déplacer le fichier vers sa destination avec le nouveau nom
                move_uploaded_file($tmp_name, $destination);
                $query = "UPDATE etudiants SET Image = '$filename' WHERE EtudiantID = $etudiant_id";
                $query_run = mysqli_query($connection, $query);
            } else {
                // Renommer le fichier avec un nom unique
                $new_filename = uniqid() . '_' . $filename;
                $destination = 'upload/images/' . $new_filename;
                move_uploaded_file($tmp_name, $destination);
                $query = "UPDATE etudiants SET Image = '$new_filename' WHERE EtudiantID = $etudiant_id";
                $query_run = mysqli_query($connection, $query);
            }
        }
    }

    //print all inputs
    // foreach ($_POST as $key => $value) {
    //     echo $key . " : " . $value . "<br>";
    // }

    if (!empty($etudiant_nom) && !empty($etudiant_prenom) && !empty($cin) && !empty($tele)){

        $query = "UPDATE etudiants SET 
            Etudiant_name = '$etudiant_nom',
            Etudiant_prenom = '$etudiant_prenom',
            CIN = '$cin',
            Email = '$email',
            Tele = '$tele',
            Adresse = '$adresse',
            niveau_etude = '$niveau_etude',
            serie_bac = '$serie_bac',
            annee_bac = '$annee_bac',
            intitule_diplome = '$intitule_diplome',
            annee_diplome = '$annee_diplome',
            Specialite = '$specialite',
            parcours_souhaite = '$parcours_souhaite',
            mois_stage = '$mois_stage',
            experience = '$experience'
            WHERE EtudiantID = $etudiant_id";

        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            $_SESSION['success'] = "Vos informations ont été mises à jour avec succès.";
            header('location: etudiant_espace.php');
        } else {
            $_SESSION['status'] = "Erreur lors de la mise à jour des informations : " . mysqli_error($connection);
            header('location: etudiant_espace.php');
        }
    } else {
        $_SESSION['status'] = "Veuillez remplir tous les champs.";
        header('location: etudiant_espace.php');
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
        header('location: etudiant_espace.php');
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

?>
