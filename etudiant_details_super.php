<?php
include('dbconfig.php');
include('security.php');
secSuper();

include('includes/header.php');
include('includes/navbar_super.php');

if (isset($_GET['id'])) {
    $studentId = $_GET['id'];
    $queryStudent = "SELECT * FROM etudiants WHERE EtudiantID = '$studentId'";
    $queryDocuments = "SELECT * FROM fichiers where userID = '$studentId'";

    $queryStudent_run = mysqli_query($connection, $queryStudent);
    $queryDocuments_run = mysqli_query($connection, $queryDocuments);

    if (!$queryStudent_run) {
        die("Error in query: " . mysqli_error($connection));
    }

    if (!$queryDocuments_run) {
        die("Error in query: " . mysqli_error($connection));
    }

    if ($rowStudent = mysqli_fetch_assoc($queryStudent_run)) {
?>
        <div class="container py-5">
            <div class="row mt-3">
                <div class="col-md-12">
                    <h1 class="h3 mb-0 text-gray-800">Détails de l'étudiant</h1>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <img src="upload/images/<?php echo $rowStudent['Image']; ?>" width="300px" height="250px" alt="Etudiant_image">
                </div>
                <div class="col-md-6">
                    <h5>Nom: <?php echo $rowStudent['Etudiant_name']; ?></h5>
                    <h5>Prénom: <?php echo $rowStudent['Etudiant_prenom']; ?></h5>

                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <h2 class="h4 mb-0 text-gray-800">Documents de l'étudiant</h2>
                </div>
            </div>

            <div class="containter my-4">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Fichier</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <!-- Modal de confirmation de suppression -->
                    <div class="modal fade" id="confirmDownloadModal" tabindex="-1" role="dialog" aria-labelledby="confirmDownloadModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDownloadModalLabel">Confirmation de telechargement</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Êtes-vous sûr de vouloir telecharger ce fichier ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <form action="etudiant_controller.php" method="post">
                                        <input type="hidden" id="fichierIDToDownload" name="fichierID">
                                        <input type="hidden" id="fichierPathToDownload" name="fichierPath">
                                        <button type="submit" name="downloadFichier" class="btn btn-danger">Download</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($queryDocuments_run) > 0) {
                            while ($row = mysqli_fetch_assoc($queryDocuments_run)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['fileID']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['uploadDateTime']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDownloadModal" data-fichierid="<?php echo $row['fileID']; ?>" data-fichierpath="<?php echo $row['path']; ?>">
                                            Download
                                        </button>
                                    </td>

                                </tr>
                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="4" class="text-center">Aucun fichier trouvé</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>

            </div>
            </div>
    <?php
    } else {
        echo 'Détails non disponibles';
    }
} else {
    echo 'ID d\'étudiant non spécifié';
}
?>


<script>
    $(document).ready(function () {
        $('#confirmDownloadModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var fichierID = button.data('fichierid');
            var fichierPath = button.data('fichierpath');

            $('#fichierIDToDownload').val(fichierID);
            $('#fichierPathToDownload').val(fichierPath);
        });
    });
</script>



<script>
    function confirmerDownload() {
        return confirm("Êtes-vous sûr de vouloir telecharger ce fichier ?");
    }
</script>

    <?php
        include('includes/scripts.php');
        include('includes/footer.php');
    ?>