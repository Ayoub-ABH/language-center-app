<?php 
include('dbconfig.php');
include('security.php');
secAdmin();
include('includes/header.php');
include('includes/navbar.php');

?>

    <div class="container-fluid">

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Modifier les données d'administration</h6>
</div>
<div class="card-body">
<?php


if(isset($_POST['edit_btn']))
{
    $UserID = $_POST['edit_id'];
    $query = "SELECT * FROM users WHERE UserID='$UserID' ";
    $query_run = mysqli_query($connection, $query);

    foreach($query_run as $row)
    {
        ?>
            <form action="code.php" method="post">
                <input type="hidden" name="edit_id" value="<?php echo $row['UserID'] ?>">
            <div class="form-group">
                <label> Nom d'utilisateur</label>
                <input type="text" name="edit_username" value="<?php echo $row['Username'] ?>" class="form-control" placeholder="Entrer Nom d'utilisateur">
            </div>
            <div class="form-group">
                <label> Email</label>
                <input type="email" name="edit_email" value="<?php echo $row['Email'] ?>"  class="form-control" placeholder="Entrer Email">
            </div>
            <div class="form-group">
                <label> Mot de pasee</label>
                <input type="password" name="edit_password" value="<?php echo $row['Password'] ?>" class="form-control" placeholder="Entrer Mot de pasee">
            </div>
            <div class="form-group">
                <label> Rôle</label>
               <select name="update_usertype" class="form-control">
              
                   <option  selected="selected" value="<?php echo $row['Usertype'];?>"
                   ><?php echo $row['Usertype'] ?></option>

                
               </select>
            </div>
            
            <a href="register.php" class="btn btn-danger">Cancel</a>
            <button type="submit" name="updatebtn" class="btn btn-primary">Mettre à jour </button>
    </form>


            <?php
    }
}
?>
           
            </div>
 </div>
</div>


</div>





<?php
include('includes/scripts.php');
include('includes/footer.php');
?>