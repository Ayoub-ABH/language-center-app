<?php
include('dbconfig.php');
session_start();



if(isset($_POST['registerbtn']))
{
    $codebare = $_POST['codebare'];
    $emplacement = $_POST['emplacement'];
    $equipement = $_POST['equipement'];
  
    $villeID = $_SESSION['villeID'];
    

        $query = "INSERT INTO materiel (Codebare,Emplacement,Equipement,VilleID) VALUES ('$codebare','$emplacement','$equipement','$villeID')";
        $query_run = mysqli_query($connection,$query);
        if ($query_run){
            $_SESSION['success'] = "Matériel a été ajouté";
            header('location: tables.php');
                        }
        else{
            $_SESSION['status'] = "Matériel n'a été ajouté";
            header('location: tables.php');
            }
    
}

if(isset($_POST['updatebtn']))
{
    $ID = $_POST['edit_id'];
    $codebare = $_POST['edit_codebare'];
    $emplacement = $_POST['edit_emplacement'];
    $equipement = $_POST['edit_equipement'];
    $comptoir = $_POST['edit_comptoir'];

    $query = "UPDATE materiel SET Codebare='$codebare',Emplacement='$emplacement',Equipement='$equipement' WHERE ID='$ID' ";
    $query_run = mysqli_query($connection, $query);

if($query_run){
$_SESSION['success'] = "Your data is updated";
header('location: tables.php');
}else{
    $_SESSION['status'] = "Your data is not updated";
header('location: tables.php');
}
}


if(isset($_POST['delete_btn']))
{
    $ID = $_POST['delete_id'];
    $query = "DELETE FROM materiel WHERE ID='$ID' ";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['success'] = "Matériel a été supprimer";
        header('location: tables.php');
        }
        else
        {
        $_SESSION['status'] = "Matériel n'a été supprimer";
        header('location: tables.php');
        }
}




?>