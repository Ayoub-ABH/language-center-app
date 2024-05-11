<?php
include ('dbconfig.php');
include ('security.php');
secAdmin();


if(isset($_POST['inscrire_visiteur_btn'])) {
    $visiteurID = $_POST['visiteur_id'];

    // Récupérer les informations du visiteur
    $query_select_visiteur = "SELECT * FROM visiteurs WHERE VisiteurID = '$visiteurID'";
    $result_select_visiteur = mysqli_query($connection, $query_select_visiteur);

    if(mysqli_num_rows($result_select_visiteur) > 0) {
        $row = mysqli_fetch_assoc($result_select_visiteur);

        // Insérer le visiteur dans la table des étudiants sans spécifier de groupe
        $query_insert_etudiant = "INSERT INTO etudiants (Etudiant_name, Etudiant_prenom, CIN, Password, Email, Tele, Adresse, Date_inscription, Image) 
                                  VALUES ('".$row['Visiteur_name']."', '".$row['Visiteur_prenom']."', '".$row['CIN']."', '".$row['Password']."', '".$row['Email']."', '".$row['Tele']."', '".$row['Adresse']."', '".$row['Date_visite']."', '".$row['Image']."')";
        $result_insert_etudiant = mysqli_query($connection, $query_insert_etudiant);

        if($result_insert_etudiant) {
            // Supprimer le visiteur de la table des visiteurs
            $query_delete_visiteur = "DELETE FROM visiteurs WHERE VisiteurID = '$visiteurID'";
            $result_delete_visiteur = mysqli_query($connection, $query_delete_visiteur);

            if($result_delete_visiteur) {
                $_SESSION['success'] = "Le visiteur a été inscrit en tant qu'étudiant avec succès.";
                header('location: visiteurs.php');
            } else {
                $_SESSION['status'] = "Erreur lors de la suppression du visiteur de la table des visiteurs : " . mysqli_error($connection);
                header('location: visiteurs.php');
            }
        } else {
            $_SESSION['status'] = "Erreur lors de l'insertion du visiteur dans la table des étudiants : " . mysqli_error($connection);
            header('location: visiteurs.php');
        }
    } else {
        $_SESSION['status'] = "Aucun visiteur trouvé avec l'ID spécifié.";
        header('location: visiteurs.php');
    }
}
?>
