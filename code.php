<?php
include('dbconfig.php');
session_start();




/*if (isset($_POST['payer_btn'])) {
    $etudiant_id = $_POST['etudiant_id'];
    $date_paiement = $_POST['date_paiement'];

    $insert_query = "INSERT INTO paiements (EtudiantID, DatePaiement) VALUES ('$etudiant_id', '$date_paiement')";
    $insert_query_run = mysqli_query($connection, $insert_query);

    if ($insert_query_run) {
        $_SESSION['success'] = "Paiement effectué avec succès";
    } else {
        $_SESSION['status'] = "Échec du paiement";
    }

    header('Location: Ajouter_paiement.php');
    exit(); // Assure que le script s'arrête ici pour éviter toute exécution supplémentaire
}
*/
if (isset($_POST['delete_id'])) {
    $id_to_delete = $_POST['delete_id'];

    $query = "DELETE FROM presence_table WHERE ID = '$id_to_delete'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Absence supprimée avec succès";
    } else {
        $_SESSION['status'] = "Échec de la suppression de l'absence: " . mysqli_error($connection);
    }

    header('Location: liste_absence.php');
    exit();
}



//-------------------------------------------------------------------------------


if(isset($_POST['updatebtn']))
{
    $UserID = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    $usertypeupdate = $_POST['update_usertype'];

    $query = "UPDATE users SET Username='$username',Email='$email',Password='$password',Usertype='$usertypeupdate' WHERE UserID='$UserID' ";
    $query_run = mysqli_query($connection, $query);

if($query_run){
$_SESSION['success'] = "Le utilisateur est mise à jour";
header('location: register.php');
}else{
    $_SESSION['status'] = "Le utilisateur n'est pas mise à jour";
header('location: register.php');
}
}





if(isset($_POST['delete_btn']))
{
    $UserID = $_POST['delete_id'];
    $query = "DELETE FROM users WHERE UserID='$UserID' ";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['success'] = "Le utilisateur a été supprimer";
        header('location: register.php');
        }
        else
        {
        $_SESSION['status'] = "Le utilisateur n'a pas supprimer";
        header('location: register.php');
        }

}



