<?php
include('dbconfig.php');
session_start();



/* if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmepassword'];
    $usertype = $_POST['usertype'];
    if($_SESSION['userType'] == "admin"){
        $villeID = $_SESSION['villeID'];
    }else{
        $villeID = $_POST['ville'];
    }

    if($password === $cpassword)
    {
       
     
        $query = "INSERT INTO users (Username,Email,Password,Usertype,VilleID) VALUES ('$username','$email','$password','$usertype','$villeID')";
        $query_run = mysqli_query($connection,$query);
        if ($query_run){
            $_SESSION['success'] = "profil administrateur a été ajouté";
            header('location: register.php');
        }else{
            $_SESSION['status'] = "profil administrateur non ajouté";
            header('location: register.php');
        }
    }
    else{
        $_SESSION['status'] = "le mot de passe et le mot de passe de confirmation ne correspondent pas";
        header('location: register.php');
    }
}*/


if (isset($_POST['payer_btn'])) {
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
        // Vous pouvez ajouter du code spécifique pour les administrateurs ici
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
}






if(isset($_POST['updateebtn']))
{
  
      
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
$etudiant_image = $_FILES['edit_etudiantimage']['name'];

    $query = "UPDATE etudiants SET Etudiant_name='$nom',Etudiant_prenom='$prenom',CIN='$cin',Email='$email',Tele='$telephone',Adresse='$adresse',Date_inscription='$date_inscription',Niveau='$niveau',Groupe='$groupe',Image='$etudiant_image' WHERE EtudiantID='$EtudiantID' ";

    $query_run = mysqli_query($connection, $query);

if($query_run){
$_SESSION['success'] = "Le etudiant est mise à jour";
header('location: etudiants.php');
}else{
    $_SESSION['status'] = "Le etudiant n'est pas mise à jour";
header('location: etudiants.php');
}
}




if(isset($_POST['deletee_btn']))
{
    $EtudiantID = $_POST['delete_id'];
    $query = "DELETE FROM etudiants WHERE EtudiantID='$EtudiantID' ";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['success'] = "L'etudiant a été supprimer";
        header('location: etudiants.php');
        }
        else
        {
        $_SESSION['status'] = "L'etudiant n'a pas été supprimer";
        header('location: etudiants.php');
        }

}



/*----------------------------professeurs------------------------------------- */



