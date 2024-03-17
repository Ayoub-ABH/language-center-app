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
                                        <option value="<?php echo $row['GroupeID']; ?>"><?php echo $row['Groupe_name']; ?></option>
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
                                        <option value="<?php echo $row['NiveauID']; ?>"><?php echo $row['Niveau_name']; ?></option>
                                        <?php
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="invisible">Submit</label>
                            <button type="submit" class="btn btn-primary btn-block" name="submit">Afficher les étudiants</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>




    <div class="row mt-4">

        <?php
        // Vérifie si le formulaire a été soumis
        if (isset($_POST['submit'])) {
            $selected_groupe = $_POST['groupe'];
            $selected_niveau = $_POST['niveau'];

            //$query = "SELECT * FROM `etudiants` WHERE Groupe_name = '$selected_groupe' AND Niveau_name = '$selected_niveau'";
            $query = "SELECT * FROM `etudiants` WHERE GroupeID = '$selected_groupe' AND NiveauID = '$selected_niveau'";

            $query_run = mysqli_query($connection, $query);

            if (mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {
                    $etudiant_id = $row['EtudiantID'];

                    ?>
                    <div class="col-md-3 mt-3">
                        <div class="card">
                            <img src="upload/<?php echo $row['Image']; ?>" width="250px" height="200px" alt="Etudiant_image">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $row['Etudiant_name']; ?></h4>
                                <p class="card-text">
                                    <?php echo $row['Description']; ?>
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
            } else {
                echo "Aucun étudiant trouvé pour le groupe '$selected_groupe' et le niveau '$selected_niveau'";
            }
        }
        ?>
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>