/*---------------------------------------------visiteurs------------------------------------------------- */
if (isset($_POST['visiteurbtn'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $cin = $_POST['cin'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $date_visite = $_POST['date_visite'];
    $niveau = $_POST['niveau'];
    $observation = $_POST['observation'];

    // Vérifier si tous les champs sont vides
    if (empty($nom) || empty($prenom) || empty($cin) || empty($email) || empty($telephone) || empty($adresse) || empty($date_visite) || empty($niveau) || empty($observation)) {
        $_SESSION['status'] = "Remplir tous les champs";
        header('location: visiteurs.php');
        exit(); 
    }

    if ($_SESSION['userType'] == "admin") {
        
    }

    $query = "INSERT INTO visiteurs (Visiteur_name, Visiteur_prenom, CIN, Email, Tele, Adresse, Date_visite, Niveau, Observation) VALUES ('$nom', '$prenom', '$cin', '$email', '$telephone', '$adresse', '$date_visite', '$niveau', '$observation')";
    $query_run = mysqli_query($connection, $query);
    
    if ($query_run) {
        $_SESSION['success'] = "Visiteur a été ajouté";
        header('location: visiteurs.php');
    } else {
        $_SESSION['status'] = "Visiteur non ajouté";
        header('location: visiteurs.php');
    }
}




if(isset($_POST['updatevbtn']))
{
  

$VisiteurID = $_POST['edit_id'];
$nom = $_POST['edit_visiteurname'];
$prenom = $_POST['edit_visiteurprenom'];
$cin = $_POST['edit_visiteurcin'];
$email = $_POST['edit_email'];
$telephone = $_POST['edit_visiteurtele'];
$adresse = $_POST['edit_visiteuradresse'];
$date_visite = $_POST['edit_visiteurdate'];
$niveau = $_POST['edit_visiteurniveau'];
$observation = $_POST['edit_visiteurobs'];

    $query = "UPDATE visiteurs SET Visiteur_name='$nom',Visiteur_prenom='$prenom',CIN='$cin',Email='$email',Tele='$telephone',Adresse='$adresse',Date_visite='$date_visite',Niveau='$niveau',Observation='$observation' WHERE VisiteurID='$VisiteurID' ";
    $query_run = mysqli_query($connection, $query);

if($query_run){
$_SESSION['success'] = "Le visiteur est mise à jour";
header('location: visiteurs.php');
}else{
    $_SESSION['status'] = "Le visiteur n'est pas mise à jour";
header('location: visiteurs.php');
}
}




if(isset($_POST['deletev_btn']))
{
    $VisiteurID = $_POST['delete_id'];
    $query = "DELETE FROM visiteurs WHERE VisiteurID='$VisiteurID' ";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['success'] = "Le visiteur a été supprimer";
        header('location: visiteurs.php');
        }
        else
        {
        $_SESSION['status'] = "Le visiteur n'a pas été supprimer";
        header('location: visiteurs.php');
        }

}



/*----------------------------etudiant------------------------------------- */

// Vérifier si le formulaire a été soumis
if (isset($_POST['etudiantbtn'])) {
    // Vérifier si les champs requis ne sont pas vides
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['cin']) && !empty($_POST['email']) && !empty($_POST['telephone']) && !empty($_POST['adresse']) && !empty($_POST['date_inscription']) && !empty($_POST['niveau']) && !empty($_POST['groupe']) && !empty($_FILES['etudiant_image']['name'])) {
        
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $cin = $_POST['cin'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];
        $date_inscription = $_POST['date_inscription'];
        $niveau = $_POST['niveau'];
        $groupe = $_POST['groupe'];
        $etudiant_image = $_FILES['etudiant_image']['name'];

        if ($_SESSION['userType'] == "admin") {
            // Traitement pour l'utilisateur admin
        }

        // Vérifier si le fichier image existe déjà
        if (file_exists("upload/" . $etudiant_image)) {
            $_SESSION['status'] = "L'image existe déjà : $etudiant_image";
            header('location: etudiants.php');
        } else {
            // Déplacer le fichier téléchargé vers le répertoire d'upload
            $target_path = "upload/" . $etudiant_image;
            move_uploaded_file($_FILES["etudiant_image"]["tmp_name"], $target_path);

            // Requête SQL pour obtenir l'ID du groupe à partir du nom du groupe
            $queryGroupe = "SELECT GroupeID FROM groupes WHERE Groupe_name = '$groupe'";
            $resultGroupe = mysqli_query($connection, $queryGroupe);
            $rowGroupe = mysqli_fetch_assoc($resultGroupe);
            $groupeID = $rowGroupe['GroupeID'];

            // Requête SQL pour obtenir l'ID du niveau à partir du nom du niveau
            $queryNiveau = "SELECT NiveauID FROM niveau WHERE Niveau_name = '$niveau'";
            $resultNiveau = mysqli_query($connection, $queryNiveau);
            $rowNiveau = mysqli_fetch_assoc($resultNiveau);
            $niveauID = $rowNiveau['NiveauID'];

            // Insérer les données dans la base de données
            $query = "INSERT INTO etudiants (Etudiant_name, Etudiant_prenom, CIN, Email, Tele, Adresse, Date_inscription, NiveauID, GroupeID, Image) VALUES ('$nom', '$prenom', '$cin', '$email', '$telephone', '$adresse', '$date_inscription', '$niveauID', '$groupeID', '$etudiant_image')";
            $query_run = mysqli_query($connection, $query);

            // Vérifier si la requête d'insertion a réussi
            if ($query_run) {
                $_SESSION['success'] = "Étudiant ajouté avec succès";
                header('location: etudiants.php');
            } else {
                $_SESSION['status'] = "Échec de l'ajout de l'étudiant";
                header('location: etudiants.php');
            }
        }
    } else {
        $_SESSION['status'] = "Veuillez remplir tous les champs du formulaire.";
        header('location: etudiants.php');
    }
}




