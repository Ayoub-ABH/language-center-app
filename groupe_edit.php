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
            <h6 class="m-0 font-weight-bold text-primary">Modifier les données du groupe</h6>
        </div>
        <div class="card-body">
            <?php
            if (isset($_POST['editg_btn'])) {
                $GroupeID = $_POST['edit_id'];
                $query = "SELECT * FROM groupes WHERE GroupeID='$GroupeID' ";
                $query_run = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
                    <form action="code.php" method="post">
                        <input type="hidden" name="edit_id" value="<?php echo $row['GroupeID'] ?>">
                        <div class="form-group">
                            <label>Nom du groupe</label>
                            <input type="text" name="edit_groupename" value="<?php echo $row['Groupe_name'] ?>" class="form-control" placeholder="Entrer nom du groupe">
                        </div>
                     
                        <div class="form-group">
                            <label for="niveau">Niveau du groupe</label>
                            <select name="niveau" class="form-control">

                                <?php 
                                $niveau_query = "SELECT * FROM `niveau`";
                                $niveau_query_run = mysqli_query($connection, $niveau_query);
                                if ($niveau_query_run) {
                                    while ($niveau_row = mysqli_fetch_assoc($niveau_query_run)) {
                                        $selected = ($niveau_row['NiveauID'] == $row['Niveau']) ? 'selected' : '';
                                        echo "<option value='" . $niveau_row['NiveauID'] . "' $selected>" . $niveau_row['Niveau_name'] . "</option>";
                                    }
                                }
                                ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date de création</label>
                            <input type="date" name="edit_groupedate" value="<?php echo $row['Date_creation'] ?>" class="form-control" placeholder="Entrer Date_creation">
                        </div>
                        <div class="form-group">
                            <label for="professeur">Professeur</label>
                            <select name="professeur" class="form-control">
                                <?php 
                                $prof_query = "SELECT * FROM `professeurs`";
                                $prof_query_run = mysqli_query($connection, $prof_query);
                                if ($prof_query_run) {
                                    while ($prof_row = mysqli_fetch_assoc($prof_query_run)) {
                                        $selected = ($prof_row['ProfesseurID'] == $row['ProfesseurID']) ? 'selected' : '';
                                        echo "<option value='" . $prof_row['ProfesseurID'] . "' $selected>" . $prof_row['Professeur_name'] . ' ' . $prof_row['Professeur_prenom'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>


                        <a href="register.php" class="btn btn-danger">Annuler</a>
                        <button type="submit" name="updategbtn" class="btn btn-primary">Mettre à jour</button>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
