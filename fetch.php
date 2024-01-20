<?php

//fetch.php
session_start();
include('database_connection.php');

if(isset($_POST["year"]))
{

 $query = "
 SELECT Date_inscription,COUNT(*) AS profit, DATE_FORMAT(Date_inscription, '%M') AS month , DATE_FORMAT(Date, '%Y') AS year FROM etudiants WHERE DATE_FORMAT(Date_inscription, '%Y') = '".$_POST["year"]."'  GROUP BY month ORDER BY Date ASC ";
 
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'month'   => $row["month"],
   'profit'  => floatval($row["profit"])
  );
 }
 echo json_encode($output);
}

if(isset($_POST["startDatee"]) && isset($_POST["endDatee"])){
    $villeID = $_SESSION['villeID'];
    $end_datee = $_POST['endDatee'];
    $start_datee = $_POST['startDatee'];
    $sql = "SELECT `Equipement`, `Date`, COUNT(*) AS Value FROM `intervention` WHERE Date BETWEEN '$start_datee' AND '$end_datee' AND Equipement IN ('ATB/BTP','NETWORK','KEYBOARD/DESKO','SYSTEM','SCREEN','MISCELLANEOUS','DESKTOP') AND VilleID = $villeID GROUP BY Equipement";
    $statement = $connect->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
    $EquipementPerMonth[] = array(
        'equipement' => $row['Equipement'],
        'value'  => $row['Value']
       );
    }
    echo json_encode($EquipementPerMonth);
}






if(isset($_POST["startDate"]) && isset($_POST["endDate"])){
    $villeID = $_SESSION['villeID'];
    $end_date = $_POST['endDate'];
    $start_date = $_POST['startDate'];
    $sql = "SELECT `Equipement`, `Date`, COUNT(*) AS Value FROM `intervention` WHERE Date BETWEEN '$start_date' AND '$end_date' AND Equipement IN ('ATB/BTP','DCP','BGR','WORKSTATION','KEYBOARD/DESKO') AND VilleID = $villeID GROUP BY Equipement";
    $statement = $connect->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
    $EquipementPerMonthh[] = array(
        'equipement' => $row['Equipement'],
        'value'  => $row['Value']
       );
    }
    echo json_encode($EquipementPerMonthh);
}


?>

