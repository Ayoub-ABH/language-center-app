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
        <h6 class="m-0 font-weight-bold text-primary">Mon profil

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