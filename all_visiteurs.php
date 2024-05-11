<?php
include('security.php');
secAdmin(); // Sécurisation de l'accès

include('includes/header.php'); // Inclure le header
include('includes/navbar.php'); // Inclure la barre de navigation
include('dbconfig.php'); // Inclure la configuration de la base de données

// Inclure les styles CSS et scripts nécessaires
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Vos styles personnalisés -->
    <style>
        .visitor-card {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            margin-bottom: 20px;
        }

        .visitor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        }

        .visitor-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .visitor-info {
            font-size: 16px;
            color: #555;
        }

        .search-bar {
            padding: 10px;
            text-align: center;
        }

        .search-input {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            width: 100%; /* Largeur de la barre de recherche */
        }
    </style>
    
    <script>
        $(document).ready(function() {
            $('.search-input').on('input', function() {
                let searchTerm = $(this).val().toLowerCase(); // Obtenir la valeur de recherche en minuscule

                let $container = $('.visitor-list'); // Le conteneur parent des cartes

                // Réorganiser les cartes basées sur la recherche
                $('.visitor-card').each(function() {
                    let $card = $(this).find('.visitor-name, .visitor-info').text().toLowerCase(); // Texte des cartes
                    if ($card.includes(searchTerm)) {
                        $(this).parent().show(); // Afficher la carte et son parent
                        $(this).parent().prependTo($container); // Placer la carte en haut
                    } else {
                        $(this).parent().hide(); // Masquer la carte et son parent
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
            <h6 class="m-0 font-weight-bold text-primary">Liste des Visiteurs</h6>
        
            <div class="search-bar">
                <input type="text" name="search" class="search-input" placeholder="Rechercher... "> <!-- Barre de recherche -->
            </div>
        </div>
    </div>

    <div class="row visitor-list"> <!-- Conteneur pour les cartes -->
        <?php
        $query = "SELECT * FROM visiteurs"; // Requête pour obtenir les visiteurs
        $stmt = $connection->prepare($query); // Préparation de la requête
        $stmt->execute(); // Exécution de la requête
        $result = $stmt->get_result(); // Obtenir les résultats

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { // Parcourir les résultats
                ?>
                <div class="col-lg-3 col-md-6 col-sm-6 visitor-container"> <!-- Correction: Utilisation de la classe correcte -->
                    <a href="detaille_visiteur.php?id=<?php echo htmlspecialchars($row['VisiteurID']); ?>" class="card-link">
                        <div class="visitor-card"> <!-- Correction: Utilisation de la classe correcte -->
                            <h3 class="visitor-name"><?php echo htmlspecialchars($row['Visiteur_name'] . ' ' . $row['Visiteur_prenom']); ?></h3>
                            <p class="visitor-info">Téléphone: <?php echo htmlspecialchars($row['Tele']); ?></p>
                        </div>
                    </a>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-center'>Aucun visiteur trouvé</p>"; // Message si aucun visiteur n'est trouvé
        }
        ?>
    </div>
</div>

<!-- Scripts nécessaires pour Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
include('includes/footer.php'); // Inclure le footer
?>
</body>
</html>
