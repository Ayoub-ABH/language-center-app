<?php
include('dbconfig.php');
session_start();



if(isset($_POST['registerbtn']))
{
    $emplacement = $_POST['emplacement'];
    $equipement = $_POST['equipement'];
    $comptoir = $_POST['comptoir'];
    $debut = $_POST['debut'];
    $fin = $_POST['fin'];
    $compagnie = $_POST['compagnie'];
    $nature = $_POST['nature'];
    $signale = $_POST['signale'];
    $probleme = $_POST['probleme'];
    $travaux = $_POST['travaux'];
    $observation = $_POST['observation'];
    $diff = (strtotime($fin) - strtotime($debut));
    $tbf = $diff/60;
    $type = $_POST['typeintervention'];
    $villeID = $_SESSION['villeID'];
    


    
    
        $query = "INSERT INTO intervention (Date,Emplacement,Equipement,Debut,Fin,Compagnie,Nature,Signale,Probleme,Travaux,Observation,Tbf,VilleID,Type_intervention,ComptoirID) VALUES (NOW(),'$emplacement','$equipement','$debut','$fin','$compagnie','$nature','$signale','$probleme','$travaux','$observation','$tbf','$villeID','$type','$comptoir')";
        $query_run = mysqli_query($connection,$query);
    
        if ($query_run){
            $_SESSION['success'] = "intervention added";
            header('location: formulaire.php');
        }else{
            $_SESSION['status'] = "intervention not added";
            header('location: formulaire.php');
        }
    
}

?>