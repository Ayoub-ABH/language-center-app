<?php
include('dbconfig.php');
include('security.php');

if (isset($_POST['marquer_presence']) || isset($_POST['marquer_absence'])) {
    $etudiant_id = $_POST['etudiant_id'];
    $date_absence = date("Y-m-d H:i:s"); // Obtenez la date actuelle au format SQL

    if (isset($_POST['marquer_presence'])) {
        $presence_query = "INSERT INTO `presence_table` (etudiant_id, presence_status, date_presence) VALUES ('$etudiant_id', 'Present', '$date_absence')";
        $presence_query_run = mysqli_query($connection, $presence_query);
    } elseif (isset($_POST['marquer_absence'])) {
        $absence_query = "INSERT INTO `presence_table` (etudiant_id, presence_status, date_absence) VALUES ('$etudiant_id', 'Absent', '$date_absence')";
        $absence_query_run = mysqli_query($connection, $absence_query);
    }

    if ($presence_query_run || $absence_query_run) {
        $_SESSION['success'] = "La présence/absence a été enregistrée avec succès.";
    } else {
        $_SESSION['status'] = "Erreur lors de l'enregistrement de la présence/absence.";
    }

    header("Location: list_groupe2.php");
} else {
    header("Location: list_groupe2.php");
}
?>
