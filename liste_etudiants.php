<?php
include('dbconfig.php'); // Inclure le fichier dbconfig.php pour établir la connexion à la base de données
include('security.php');
secAdmin();

include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container py-5">
    <div class="row mt-3">
        <div class="col-md-12">
            <h1 class="h3 mb-0 text-gray-800">Liste des Etudiants</h1>
        </div>
    </div>

    <!-- Formulaire de filtrage -->
    <div class="row mt-4">
        <div class="col-md-12">
            <form action="" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="specialite">Spécialité</label>
                        <select name="specialite" class="form-control">
                            <?php
                            // Récupérer les spécialités depuis la base de données
                            $query_specialite = "SELECT DISTINCT Specialite FROM etudiants";
                            $result_specialite = mysqli_query($connection, $query_specialite);
                            while ($row = mysqli_fetch_array($result_specialite)) {
                            ?>
                                <option value="<?php echo $row['Specialite']; ?>">
                                    <?php echo $row['Specialite']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary form-control" name="Afficher_etudiants">Afficher</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-4">
        <?php
        // Vérifier si le formulaire de filtrage est soumis
        if (isset($_POST['Afficher_etudiants'])) {
            $selected_specialite = $_POST['specialite'];

            // Ajouter la condition de spécialité à la requête SQL
            $query = "SELECT * FROM `etudiants` WHERE Specialite = '$selected_specialite'";
        } else {
            // Si le formulaire n'est pas soumis, afficher tous les étudiants
            $query = "SELECT * FROM `etudiants`";
        }

        $query_run = mysqli_query($connection, $query);

        if (mysqli_num_rows($query_run) > 0) {
            while ($row = mysqli_fetch_assoc($query_run)) {
        ?>
                <div class="col-md-3 mt-3">
                    <div class="card">
                        <img src="upload/images/<?php echo $row['Image']; ?>" width="250px" height="200px" alt="Etudiant_image">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $row['Etudiant_name']; ?>
                            </h5>
                            <h5 class="card-title">
                                <?php echo $row['Etudiant_prenom']; ?>
                            </h5>
                            <p class="card-text">
                                <?php echo $row['Description']; ?>
                            </p>
                            <a href="etudiant_details.php?id=<?php echo $row['EtudiantID']; ?>" class="btn btn-success">Afficher Details</a>
                        </div>
                    </div>
                </div>
            <?php
            }
        } else {
            echo "Aucun trouvé";
        }
        ?>
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
