<?php
include('dbconfig.php');
include('security.php');
secAdmin();

include('includes/header.php');
include('includes/navbar.php');

$selected_groupe = isset($_SESSION['selected_groupe']) ? $_SESSION['selected_groupe'] : '';
$selected_niveau = isset($_SESSION['selected_niveau']) ? $_SESSION['selected_niveau'] : '';
?>





<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Absences Etudiants</h6>
            <form method="post" action="">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="groupe">Groupe :</label>
                            <select class="form-control" id="groupe" name="groupe">
                                <?php
                                $query = "SELECT * FROM `groupes`";
                                $query_run = mysqli_query($connection, $query);
                                if ($query_run) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        ?>
                                        <option value="<?php echo $row['GroupeID']; ?>">
                                            <?php echo $row['Groupe_name']; ?>
                                        </option>
                                        <?php
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="niveau">Niveau :</label>
                            <select class="form-control" id="niveau" name="niveau">
                                <?php
                                $query = "SELECT * FROM `niveau`";
                                $query_run = mysqli_query($connection, $query);
                                if ($query_run) {
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        ?>
                                        <option value="<?php echo $row['NiveauID']; ?>">
                                            <?php echo $row['Niveau_name']; ?>
                                        </option>
                                        <?php
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="invisible">Submit</label>
                            <button type="submit" class="btn btn-primary btn-block" name="Afficher_etudiants">Afficher
                                les étudiants</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card-body">
            <?php
            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<h2 class="bg-primary text-white"> ' . $_SESSION['success'] . ' </h2>
                <meta http-equiv="refresh" content="5; url = list_groupe2.php" />';
                unset($_SESSION['success']);
            }

            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                echo '<h2 class="bg-danger text-white"> ' . $_SESSION['status'] . ' </h2>';
                unset($_SESSION['status']);
            }
            ?>
        </div>


    <div class="row mt-4">
        <?php

        $etudiants = []; // Initialisation du tableau associatif
        if (isset($_POST['Afficher_etudiants'])) {
            $selected_groupe = $_POST['groupe'];
            $selected_niveau = $_POST['niveau'];

            $query = "SELECT * FROM `etudiants` WHERE GroupeID = '$selected_groupe' AND NiveauID = '$selected_niveau'";
            $query_run = mysqli_query($connection, $query);

            // Vérification de la connexion et exécution de la requête
            if ($query_run) {

                // Récupération des données et stockage dans le tableau associatif
                while ($row = mysqli_fetch_assoc($query_run)) {
                    $etudiant_id = $row['EtudiantID'];
                    $etudiants[$etudiant_id] = $row; // Stockage des données de l'étudiant dans le tableau associatif
                }


            } else {
                echo "Erreur lors de l'exécution de la requête SQL.";
            }
        }

        // Vous pouvez maintenant utiliser le tableau associatif $etudiants comme vous le souhaitez
        // Par exemple, pour afficher les données :
        foreach ($etudiants as $etudiant_id => $etudiant_data) {
            ?><div class="col-md-3 mt-3">
            <div class="card">
                <img src="upload/<?php echo $etudiant_data['Image']; ?>" width="250px" height="200px" alt="Etudiant_image">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $etudiant_data['Etudiant_name']; ?></h4>
                    <p class="card-text">
                        <?php echo $etudiant_data['Description']; ?>
                    </p>
                    <form action="marquer_absence.php" method="POST">
                        <input type="hidden" name="etudiant_id" value="<?php echo $etudiant_id; ?>">
                        <button type="submit" class="btn btn-success" name="marquer_presence">Présent</button>
                        <button type="submit" class="btn btn-danger" name="marquer_absence">Absent</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>