if(isset($_POST['updateebtn'])) {
    $EtudiantID = $_POST['edit_id'];
    $nom = $_POST['edit_etudiantname'];
    $prenom = $_POST['edit_etudiantprenom'];
    $cin = $_POST['edit_etudiantcin'];
    $email = $_POST['edit_email'];
    $telephone = $_POST['edit_etudianttele'];
    $adresse = $_POST['edit_etudiantadresse'];
    $date_inscription = $_POST['edit_etudiantdate'];
    $niveau = $_POST['edit_etudiantniveau'];
    $groupe = $_POST['edit_etudiantgroupe'];

    // Vérifier si un nouveau fichier d'image est téléchargé
    if(isset($_FILES['edit_etudiantimage']['name']) && !empty($_FILES['edit_etudiantimage']['name'])) {
        $etudiant_image = $_FILES['edit_etudiantimage']['name'];

        // Vérifier le type de fichier
        $imageFileType = strtolower(pathinfo($_FILES['edit_etudiantimage']['name'],PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif" ) {
            $_SESSION['status'] = "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
            header('location: etudiants.php');
            exit();
        }
    } else {
        // Utiliser l'image existante
        $etudiant_image = $_POST['edit_etudiantimage_old'];
    }

    // Récupérer l'ID du niveau en fonction de son nom
    $queryNiveau = "SELECT NiveauID FROM niveau WHERE Niveau_name = '$niveau'";
    $resultNiveau = mysqli_query($connection, $queryNiveau);
    $rowNiveau = mysqli_fetch_assoc($resultNiveau);
    $niveauID = $rowNiveau['NiveauID'];

    // Récupérer l'ID du groupe en fonction de son nom
    $queryGroupe = "SELECT GroupeID FROM groupes WHERE Groupe_name = '$groupe'";
    $resultGroupe = mysqli_query($connection, $queryGroupe);
    $rowGroupe = mysqli_fetch_assoc($resultGroupe);
    $groupeID = $rowGroupe['GroupeID'];

    // Modifier les données de l'étudiant dans la base de données
    $query = "UPDATE etudiants SET Etudiant_name='$nom', Etudiant_prenom='$prenom', CIN='$cin', Email='$email', Tele='$telephone', Adresse='$adresse', Date_inscription='$date_inscription', NiveauID='$niveauID', GroupeID='$groupeID'";
    
    // Si un nouveau fichier image est téléchargé, inclure le champ Image dans la requête
    if(isset($_FILES['edit_etudiantimage']['name']) && !empty($_FILES['edit_etudiantimage']['name'])) {
        $query .= ", Image='$etudiant_image'";
    }

    $query .= " WHERE EtudiantID='$EtudiantID'";
    
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        $_SESSION['success'] = "Les données de l'étudiant ont été mises à jour avec succès";
        header('location: etudiants.php');
    } else {
        $_SESSION['status'] = "Erreur lors de la mise à jour des données de l'étudiant : " . mysqli_error($connection);
        header('location: etudiants.php');
    }
}






if (isset($_POST['deletee_btn'])) {
    $etudiantID = $_POST['delete_id'];

    $query = "DELETE FROM etudiants WHERE EtudiantID = '$etudiantID'";
 
$query_run = mysqli_query($connection, $query);

if ($query_run) {
    $_SESSION['success'] = "L'étudiant a été supprimé avec succès.";
    header('Location: etudiants.php');
} else {
    $_SESSION['status'] = "Échec de la suppression de l'étudiant: " . mysqli_error($connection);
    header('Location: etudiants.php');
}
}



/*----------------------------professeurs------------------------------------- */

