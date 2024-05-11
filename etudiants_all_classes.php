<?php
include('security.php');
secAdmin(); // Assurez-vous que l'utilisateur est autorisé à accéder à cette page

include('includes/header.php');
include('includes/navbar.php');
include('dbconfig.php'); // Connexion à la base de données

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" type="text/css" href="css/etudiant_admin.css?v=1.0">
    <!-- Inclure les ressources Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Style personnalisé -->
    <style>
        .our-team {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            margin-bottom: 20px;
        }

        .our-team:hover {
            transform: translateY(-5px);
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .search-bar {
            text-align: center;
            margin-bottom: 10px;
        }

        .search-input {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            width: 100%; /* Largeur de la barre de recherche */
        }

        .social {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .social li {
            display: inline-block;
            margin-right: 10px;
        }
    </style>
    
    <!-- Script pour la recherche dynamique -->
    <script>
        $(document).ready(function() {
            $('.search-input').on('input', function() {
                let searchTerm = $(this).val().toLowerCase(); // Récupérer le terme de recherche

                // Filtrer les étudiants en fonction du terme de recherche
                $('.col-lg-3').each(function() {
                    let studentName = $(this).find('.title').text().toLowerCase();

                    if (studentName.includes(searchTerm)) {
                        $(this).show(); // Afficher la carte si elle correspond au terme de recherche
                    } else {
                        $(this).hide(); // Masquer la carte si elle ne correspond pas
                    }
                });
            });
        });
    </script>
</head>

<body>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Liste des étudiants</h6>
        
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Rechercher..."> <!-- Barre de recherche -->
            </div>
        </div>
    </div>

    <div class="row blog">
        <div class="col-md-12">
            <div class="row"> <!-- Conteneur des étudiants -->
            <?php
            $query = "SELECT * FROM `etudiants`"; // Récupérer tous les étudiants
            $query_run = mysqli_query($connection, $query); // Exécuter la requête

            if ($query_run && mysqli_num_rows($query_run) > 0) {
                while ($row = mysqli_fetch_assoc($query_run)) {
                    // Vérifier si le chemin de l'image est vide
                    $imagePath = !empty($row['Image']) ? 'upload/images/' . $row['Image'] : 'upload/images/blanc.png';

                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-6"> <!-- Conteneur de chaque étudiant -->
                        <a href="detaille_etudiant.php?id=<?php echo htmlspecialchars($row['EtudiantID']); ?>" class="card-link">
                            <div class="our-team">
                                <div class="pic">
                                    <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="Image de l'étudiant">
                                </div>
                                <div class="team-content">
                                    <h3 class="title"><?php echo htmlspecialchars($row['Etudiant_name'] . ' ' . $row['Etudiant_prenom']); ?></h3>
                                </div>
                                <ul class="social">
                                    <li>
                                        <a href="https://wa.me/<?php echo htmlspecialchars($row['Tele']); ?>">
                                            <i class="fa fa-phone"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='text-center'>Aucun étudiant trouvé</p>"; // Afficher un message si aucun étudiant n'est trouvé
            }
            ?>
            </div> <!-- Fin du conteneur des étudiants -->
        </div> <!-- Fin de la colonne principale -->
    </div> <!-- Fin de la rangée principale -->
</div> <!-- Fin du conteneur principal -->

<!-- Scripts nécessaires pour Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
include('includes/footer.php'); // Inclure le footer
?>
</body>
</html>