// Vérifier si le formulaire a été soumis
if (isset($_POST['professeurbtn'])) {

    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $cin = $_POST['cin'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $professeur_image = $_FILES['professeur_image']['name'];

    // Vérifier le type d'utilisateur
    if ($_SESSION['userType'] == "admin") {
        // Vous pouvez ajouter du code spécifique pour les administrateurs ici
    }

    // Vérifier si le fichier image existe déjà
    if (file_exists("upload/" . $professeur_image)) {
        $_SESSION['status'] = "L'image existe déjà : $professeur_image";
        header('location: professeurs.php');
    } else {
        // Déplacer le fichier téléchargé vers le répertoire d'upload
        $target_path = "upload/" . $professeur_image;
        move_uploaded_file($_FILES["professeur_image"]["tmp_name"], $target_path);

        // Insérer les données dans la base de données
        $query = "INSERT INTO professeurs (Professeur_name, Professeur_prenom, CIN, Email, Tele, Adresse, Image) VALUES ('$nom', '$prenom', '$cin', '$email', '$telephone', '$adresse', '$etudiant_image')";
        $query_run = mysqli_query($connection, $query);

        // Vérifier si la requête d'insertion a réussi
        if ($query_run) {
            $_SESSION['success'] = "Professeur ajouté avec succès";
            header('location: professeurs.php');
        } else {
            $_SESSION['status'] = "Échec de l'ajout du professeur";
            header('location: professeurs.php');
        }
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
$adresse = $_POST['edit_professeurdresse'];
$professeur_image = $_FILES['edit_professeurimage']['name'];

    $query = "UPDATE professeurs SET Professeur_name='$nom',Professeur_prenom='$prenom',CIN='$cin',Email='$email',Tele='$telephone',Adresse='$adresse',Image='$professeur_image' WHERE ProfesseurID='$ProfesseurID' ";

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

    if ($_SESSION['userType'] == "admin") {

    }

    $query = "INSERT INTO groupes (Groupe_name, Niveau, Date_creation) VALUES ('$nom', '$niveau', '$date_creation')";
    $query_run = mysqli_query($connection, $query);
    
    if ($query_run) {
        $_SESSION['success'] = "Groupe a été ajouté";
        header('location: groupes.php');
    } else {
        $_SESSION['status'] = "Groupe non ajouté";
        header('location: groupes.php');
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



if(isset($_POST['comptoirbtn']))
{

    $comptoire = $_POST['comptoire'];
    if($_SESSION['userType'] == "admin"){
        $villeID = $_SESSION['villeID'];
    }

   
    $query = "INSERT INTO comptoir (Comptoirs,VilleID) VALUES ('$comptoire','$villeID')";
    $query_run = mysqli_query($connection,$query);
    if ($query_run){
        $_SESSION['success'] = "Le comptoire a été ajouté";
        header('location: comptoir.php');
    }else{
        $_SESSION['status'] = "Le comptoire n'a pas ajouté";
        header('location: comptoir.php');
    }
}









if(isset($_POST['comptoir_updatebtn']))
{
    $ComptoirID = $_POST['edit_id'];
    $Comptoir = $_POST['edit_comptoir'];
    

    $query = "UPDATE comptoir SET Comptoirs='$Comptoir' WHERE ComptoirID='$ComptoirID' ";
    $query_run = mysqli_query($connection, $query);

if($query_run){
$_SESSION['success'] = "Le comptoire est mise à jour";
header('location: comptoir.php');
}else{
    $_SESSION['status'] = "Le comptoire n'est pas a mise à jour";
header('location: comptoir.php');
}
}



if(isset($_POST['Comptoire_delete_btn']))
{
    $ComptoirID = $_POST['comptoir_delete_id'];
    $query = "DELETE FROM comptoir WHERE ComptoirID='$ComptoirID' ";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['success'] = "Le comptoire a été supprimer";
        header('location: comptoir.php');
        }
        else
        {
        $_SESSION['status'] = "Le comptoire n'a pas été supprimer";
        header('location: comptoir.php');
        }
}



if(isset($_POST['gradebtn']))
{

    $grade = $_POST['G_name'];
    if($_SESSION['userType'] == "admin"){
 
    }

   
    $query = "INSERT INTO grade (G_name,G_note) VALUES ('$G_name','$G_note')";
    $query_run = mysqli_query($connection,$query);
    if ($query_run){
        $_SESSION['success'] = "The grade has been added";
        header('location: grade.php');
    }else{
        $_SESSION['status'] = "The grade has not been added";
        header('location: grade.php');
    }
}

if(isset($_POST['grade_updatebtn']))
{
    $GradeID = $_POST['edit_id'];
    $G_name = $_POST['edit_grade'];
    

    $query = "UPDATE grade SET G_name='$G_name' WHERE GradeID='$GradeID' ";
    $query_run = mysqli_query($connection, $query);

if($query_run){
$_SESSION['success'] = "Your grade is updated";
header('location: grade.php');
}else{
    $_SESSION['status'] = "Your grade has not been updated";
header('location: grade.php');
}
}


if(isset($_POST['grade_delete_btn']))
{
    $GradeID = $_POST['grade_delete_id'];
    $query = "DELETE FROM grade WHERE GradeID='$GradeID' ";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['success'] = "The grade is deleted";
        header('location: grade.php');
        }
        else
        {
        $_SESSION['status'] = "The grade has not been deleted";
        header('location: compagnie.php');
        }
}








if(isset($_POST['compagniebtn']))
{

    $compagnie = $_POST['compagnie'];
    if($_SESSION['userType'] == "super"){
        $villeID = $_SESSION['villeID'];
    }

   
    $query = "INSERT INTO compagnie (Compagnie,VilleID) VALUES ('$compagnie','$villeID')";
    $query_run = mysqli_query($connection,$query);
    if ($query_run){
        $_SESSION['success'] = "La compagnie a été ajouté";
        header('location: compagnie_super.php');
    }else{
        $_SESSION['status'] = "La compagnie n'a pas ajouté";
        header('location: compagnie_super.php');
    }
}

if(isset($_POST['compagnie_updatebtn']))
{
    $CompagnieID = $_POST['edit_id'];
    $Compagnie = $_POST['edit_compagnie_super'];
    

    $query = "UPDATE compagnie SET Compagnie='$Compagnie' WHERE CompagnieID='$CompagnieID' ";
    $query_run = mysqli_query($connection, $query);

if($query_run){
$_SESSION['success'] = "Votre compagnie est mise à jour";
header('location: compagnie_super.php');
}else{
    $_SESSION['status'] = "Votre compagnie n'est pas mise à jour";
header('location: compagnie_super.php');
}
}


if(isset($_POST['Compagnie_delete_btn']))
{
    $CompagnieID = $_POST['compagnie_delete_id'];
    $query = "DELETE FROM compagnie WHERE CompagnieID='$CompagnieID' ";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['success'] = "La compagnie a été ajouter";
        header('location: compagnie_super.php');
        }
        else
        {
        $_SESSION['status'] = "La compagnie n'a pas été ajouté";
        header('location: compagnie_super.php');
        }
}












if(isset($_POST['problemebtn']))
{

    $probleme = $_POST['probleme'];
    if($_SESSION['userType'] == "user"){
        $villeID = $_SESSION['villeID'];
    }

   
    $query = "INSERT INTO probleme (Probleme,VilleID) VALUES ('$probleme','$villeID')";
    $query_run = mysqli_query($connection,$query);
    if ($query_run){
        $_SESSION['success'] = "le problème a été ajouter";
        header('location: probleme.php');
    }else{
        $_SESSION['status'] = "Le problème n'a pas été ajouté";
        header('location: probleme.php');
    }
}

if(isset($_POST['probleme_updatebtn']))
{
    $ProblemeID = $_POST['edit_id'];
    $Probleme = $_POST['edit_probleme'];
    

    $query = "UPDATE probleme SET Probleme='$Probleme' WHERE ID='$ProblemeID' ";
    $query_run = mysqli_query($connection, $query);

if($query_run){
$_SESSION['success'] = "Votre probleme est mise à jour";
header('location: probleme.php');
}else{
    $_SESSION['status'] = "Votre probleme n'est pas mise à jour";
header('location: probleme.php');
}
}


if(isset($_POST['Probleme_delete_btn']))
{
    $ProblemeID = $_POST['probleme_delete_id'];
    $query = "DELETE FROM probleme WHERE ID='$ProblemeID' ";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['success'] = "le probleme a été supprimer";
        header('location: probleme.php');
        }
        else
        {
        $_SESSION['status'] = "Le problème n'a pas été supprimer";
        header('location: probleme.php');
        }
}







