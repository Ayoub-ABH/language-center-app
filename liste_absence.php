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
            <h6 class="m-0 font-weight-bold text-primary">Liste d'absence</h6>
        </div>
        <div class="card-body">

        <?php
      if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
        echo '<h6 class="alert alert-success" role="alert"> ' . $_SESSION['success'] . ' </h6>
                <meta http-equiv="refresh" content="5; url = liste_absence.php" />';
        unset($_SESSION['success']);
      }

      if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
        echo '<h6 class="alert alert-danger" role="alert"> ' . $_SESSION['status'] . ' </h6>';
        unset($_SESSION['status']);
      }
      ?>
            <div class="table-responsive">

                 <?php
                $query = "SELECT presence_table.*, etudiants.Etudiant_name, etudiants.Etudiant_prenom FROM presence_table
                          INNER JOIN etudiants ON presence_table.etudiant_id = etudiants.EtudiantID";
                $query_run = mysqli_query($connection, $query);

                ?>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Etudiant</th>
                            <th>Presence Status</th>
                            <th>Date presence</th>
                            <th>Date absence</th>
                            <th>supprimer</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['ID']; ?></td>
                                    <td><?php echo $row['Etudiant_name'] . ' ' . $row['Etudiant_prenom']; ?></td>
                                    <td><?php echo $row['presence_status']; ?></td>
                                    <td><?php echo $row['date_presence']; ?></td>
                                    <td><?php echo $row['date_absence']; ?></td>

                                    <td>
                                        <!-- Bouton de suppression avec modal -->
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal<?php echo $row['ID']; ?>">Supprimer</button>

                                        <!-- Modal de confirmation de suppression -->
                                        <div class="modal fade" id="confirmDeleteModal<?php echo $row['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Voulez-vous vraiment supprimer ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                        <form action="code.php" method="post">
                                                            <input type="hidden" name="delete_id" value="<?php echo $row['ID']; ?>">
                                                            <button type="submit" name="deleta_btn" class="btn btn-danger">Supprimer</button>
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
                            echo "Aucun enregistrement trouvé";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
