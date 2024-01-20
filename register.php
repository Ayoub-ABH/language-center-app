<?php 
include('dbconfig.php');
include('security.php');
secAdmin();
include('includes/header.php');
include('includes/navbar.php');

?>
  

<!--<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">Ajouter un utilisateur</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
          <span aria-hidden="true">&times;</span>
        </button>
            
       
      </div>

      
      <form action="code.php" method="POST">

      <div class="modal-body">
        
            <div class="form-group">
                <label>Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control" placeholder="Entrer Nom d'utilisateur">
            </div>
            <div class="form-group">
                <label> Email</label>
                <input type="email" name="email" class="form-control" placeholder="Entrer Email">
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control" placeholder="Entrer Mot de passe">
            </div>
            <div class="form-group">
                <label> Confirmer Mot de passe</label>
                <input type="password" name="confirmepassword" class="form-control" placeholder="confirmer Mot de passe">
            </div>
            <select name="usertype" class="form-control">-->
                   <!-- <option value="admin">admin</option> -->
                  <!-- <option value="user">Utilisateur</option>
               </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="submit" name="registerbtn" class="btn btn-primary">Enregistrer</button>
      </div>
         </form>
    </div>
  </div>
</div>-->

<div class="container-fluid">


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Mon profil
        <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addadminprofile">        
        Ajouter un utilisateur
        </button>-->
        </h6>
    </div>
<div class="card-body">

<?php

if(isset($_SESSION['success']) && $_SESSION['success'] !='')
{
    echo '<h2 class="bg-primary text-white"> '.$_SESSION['success'].' </h2>
    <meta http-equiv="refresh" content="5; url = register.php" />
    ';
    unset($_SESSION['success']);
}

if(isset($_SESSION['status']) && $_SESSION['status'] !='')
{
    echo '<h2 class="bg-danger  text-white"> '.$_SESSION['status'].' </h2>';
    unset($_SESSION['status']);
}

?>
    <div class="table-responsive">


<?php 
$username = $_SESSION['username'];

$query = "SELECT * FROM users WHERE Username = ? AND Usertype = 'admin'";
$stmt = mysqli_prepare($connection, $query);
// Lier les paramètres
mysqli_stmt_bind_param($stmt, "i", $username);

// Exécuter la requête préparée
mysqli_stmt_execute($stmt);

// Récupérer les résultats
$query_run = mysqli_stmt_get_result($stmt);

?>



        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Email</th>
                    <th>Mot de pasee</th>
                    <th>Rôle</th>
                    <th>Éditer</th>
                    <th>supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(mysqli_num_rows($query_run) > 0)
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                        ?>
                <tr>
                  <td><?php echo $row['UserID']; ?></td>
                  <td><?php echo $row['Username']; ?></td>
                  <td><?php echo $row['Email']; ?></td>
                  <td><?php echo $row['Password']; ?></td>
                  <td><?php echo $row['Usertype']; ?></td>
                  <td>
                      <form action="register_edit.php" method="post">
                          <input type="hidden" name="edit_id" value="<?php echo $row['UserID']; ?>">
                      <button type="submit" name="edit_btn"  class="btn btn-success">Éditer</button>
                      </form>
                  </td>
                  <td>
                  <form action="code.php" method="post">
                          <input type="hidden" name="delete_id" value="<?php echo $row['UserID']; ?>">
                      <button type="submit" name="delete_btn"  class="btn btn-danger">Supprimer</button>
                      </form>
                  </td>
                </tr>
                <?php
                }
            }
                 else{
                        echo "no record found";
                         }
                    ?>
            </tbody>
        </table>
       </div>
     </div>
   </div>
</div>

</div>
            <!-- End of Main Content -->
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>