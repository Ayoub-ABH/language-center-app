<?php
include('dbconfig.php');
session_start();



if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmepassword'];
    $usertype = $_POST['usertype'];
    if($_SESSION['userType'] == "admin"){
        $ville =  $_SESSION['villeID'];
    }else{
        $ville = $_POST['ville'];
    }


    if($password === $cpassword)
    {
        $query = "INSERT INTO users (Username,Email,Password,Usertype,VilleID) VALUES ('$username','$email','$password','$usertype','$ville')";
        $query_run = mysqli_query($connection,$query);
        if ($query_run){
            $_SESSION['success'] = "admin profile added";
            header('location: register_super.php');
        }else{
            $_SESSION['status'] = "admin profile not added";
            header('location: register_super.php');
        }
    }
    else{
        $_SESSION['status'] = "password and confirm password deos not match";
        header('location: register_super.php');
    }
}




if(isset($_POST['delete_btn']))
{
    $UserID = $_POST['delete_id'];
    $query = "DELETE FROM users WHERE UserID='$UserID' AND Usertype = 'admin' ";
    $query_run = mysqli_query($connection, $query);
    if($query_run)
    {
        $_SESSION['success'] = "Your data is deleted";
        header('location: register_super.php');
        }
        else
        {
        $_SESSION['status'] = "Your data is not deleted";
        header('location: register_super.php');
        }
}





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
$_SESSION['success'] = "Your data is updated";
header('location: register_super.php');
}else{
    $_SESSION['status'] = "Your data is not updated";
header('location: register_super.php');
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
   