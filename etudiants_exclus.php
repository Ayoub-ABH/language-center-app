<?php
include('security.php');
secAdmin();

include('includes/header.php');
include('includes/navbar.php');
include('dbconfig.php');
 
?>

<head>
    <link rel="stylesheet" type="text/css" href="css/etudiant_admin.css?v=1.0">
</head>

<div class="container">
    <div class="row blog">
        <div class="col-md-12">
            <div class="row">
            <?php
        
            $query = "SELECT * FROM `x_etudiants`";
            $query_run = mysqli_query($connection, $query);
            if (mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {

                    // Vérifier si le chemin de l'image est vide
                    $imagePath = !empty($row['Image']) ? 'upload/images/' . $row['Image'] : 'upload/images/blanc.png';
            ?>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <!-- Ajouter un lien vers detaille_etudiant.php avec l'ID de l'étudiant -->
                    <a href="detaille_x_etudiant.php?id=<?php echo $row['ID']; ?>" class="card-link">
                        <div class="our-team">
                            <div class="pic">
                                <img src="<?php echo $imagePath; ?>" alt="Image de l'étudiant">
                            </div>
                            <div class="team-content">
                                <h3 class="title"><?php echo $row['nom'] . ' ' . $row['prenom']; ?></h3>
                            </div>
                            <ul class="social">
                                <li>
                                    <a href="https://wa.me/<?php echo $row['Tele']; ?>">
                                        <i class="fa fa-phone"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </a></br>
                    <!-- Fin du lien -->
                </div>
            <?php
                }
            } else {
                echo "Aucun trouvé";
            }
            ?>
            </div>
            <!-- .row -->
       
        </div>
        <!-- .col --> 
    </div>
    <!-- .row blog -->
</div>
<!-- .container -->

<?php
include('includes/footer.php');
?>
