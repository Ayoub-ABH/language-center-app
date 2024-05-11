<?php
session_start(); 
include('dbconfig.php'); 

function presenceDejaMarquee($connection, $etudiant_id) {
    $date_du_jour = date("Y-m-d");
    $query = "SELECT COUNT(*) FROM `presence_table` WHERE `etudiant_id` = ? AND DATE(`date_presence`) = ?";
    $count = 0; 
    $stmt = $connection->prepare($query);
    if ($stmt) {
        $stmt->bind_param("ss", $etudiant_id, $date_du_jour);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
    }
    return $count > 0;
}

// Fonction pour marquer la présence
function marquerPresence($connection, $etudiant_ids) {
    $date_actuelle = date("Y-m-d H:i:s"); // Obtenir la date et l'heure actuelles
    $query = "INSERT INTO `presence_table` (`etudiant_id`, `presence_status`, `date_presence`) VALUES (?, 'Present', ?)";
    $stmt = $connection->prepare($query);

    $rows_affected = 0; // Compteur de lignes affectées par l'opération

    foreach ($etudiant_ids as $etudiant_id) { 
        if (!presenceDejaMarquee($connection, $etudiant_id)) { // Vérifier si la présence n'a pas déjà été marquée
            $stmt->bind_param("ss", $etudiant_id, $date_actuelle);
            $stmt->execute();
            $rows_affected++;
        }
    }

    return $rows_affected; // Retourner le nombre de lignes affectées
}

// Fonction pour marquer les absences 
function marquerAbsence($connection, $etudiant_ids) {
    $date_actuelle = date("Y-m-d H:i:s"); 
    $query = "INSERT INTO `presence_table` (`etudiant_id`, `presence_status`, `date_absence`) VALUES (?, 'Absent', ?)";
    $stmt = $connection->prepare($query);

    $rows_affected = 0;

    foreach ($etudiant_ids as $etudiant_id) {
        if (!presenceDejaMarquee($connection, $etudiant_id)) { 
            $stmt->bind_param("ss", $etudiant_id, $date_actuelle);
            $stmt->execute();
            $rows_affected++;
        }
    }

    return $rows_affected;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['etudiant_ids']) && !empty($_POST['etudiant_ids'])) { 
        $etudiant_ids = $_POST['etudiant_ids'];

        if (isset($_POST['marquer_presence_tous'])) {
            $rows_affected = marquerPresence($connection, $etudiant_ids); // Marquer la présence

            if ($rows_affected > 0) { 
                $_SESSION['success'] = "Présence marquée avec succès pour $rows_affected étudiants.";
            } else {
                $_SESSION['status'] = "Aucune modification ou présence déjà marquée pour aujourd'hui.";
            }
        } elseif (isset($_POST['marquer_absence_tous'])) {
            $rows_affected = marquerAbsence($connection, $etudiant_ids); // Marquer les absences

            if ($rows_affected > 0) { 
                $_SESSION['success'] = "Absence marquée avec succès pour $rows_affected étudiants.";
            } else {
                $_SESSION['status'] = "Aucune modification ou absence déjà marquée pour aujourd'hui.";
            }
        } else {
            $_SESSION['status'] = "Action inconnue. Veuillez vérifier votre demande.";
        }
    } else {
        $_SESSION['status'] = "Aucun étudiant sélectionné. Veuillez sélectionner au moins un étudiant.";
    }
} else {
    $_SESSION['status'] = "Méthode de requête non autorisée.";
}

header('Location: marque_abs_prof.php'); 
exit();
?>
