<?php
include ('dbconfig.php');
include ('security.php');
secAdmin();
include ('includes/header.php');
include ('includes/navbar.php');
?>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Profils professeurs
        <button type="button" class="btn btn-primary" onclick="window.location.href='Ajouter_professeur.php'">Ajouter</button>
      </h6>
    </div>
    <div class="card-body">
      <?php
      if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
        echo '<h6 class="alert alert-success" role="alert"> ' . $_SESSION['success'] . ' </h6>
                <meta http-equiv="refresh" content="5; url = professeurs.php" />';
        unset($_SESSION['success']);
      }

      if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
        echo '<h6 class="alert alert-danger" role="alert"> ' . $_SESSION['status'] . ' </h6>';
        unset($_SESSION['status']);
      }
      ?>
    </div>
    <div class="card-body">
      <div class="table-responsive">

        <?php

        $query = "SELECT ProfesseurID, Professeur_name, Professeur_prenom,Password, CIN, Email, Tele, Adresse, Date_debut_travail, Image FROM professeurs";
        $query_run = mysqli_query($connection, $query);
        ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nom</th>
              <th>Prénom</th>
              <th>CIN</th>
              <th>Password</th>
              <th>Email</th>
              <th>Tele</th>
              <th>Adresse</th>
              <th>Date début travail</th>
              <th>Image</th>
              <th>Éditer</th>
              <th>Supprimer</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (mysqli_num_rows($query_run) > 0) {
              while ($row = mysqli_fetch_assoc($query_run)) {
                ?>
                <tr>
                  <td><?php echo $row['ProfesseurID']; ?></td>
                  <td><?php echo $row['Professeur_name']; ?></td>
                  <td><?php echo $row['Professeur_prenom']; ?></td>
                  <td><?php echo $row['CIN']; ?></td>
                  <td><?php echo $row['Password']; ?></td>
                  <td><?php echo $row['Email']; ?></td>
                  <td><?php echo $row['Tele']; ?></td>
                  <td><?php echo $row['Adresse']; ?></td>
                  <td><?php echo $row['Date_debut_travail']; ?></td>
                  <td>
                    <?php echo '<img src="upload/images_prof/' . $row['Image'] . '" width="100px;" height="100px;" alt="Image">'; ?>
                  </td>
                  <td>
                    <form action="professeur_edit.php" method="post">
                      <input type="hidden" name="edit_id" value="<?php echo $row['ProfesseurID']; ?>">
                      <button type="submit" name="editp_btn" class="btn btn-success">Éditer</button>
                    </form>
                  </td>
                  <td>
                    <button type="button" class="btn btn-danger" data-toggle="modal"
                      data-target="#confirmDeleteModal<?php echo $row['ProfesseurID']; ?>">Supprimer</button>
                    <!-- Ajouter une boîte de dialogue de confirmation de suppression pour chaque visiteur -->
                    <div class="modal fade" id="confirmDeleteModal<?php echo $row['ProfesseurID']; ?>" tabindex="-1"
                      role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Voulez-vous vraiment supprimer cet étudiant?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <form action="code.php" method="post">
                              <input type="hidden" name="deletep_id" value="<?php echo $row['ProfesseurID']; ?>">
                              <button type="submit" name="deletep_btn" class="btn btn-danger">Supprimer</button>

                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <?php
              }
            } else {
              echo "<tr><td colspan='7'>Aucun enregistrement trouvé</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
include ('includes/scripts.php');
include ('includes/footer.php');
?>