<?php 

if(isset($_POST['currentVille'])){
    //echo '<script>alert("'.$_POST['currentVille'].'")</script>';
    $_SESSION['filterVille'] = true;
    $_SESSION['villeID'] = $_POST['currentVille'];
}
?>