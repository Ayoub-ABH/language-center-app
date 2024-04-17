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
            <h6 class="m-0 font-weight-bold text-primary">Liste des Groupes </h6>
        </div>
    </div>

    <div class="row mt-4">
        <?php
        $query = "SELECT * FROM `groupes`";
        $query_run = mysqli_query($connection, $query);

        if (mysqli_num_rows($query_run) > 0) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                ?>
                <div class="col-lg-12 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="font-weight-bold text-primary"><?php echo $row['Groupe_name']; ?></h5>
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $row['GroupeID']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $row['GroupeID']; ?>">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>
                        <div class="card-body collapse" id="collapse<?php echo $row['GroupeID']; ?>">
                            <div class="row mt-2">
                                <?php 
                                    // Requête pour récupérer les étudiants de ce groupe
                                    $groupe_id = $row['GroupeID'];
                                    $query_etudiants = "SELECT * FROM `etudiants` WHERE GroupeID = $groupe_id";
                                    $query_run_etudiants = mysqli_query($connection, $query_etudiants);

                                    if (mysqli_num_rows($query_run_etudiants) > 0) {
                                        while ($row_etudiant = mysqli_fetch_assoc($query_run_etudiants)) {
                                            ?>
                                            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                                <a href="detaille_etudiant.php?id=<?php echo $row_etudiant['EtudiantID']; ?>" class="btn btn-outline-primary btn-block"><?php echo $row_etudiant['Etudiant_name'] . " " . $row_etudiant['Etudiant_prenom']; ?></a>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        echo "<p class='text-muted'>Aucun étudiant dans ce groupe</p>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "Aucun groupe trouvé". mysqli_error($connection);
        }
        ?>
    </div>
</div>



<?php
if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
    echo '<h2 class="bg-primary text-white"> ' . $_SESSION['success'] . ' </h2>
    <meta http-equiv="refresh" content="5; url = liste_all_groupes.php" />';
    unset($_SESSION['success']);
}

if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    echo '<h2 class="bg-danger  text-white"> ' . $_SESSION['status'] . ' </h2>';
    unset($_SESSION['status']);
}

include('includes/scripts.php');
include('includes/footer.php');
?>
