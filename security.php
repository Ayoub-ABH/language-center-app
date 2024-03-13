<?php 
// session_start();
// if (isset($_SESSION['username'])){
 
// }else{
//     header('location: login.php');
//     exit();
// }
?>
<?php 
session_start();
if(!(isset($_SESSION['username'])) && !(isset($_SESSION['userType']))){
    header('location: log.php');
    exit();
}


// function secUser(){
//     if($_SESSION['userType'] == 'admin' ){
//         header('location: dashboard.php');
//     }elseif($_SESSION['userType'] !='user'){
//         unset($_SESSION['username']);
//         unset($_SESSION['userType']);
//         header('location: log.php');  
//     }
// }



function secAdmin(){
    if($_SESSION['userType'] != "admin"){
        unset($_SESSION['username']);
        unset($_SESSION['userType']);
        header('location: log.php'); 
    }
}


function secSuper(){
    if($_SESSION['userType'] !="super"){
        unset($_SESSION['username']);
        unset($_SESSION['userType']);
        header('location: log.php');
    }
}

?>