if(isset($_POST['traveaubtn']))
{

    $traveau = $_POST['traveau'];
    if($_SESSION['userType'] == "user"){
        $villeID = $_SESSION['villeID'];
    }

   
    $query = "INSERT INTO traveau (Traveau,VilleID) VALUES ('$traveau','$villeID')";
    $query_run = mysqli_query($connection,$query);
    if ($query_run){
        $_SESSION['success'] = "le traveau a été ajouter";
        header('location: traveau.php');
    }else{
        $_SESSION['status'] = "Le traveau n'a pas été ajouté";
        header('location: traveau.php');
    }
}

if(isset($_POST['traveau_updatebtn']))
{
    $TraveauID = $_POST['edit_id'];
    $Traveau = $_POST['edit_traveau'];
    

    $query = "UPDATE traveau SET Traveau='$Traveau' WHERE ID='$TraveauID' ";
    $query_run = mysqli_query($connection, $query);

if($query_run){
$_SESSION['success'] = "Votre traveau est mise à jour";
header('location: traveau.php');
}else{
    $_SESSION['status'] = "Votre traveau n'est pas mise à jour";
header('location: traveau.php');
}
}


if(isset($_POST['Traveau_delete_btn']))
{
    $TraveauID = $_POST['traveau_delete_id'];
    $query = "DELETE FROM traveau WHERE ID='$TraveauID' ";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['success'] = "le traveau a été supprimer";
        header('location: traveau.php');
        }
        else
        {
        $_SESSION['status'] = "Le traveau n'a pas été supprimer";
        header('location: traveau.php');
        }
}









if(isset($_POST['emplacementbtn']))
{

    $emplacement = $_POST['emplacement'];
    if($_SESSION['userType'] == "admin"){
        $villeID = $_SESSION['villeID'];
    }

   
    $query = "INSERT INTO emplacement (Emplacement,VilleID) VALUES ('$emplacement','$villeID')";
    $query_run = mysqli_query($connection,$query);
    if ($query_run){
        $_SESSION['success'] = "Emplacement a été ajouter";
        header('location: emplacement.php');
    }else{
        $_SESSION['status'] = "Emplacement n'a pas été ajouté";
        header('location: emplacement.php');
    }
}

if(isset($_POST['emplacement_updatebtn']))
{
    $EmplacementID = $_POST['edit_id'];
    $Emplacement = $_POST['edit_emplacement'];
    

    $query = "UPDATE emplacement SET Emplacement='$Emplacement' WHERE ID='$EmplacementID' ";
    $query_run = mysqli_query($connection, $query);

if($query_run){
$_SESSION['success'] = "Votre emplacement est mise à jour";
header('location: emplacement.php');
}else{
    $_SESSION['status'] = "Votre emplacement n'est pas mise à jour";
header('location: emplacement.php');
}
}


if(isset($_POST['Emplacement_delete_btn']))
{
    $EmplacementID = $_POST['emplacement_delete_id'];
    $query = "DELETE FROM emplacement WHERE ID='$EmplacementID' ";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['success'] = "Emplacementa été supprimer";
        header('location: emplacement.php');
        }
        else
        {
        $_SESSION['status'] = "Emplacement n'a pas été supprimer";
        header('location: emplacement.php');
        }
}
















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
        $_SESSION['villeID'] = $usertypes['VilleID'];
        header('location: formulaire.php');
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





    ?>
   