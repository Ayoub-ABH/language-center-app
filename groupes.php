<?php 
include('dbconfig.php');
include('security.php');
secAdmin();
include('includes/header.php');
include('includes/navbar.php');

?>
  
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">Ajouter un groupe</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
          <span aria-hidden="true">&times;</span>
        </button>
            
       
      </div>

      
      <form action="code.php" method="POST">

      <div class="modal-body">
        
            <div class="form-group">
                <label>Nom du groupe </label>
                <input type="text" name="nom" class="form-control" placeholder="Entrer Nom du groupe">
            </div>
            <div class="form-group">
                <label for="niveau"> Niveau</label>
    <select name="niveau" class="form-control">
        <option value="" selected disabled>Sélectionner un niveau</option>
        <?php 
        $query = "SELECT * FROM `niveau`";
        $query_run = mysqli_query($connection, $query);
        if ($query_run) {
            while ($row = mysqli_fetch_assoc($query_run)) { 
        ?>
        <option value="<?php echo $row['Niveau_name']; ?>"><?php echo $row['Niveau_name']; ?></option>
        <?php
            }
        }
        ?>
    </select>
</div>


            <div class="form-group">
                <label> Date de creation</label>
                <input type="date" name="date_creation" class="form-control" placeholder="Entrer Date">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="submit" name="groupebtn" class="btn btn-primary">Enregistrer</button>
      </div>
         </form>
    </div>
  </div>
</div>

<div class="container-fluid">


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Groupes
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addadminprofile">        
        Ajouter
        </button>
        </h6>
    </div>
<div class="card-body">

<?php

if(isset($_SESSION['success']) && $_SESSION['success'] !='')
{
    echo '<h2 class="bg-primary text-white"> '.$_SESSION['success'].' </h2>
    <meta http-equiv="refresh" content="5; url = groupes.php" />
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
/*$UserID = $_SESSION['UserID'];
/*$villeID = $_SESSION['villeID'];*/
$query = "SELECT * FROM groupes ";
$query_run = mysqli_query($connection,$query);

?>

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Niveau</th>
                    <th>Date_creation</th>
                    <th>Éditer</th>
                    <th>supprimer</th>
                </tr>
            </thead>
            <tbody>

<!-- Ajoutez cela où vous voulez afficher la boîte de dialogue dans votre fichier groupes.php -->
<div class="modal fade" id="confirmDeleteGroupeModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteGroupeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteGroupeModalLabel">Confirmation de suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Voulez-vous vraiment supprimer ce groupe?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <form action="code.php" method="post">
                    <input type="hidden" name="delete_id" value="<?php echo $row['GroupeID']; ?>">
                    <button type="submit" name="deleteg_btn" class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>


                <?php
                if(mysqli_num_rows($query_run) > 0)
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                        ?>
                <tr>
                  <td><?php echo $row['GroupeID']; ?></td>
                  <td><?php echo $row['Groupe_name']; ?></td>
                  <td><?php echo $row['Niveau']; ?></td>
                  <td><?php echo $row['Date_creation']; ?></td>

                  <td>
                      <form action="groupe_edit.php" method="post">
                          <input type="hidden" name="edit_id" value="<?php echo $row['GroupeID']; ?>">
                      <button type="submit" name="editg_btn"  class="btn btn-success">Éditer</button>
                      </form>
                  </td>
                  <td>
                  <form action="code.php" method="post">
                          <input type="hidden" name="delete_id" value="<?php echo $row['GroupeID']; ?>">
             
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteGroupeModal">Supprimer</button>

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