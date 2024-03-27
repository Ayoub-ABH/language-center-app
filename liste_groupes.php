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
            <h6 class="m-0 font-weight-bold text-primary">Liste des Groupes</h6>
            <form method="post" action="">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Niveau</label>
                        <select name="niveau" class="form-control">
                            <option value="" selected disabled>sélectionner un niveau</option>
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

                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Professeur</label>
                        <select name="professeur" class="form-control">
                            <option value="" selected disabled>sélectionner un professeur</option>
                            <?php
                            $query = "SELECT * FROM `professeurs`";

                            $query_run = mysqli_query($connection, $query);
                            if ($query_run) {
                                while ($row = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                    <option value="<?php echo $row['ProfesseurID']; ?>"><?php echo $row['Professeur_name']; ?></option>
                                    <?php
                                }
                            } ?>
                        </select>
                    </div>

                
                  <div class="col-lg-4">
                        <div class="form-group">
                            <label class="invisible">Submit</label>
                            <button type="submit" class="btn btn-primary btn-block" name="btn_recherche">Afficher les étudiants</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="row mt-4">
        <?php

        if (isset($_POST['btn_recherche'])) {

            // Ajouter la condition pour filtrer les groupes selon le professeur et le niveau choisi
            $selectedNiveau = isset($_POST['niveau']) ? $_POST['niveau'] : '';
            $selectedProfesseur = isset($_POST['professeur']) ? $_POST['professeur'] : '';

            $query = "SELECT * FROM `groupes` WHERE Niveau  = '$selectedNiveau' AND ProfesseurID = '$selectedProfesseur'";
            $query_run = mysqli_query($connection, $query);

            if (mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>
                    <div class="col-lg-6 mb-4">
                        <div class="card py-3 border-left-primary">
                            <div class="card-body">
                                <div class="card-body">
                                    <?php echo $row['Groupe_name']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "Aucun trouvé". mysqli_error($connection);
            }
        }
        ?>
    </div>
</div>

<?php
if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
    echo '<h2 class="bg-primary text-white"> ' . $_SESSION['success'] . ' </h2>
    <meta http-equiv="refresh" content="5; url = liste_etudiants.php" />';
    unset($_SESSION['success']);
}

if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    echo '<h2 class="bg-danger  text-white"> ' . $_SESSION['status'] . ' </h2>';
    unset($_SESSION['status']);
}

include('includes/scripts.php');
include('includes/footer.php');
?>
