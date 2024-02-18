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
       <h5 class="modal-title" id="exampleModalLabel">Ajouter professeur</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="code.php" method="POST"  enctype="multipart/form-data">
        <div class="modal-body">       
            <div class="form-group">
                <label>Nom de professeur </label>
                <input type="text" name="nom" class="form-control" placeholder="Entrer Nom de professeur">
            </div>
            <div class="form-group">
                <label>Prénom de professeur </label>
                <input type="text" name="prenom" class="form-control" placeholder="Entrer Prénom de professeur">
            </div>
            <div class="form-group">
                <label>CIN</label>
                <input type="text" name="cin" class="form-control" placeholder="Entrer CIN">
            </div>
            <div class="form-group">
                <label> Email</label>
                <input type="email" name="email" class="form-control" placeholder="Entrer Email">
            </div> 
             <div class="form-group">
                <label>Numéro de telephone</label>
                <input type="text" name="telephone" class="form-control" placeholder="Entrer Numéro de téléphone">
            </div>
            <div class="form-group">
                <label> Adresse</label>
                <input type="text" name="adresse" class="form-control" placeholder="Entrer Adresse">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
          <button type="submit" name="professeurbtn" class="btn btn-primary">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Profils professeurs
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addadminprofile">        
          Ajouter un professeur
        </button>
      </h6>
    </div>
    <div class="card-body">
      <?php
      if(isset($_SESSION['success']) && $_SESSION['success'] !='') {
          echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
          unset($_SESSION['success']);
      }

      if(isset($_SESSION['status']) && $_SESSION['status'] !='') {
          echo '<div class="alert alert-danger">'.$_SESSION['status'].'</div>';
          unset($_SESSION['status']);
      }
      ?>
      <div class="table-responsive">
        <?php 
        $query = "SELECT * FROM professeurs ";
        $query_run = mysqli_query($connection,$query);
        
        if($query_run) {
          ?>
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>CIN</th>
                <th>Email</th>
                <th>Tele</th>
                <th>Adresse</th>
                <th>Éditer</th>
                <th>supprimer</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if(mysqli_num_rows($query_run) > 0) {
                while($row = mysqli_fetch_assoc($query_run)) {
                  ?>
                  <tr>
                    <td><?php echo $row['ProfesseurID']; ?></td>
                    <td><?php echo $row['Professeur_name']; ?></td>
                    <td><?php echo $row['Professeur_prenom']; ?></td>
                    <td><?php echo $row['CIN']; ?></td>
                    <td><?php echo $row['Email']; ?></td>
                    <td><?php echo $row['Tele']; ?></td>
                    <td><?php echo $row['Adresse']; ?></td>
                    <td>
                      <form action="professeur_edit.php" method="post">
                        <input type="hidden" name="edit_id" value="<?php echo $row['ProfesseurID']; ?>">
                        <button type="submit" name="editp_btn"  class="btn btn-success">Éditer</button>
                      </form>
                    </td>
                    <td>
                      <form action="code.php" method="post">
                        <input type="hidden" name="delete_id" value="<?php echo $row['ProfesseurID']; ?>">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal<?php echo $row['ProfesseurID']; ?>">Supprimer</button>
                      </form>
                    </td>
                  </tr>
                  <!-- Boîte de dialogue de confirmation de suppression -->
                  <div class="modal fade" id="confirmDeleteModal<?php echo $row['ProfesseurID']; ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Voulez-vous vraiment supprimer ce professeur?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                          <form action="code.php" method="post">
                            <input type="hidden" name="delete_id" value="<?php echo $row['ProfesseurID']; ?>">
                            <button type="submit" name="deletep_btn" class="btn btn-danger">Supprimer</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php
                }
              } else {
                echo "<tr><td colspan='9'>Aucun enregistrement trouvé</td></tr>";
              }
              ?>
            </tbody>
          </table>
          <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>

<!-- Fin du contenu principal -->
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
