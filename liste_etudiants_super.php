<?php
include 'dbconfig.php';
include 'security.php';
secSuper();
include 'supAdminVille.php';
include 'includes/header.php';
include 'includes/navbar_super.php';
?>

<head>
    <link rel="stylesheet" type="text/css" href="css/etudiant_super.css?v=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>

<section id="team" class="pb-5">
    <div class="container">
        <div class="card my-4">
            <h5 class="card-header">Filtrer les étudiants</h5>
            <div class="card-body">
                <!-- Formulaire de filtrage -->
                <form method="post">
                    <div class="form-group">
                        <label for="specialite">Filtrer par spécialité :</label>
                        <select class="form-control" id="specialite" name="specialite">
                            <option value="">Toutes les spécialités</option>
                            <?php
                            $query_specialites = "SELECT DISTINCT Specialite FROM etudiants";
                            $result_specialites = mysqli_query($connection, $query_specialites);
                            while ($row_specialite = mysqli_fetch_assoc($result_specialites)) {
                                $specialite = $row_specialite['Specialite'];
                                $selected = ($specialite == $_POST['specialite']) ? 'selected' : '';
                                echo "<option value='$specialite' $selected>$specialite</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="parcours">Choisir le parcours souhaité :</label>
                        <select class="form-control" id="parcours" name="parcours">
                            <option value="">Tous les parcours</option>
                            <?php
                            // Récupérer les parcours disponibles depuis la base de données
                            $query_parcours = "SELECT DISTINCT parcours_souhaite FROM etudiants";
                            $result_parcours = mysqli_query($connection, $query_parcours);
                            while ($row_parcours = mysqli_fetch_assoc($result_parcours)) {
                                $parcours = $row_parcours['parcours_souhaite'];
                                $selected = ($parcours == $_POST['parcours']) ? 'selected' : '';
                                echo "<option value='$parcours' $selected>$parcours</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="Afficher_etudiants" class="btn btn-primary">Filtrer</button>
                </form>
                <!-- Fin du formulaire de filtrage -->
            </div>
        </div>

        <div class="row">
            <?php
            // Construction de la requête en fonction des options de filtrage sélectionnées
            $query = "SELECT * FROM `etudiants` WHERE 1";

            if (isset($_POST['Afficher_etudiants'])) {
                $selected_specialite = $_POST['specialite'];
                $selected_parcours = $_POST['parcours'];

                if (!empty($selected_specialite)) {
                    $query .= " AND Specialite = '$selected_specialite'";
                }

                if (!empty($selected_parcours)) {
                    $query .= " AND parcours_souhaite = '$selected_parcours'";
                }
            }

            $query_run = mysqli_query($connection, $query);

            if (mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>

                    <!-- Membre de l'équipe -->
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip">
                            <div class="mainflip flip-0">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                        <?php
                        // Vérifier si le chemin de l'image est vide
                        if (!empty($row['Image'])) {
                            // Si le chemin de l'image n'est pas vide, afficher l'image de l'étudiant
                            echo '<img src="upload/images/' . $row['Image'] . '" width="250px" height="200px" alt="Image de l\'étudiant">';
                        } else {
                            // Sinon, afficher une image par défaut
                            echo '<img src="upload/images/blanc.png" width="250px" height="200px" alt="Image par défaut">';
                        }
                        ?>
                         <h5 class="card-title">
                                                <?php echo $row['Etudiant_name'] . ' ' . $row['Etudiant_prenom']; ?>
                                            </h5>
                                            <p class="card-text">
                                                <?php echo $row['Specialite']; ?>
                                            </p>
                                            <h6 class="card-title">
                                                <?php echo $row['niveau_etude'] ?>
                                            </h6>

                                            <p class="card-text">
                                                <?php
                                                // Récupérer l'ID du niveau de l'étudiant
                                                $niveau_id = $row['NiveauID'];

                                                // Requête pour récupérer le libellé du niveau en fonction de l'ID
                                                $query_niveau = "SELECT Niveau_name FROM niveau WHERE NiveauID = ?";
                                                $stmt_niveau = mysqli_prepare($connection, $query_niveau);
                                                mysqli_stmt_bind_param($stmt_niveau, "i", $niveau_id);
                                                mysqli_stmt_execute($stmt_niveau);
                                                $result_niveau = mysqli_stmt_get_result($stmt_niveau);

                                                // Vérifier si la requête a réussi
                                                if ($result_niveau && mysqli_num_rows($result_niveau) > 0) {
                                                    $niveau = mysqli_fetch_assoc($result_niveau)['Niveau_name'];

                                                    // Afficher le niveau de l'étudiant
                                                    echo "<p class='card-text'>$niveau</p>";
                                                } else {
                                                    echo "<p class='card-text'>Niveau inconnu</p>";
                                                }
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="backside">
                                    <div class="card">
                                        <div class="card-body text-center mt-4">
                                            <h4 class="card-title">
                                                <?php echo $row['Etudiant_name']; ?>
                                            </h4>
                                            <p class="card-text">
                                                <?php echo substr($row['motivation'], 0, 100) . "..."; ?>
                                                <!-- Limiter le paragraphe de motivation -->
                                            </p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" href="mailto:<?php echo $row['Email']; ?>">
                                                        <i class="fa fa-envelope"></i>
                                                    </a>
                                                </li>
                                            </ul>

                                            <a id="btn-details" href="etudiant_details_super.php?id=<?php echo $row['EtudiantID']; ?>" class="btn btn-primary btn-sm">
                                                Voir les détails <i class="fa fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./Membre de l'équipe -->
            <?php
                }
            } else {
                echo "Aucun trouvé";
            }
            ?>
        </div>
    </div>
</section>

<?php
include 'includes/scripts.php';
include 'includes/footer.php';
?>
