<?php
include ('dbconfig.php');
include ('security.php');
secAdmin();

include ('includes/header.php');
include ('includes/navbar.php');

if (isset($_GET['id'])) {
    $studentId = $_GET['id'];
    $queryStudent = "SELECT * FROM x_etudiants  WHERE ID = '$studentId'";
    $queryDocuments = "SELECT * FROM fichiers WHERE userID = '$studentId'";

    $queryStudent_run = mysqli_query($connection, $queryStudent);
    $queryDocuments_run = mysqli_query($connection, $queryDocuments);

    if (!$queryStudent_run || !$queryDocuments_run) {
        die("Error in query: " . mysqli_error($connection));
    }

    if ($rowStudent = mysqli_fetch_assoc($queryStudent_run)) {
        ?>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Informations de l'étudiant</div>
                        <div class="card-body">
                            <div class="row">
                            <div class="col-md-4">
                            <?php
                            $imagePath = !empty($rowStudent['Image']) ? 'upload/images/' . $rowStudent['Image'] : 'upload/images/blanc.png';
                            ?>
                            <img src="<?php echo $imagePath; ?>" class="avatar img-circle img-thumbnail" alt="avatar" style="width: 200px; height: 200px;">
                        </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">
                                        <?php echo $rowStudent['nom'] . ' ' . $rowStudent['prenom']; ?>
                                    </h5>
                                    <p class="card-text"><strong>Email:</strong>
                                        <?php echo $rowStudent['Email']; ?>
                                    </p>
                                    <p class="card-text"><strong>Téléphone:</strong>
                                        <?php echo $rowStudent['Tele']; ?>
                                    </p>
                                    <p class="card-text"><strong>Adresse:</strong>
                                        <?php echo $rowStudent['Adresse']; ?>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <h6 class="heading-small text-muted mb-4">Parcours information</h6>
                            <ul class="list-unstyled">
                                <li><strong>Série bac:</strong>
                                    <?php echo $rowStudent['serie_bac']; ?>
                                </li>
                                <li><strong>Année bac:</strong>
                                    <?php echo $rowStudent['annee_bac']; ?>
                                </li>
                                <li><strong>Intitulé diplôme:</strong>
                                    <?php echo $rowStudent['intitule_diplome']; ?>
                                </li>
                                <li><strong>Année diplôme:</strong>
                                    <?php echo $rowStudent['annee_diplome']; ?>
                                </li>
                                <li><strong>Parcours souhaité:</strong>
                                    <?php echo $rowStudent['parcours_souhaite']; ?>
                                </li>
                            </ul>
                            <hr>
                            <h6 class="heading-small text-muted mb-4">Expériences</h6>
                            <p>
                                <?php echo $rowStudent['experience']; ?>
                            </p>
                            <h6 class="heading-small text-muted mb-4">Stages</h6>
                            <p>
                                <?php echo $rowStudent['mois_stage']; ?>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    } else {
        echo 'Détails non disponibles';
    }
} else {
    echo 'ID d\'étudiant non spécifié';
}

include ('includes/footer.php');
?>