if (isset($_POST['professeurbtn'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $cin = $_POST['cin'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];

    // Vérifiez si tous les champs requis sont remplis
    if (!empty($nom) && !empty($prenom) && !empty($cin) && !empty($email) && !empty($telephone) && !empty($adresse)) {
        // Assurez-vous que la session de l'utilisateur est correcte avant d'insérer les données
        if ($_SESSION['userType'] == "admin") {
            // Requête d'insertion pour ajouter un nouveau professeur
            $query = "INSERT INTO professeurs (Professeur_name, Professeur_prenom, CIN, Email, Tele, Adresse) VALUES ('$nom', '$prenom', '$cin', '$email', '$telephone', '$adresse')";
            $query_run = mysqli_query($connection, $query);
            
            // Vérifiez si la requête d'insertion a réussi
            if ($query_run) {
                $_SESSION['success'] = "Le professeur a été ajouté avec succès.";
                header('Location: professeurs.php');
            } else {
                $_SESSION['status'] = "Échec de l'ajout du professeur. Veuillez réessayer.";
                header('Location: professeurs.php');
            }
        } else {
            $_SESSION['status'] = "Vous n'avez pas les autorisations nécessaires pour ajouter un professeur.";
            header('Location: professeurs.php');
        }
    } else {
        $_SESSION['status'] = "Veuillez remplir tous les champs.";
        header('Location: professeurs.php');
    }
}



if(isset($_POST['updatepbtn']))
{
  
      
$ProfesseurID = $_POST['edit_id'];
$nom = $_POST['edit_professeurname'];
$prenom = $_POST['edit_professeurprenom'];
$cin = $_POST['edit_professeurcin'];
$email = $_POST['edit_email'];
$telephone = $_POST['edit_professeurtele'];
$adresse = $_POST['edit_professeuradresse'];

    $query = "UPDATE professeurs SET Professeur_name='$nom',Professeur_prenom='$prenom',CIN='$cin',Email='$email',Tele='$telephone',Adresse='$adresse' WHERE ProfesseurID='$ProfesseurID' ";

    $query_run = mysqli_query($connection, $query);

if($query_run){
$_SESSION['success'] = "Le professeur est mise à jour";
header('location: professeurs.php');
}else{
    $_SESSION['status'] = "Le professeur n'est pas mise à jour";
header('location: professeurs.php');
}
}


if(isset($_POST['deletep_btn']))
{
    $ProfesseurID = $_POST['delete_id'];
    $query = "DELETE FROM professeurs WHERE ProfesseurID='$ProfesseurID' ";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['success'] = "Le professeur a été supprimer";
        header('location: professeurs.php');
        }
        else
        {
        $_SESSION['status'] = "Le professeur n'a pas été supprimer";
        header('location: professeurs.php');
        }

}


/*---------------------------------------------groupes------------------------------------------------- */


if (isset($_POST['groupebtn'])) {
    $nom = $_POST['nom'];
    $niveau = $_POST['niveau'];
    $date_creation = $_POST['date_creation'];

    // Assurez-vous que tous les champs requis sont remplis
    if (!empty($nom) && !empty($niveau) && !empty($date_creation)) {
        // Assurez-vous que la session de l'utilisateur est correcte avant d'insérer les données
        if ($_SESSION['userType'] == "admin") {
            // Requête d'insertion pour ajouter un nouveau groupe
            $query = "INSERT INTO groupes (Groupe_name, Niveau, Date_creation) VALUES ('$nom', '$niveau', '$date_creation')";
            $query_run = mysqli_query($connection, $query);

            // Vérifiez si la requête d'insertion a réussi
            if ($query_run) {
                $_SESSION['success'] = "Le groupe a été ajouté avec succès.";
                header('Location: groupes.php');
            } else {
                $_SESSION['status'] = "Échec de l'ajout du groupe. Veuillez réessayer.";
                header('Location: groupes.php');
            }
        } else {
            $_SESSION['status'] = "Vous n'avez pas les autorisations nécessaires pour ajouter un groupe.";
            header('Location: groupes.php');
        }
    } else {
        $_SESSION['status'] = "Veuillez remplir tous les champs.";
        header('Location: groupes.php');
    }
}



if(isset($_POST['updategbtn']))
{
  

$GroupeID = $_POST['edit_id'];
$nom = $_POST['edit_groupename'];
$niveau = $_POST['edit_groupeniveau'];
$date_creation = $_POST['edit_groupedate'];

    $query = "UPDATE groupes SET groupe_name='$nom',Niveau='$niveau',Date_creation='$date_creation' WHERE GroupeID='$GroupeID' ";
    $query_run = mysqli_query($connection, $query);

if($query_run){
$_SESSION['success'] = "Le groupe est mise à jour";
header('location: groupes.php');
}else{
    $_SESSION['status'] = "Le groupe n'est pas mise à jour";
header('location: groupes.php');
}
}




if(isset($_POST['deleteg_btn']))
{
    $GroupeID = $_POST['delete_id'];
    $query = "DELETE FROM groupes WHERE GroupeID='$GroupeID' ";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['success'] = "Le groupe a été supprimer";
        header('location: groupes.php');
        }
        else
        {
        $_SESSION['status'] = "Le groupe n'a pas été supprimer";
        header('location: groupes.php');
        }

}



