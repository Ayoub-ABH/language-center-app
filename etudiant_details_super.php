<?php
include ('dbconfig.php');
include ('security.php');
secSuper();

include ('includes/header.php');
include ('includes/navbar_super.php');

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
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.1/css/all.min.css" rel="stylesheet">

        <body>
            <div class="main-content">

                <div class="col-xl-8 order-xl-1">

                    <div class="col-4 text-right">
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="col-lg-6">
                            <div>
                                <img src="upload/images/<?php echo $rowStudent['Image']; ?>"
                                    class="avatar img-circle img-thumbnail" alt="avatar" style="width: 250px; height: 225px;">
                            </div>
                        </div>
                        </br>
                        <h6 class="heading-small text-muted mb-4">User information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="input-username">Nom</label>

                                        <input type="text" id="input-username" class="form-control form-control-alternative"
                                            placeholder="Username" value="<?php echo $rowStudent['Etudiant_name'] ?>" disabled>


                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-prenom">Prenom</label>
                                        <input type="email" id="input-prenom" class="form-control form-control-alternative"
                                            value=" <?php echo $rowStudent['Etudiant_prenom']; ?>" disabled>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr class="my-4">
                        <!-- Address -->
                        <h6 class="heading-small text-muted mb-4">Contact information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="input-address">Address</label>
                                        <input id="input-address" class="form-control form-control-alternative"
                                            placeholder="Home Address" value="<?php echo $rowStudent['Adresse'] ?>" 
                                            type="text" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="input-emil">Email Address</label>
                                        <input id="input-email" class="form-control form-control-alternative"
                                            placeholder="email Address" value="<?php echo $rowStudent['Email'] ?>" type="text"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="input-tele">Telephone</label>
                                        <input id="input-tele" class="form-control form-control-alternative"
                                            placeholder="tele" value="<?php echo $rowStudent['Tele'] ?>" type="text"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <hr class="my-4">
                            <h6 class="heading-small text-muted mb-4">Parcours information</h6>
                            <div class="pl-lg-4">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-serie-bac">Serie bac</label>

                                            <input type="text" id="input-serie-bac"
                                                class="form-control form-control-alternative" placeholder="serie bac"
                                                value="<?php echo $rowStudent['serie_bac'] ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-annee-bac">Annee bac</label>
                                            <input type="annee-bac" id="input-annee-bac"
                                                class="form-control form-control-alternative"
                                                value=" <?php echo $rowStudent['annee_bac']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-intitule-diplome">Intitule
                                                diplome</label>

                                            <input type="text" id="input-intitule-diplome"
                                                class="form-control form-control-alternative" placeholder="intitule-diplome"
                                                value="<?php echo $rowStudent['intitule_diplome'] ?>" disabled>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-annee-diplome">Annee diplome
                                            </label>
                                            <input type="annee-diplome" id="input-annee-diplome"
                                                class="form-control form-control-alternative"
                                                value=" <?php echo $rowStudent['annee_diplome']; ?>" disabled>
                                        </div>
                                    </div>
                                </div>

<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="input-emil">Specialite</label>
                                        <input id="input-email" class="form-control form-control-alternative"
                                            placeholder="specialite" value="<?php echo $rowStudent['Specialite'] ?>" type="text"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label"
                                                for="input-parcours-souhaite">parcours_souhaite</label>
                                            <input type="text" id="input-parcours-souhaite"
                                                class="form-control form-control-alternative" placeholder="parcours-souhaite"
                                                value="<?php echo $rowStudent['parcours_souhaite']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-experience">Experiences</label>
                                            <input type="text" id="input-expeiences"
                                                class="form-control form-control-alternative" placeholder="experience"
                                                value="<?php echo $rowStudent['experience']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group focused">
                                            <label class="form-control-label" for="input-stage">Stages</label>
                                            <input type="text" id="input-stage" class="form-control form-control-alternative"
                                                placeholder="Stage" value="<?php echo $rowStudent['mois_stage']; ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">
                            <!-- Description -->

                            <h6 class="heading-small text-muted mb-4">About me</h6>
                            <div class="pl-lg-4">
                                <div class="form-group focused">
                                    <label>About Me</label>
                                    <textarea rows="4" class="form-control form-control-alternative"
                                        placeholder="A few words about you ..."
                                        disabled><?php echo $rowStudent['motivation']; ?></textarea>
                                </div>
                            </div>
                    </form>

                    <hr class="my-4">
                            <h6 class="heading-small text-muted mb-4">Les fichiers</h6>
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
                        <div class="modal fade" id="confirmDownloadModal" tabindex="-1" role="dialog"
                            aria-labelledby="confirmDownloadModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmDownloadModalLabel">Confirmation de telechargement
                                        </h5>
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
                                            <button type="submit" name="downloadFichier"
                                                class="btn btn-danger">Download</button>
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
                                        <td>
                                            <?php echo $row['fileID']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['uploadDateTime']; ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#confirmDownloadModal" data-fichierid="<?php echo $row['fileID']; ?>"
                                                data-fichierpath="<?php echo $row['path']; ?>">
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
include ('includes/scripts.php');
include ('includes/footer.php');

?>