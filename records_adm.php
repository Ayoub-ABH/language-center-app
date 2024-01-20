<?php

include 'model_adm.php';

$model = new Model();

if (isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['systeme'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $systeme = $_POST['systeme'];

    $rows = $model->date_range($start_date, $end_date, $systeme);
} else {
    $rows = $model->fetch();
}

echo json_encode($rows);
?>