//------------------------------------------------------------------------------------


if(isset($_POST['login_btn']))
{
    
 	$username_login = $_POST['user'];
 	$password_login = $_POST['pass'];

 	$query = "SELECT * FROM users WHERE  Username='$username_login' AND Password='$password_login' ";
 	$query_run = mysqli_query($connection, $query);
    $usertypes = mysqli_fetch_array($query_run);
   
     if($usertypes['Usertype'] == "admin")
	 {
	 	$_SESSION['username'] = $username_login;
        $_SESSION['userType'] = $usertypes['Usertype'];
        $_SESSION['villeID'] = $usertypes['VilleID'];
        header('location: dashboard.php');
	 }
     else if($usertypes['Usertype'] == "user")
     {
        $_SESSION['username'] = $username_login;
        $_SESSION['userType'] = $usertypes['Usertype'];
        $_SESSION['EtudiantID'] = $usertypes['UserID'];
        $_SESSION['villeID'] = $usertypes['VilleID'];
        header('location: etudiant_espace.php');
     }
     else if($usertypes['Usertype'] == "super")
     {
        $_SESSION['username'] = $username_login;
        $_SESSION['userType'] = $usertypes['Usertype'];
        $_SESSION['villeID'] = $usertypes['VilleID'];
        header('location: superadmin.php');
     }
     else
     {
         if(isset($_SESSION['username'])){
            unset($_SESSION['username']);
            unset($_SESSION['userType']);
         }
        $_SESSION['status'] = 'le nom d\'utilisateur / mot de passe n\'est pas valide';
        header('location: log.php');
     }
}






if(isset($_POST['AjouterPaiementBtn']))
{
    $cin = $_POST['CIN'];
    $type_de_paiement = $_POST['type_de_paiement'];
    $nature_de_paiement = $_POST['nature_de_paiement'];
    $avance = $_POST['avance'];
    $date = $_POST['mois_paiement'];

    $timestamp = strtotime($date);

    $mois = date("F", $timestamp); 
    $annee = date("Y", $timestamp);



    $query = "INSERT INTO paiements (CIN, type, nature, Avance, mois,annee) VALUES ('$cin', '$type_de_paiement', '$nature_de_paiement ', '$avance', '$mois','$annee')";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['success'] = "Paiement ajouté";
        header('location: Ajouter_paiement.php');
    }else{
        $_SESSION['status'] = "Paiement non ajouté";
        header('location: Ajouter_paiement.php');
    }

}

if(isset($_POST['UpdatePaiementBtn']))
{
    $cin = $_POST['CIN'];
    $id = $_POST['Id'];
    $type_de_paiement = $_POST['type_de_paiement'];
    $nature_de_paiement = $_POST['nature_de_paiement'];
    $avance = $_POST['avance'];
    $date = $_POST['mois_paiement'];

    $timestamp = strtotime($date);

    $mois = date("F", $timestamp); 
    $annee = date("Y", $timestamp);

    

    $query = "UPDATE paiements SET type = '$type_de_paiement', nature = '$nature_de_paiement', avance = '$avance', mois = '$mois', annee = '$annee'  WHERE CIN = '$cin' and Id = '$id'";
    $query_run = mysqli_query($connection, $query);
    if($query_run){
        $_SESSION['success'] = "Paiement mise à jour";
        header('location: update_paiement.php');
    }else{
        $_SESSION['status'] = "Paiement non mise à jour";
        header('location: update_paiement.php');
    }
}

?>
   


