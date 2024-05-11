<?php
include('security.php');
secAdmin();

include('includes/header.php');
include('includes/navbar.php');
include('dbconfig.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .professor-card {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            margin-bottom: 20px;
        }

        .professor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        }

        .professor-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .professor-phone {
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
                let searchTerm = $(this).val().toLowerCase(); // Obtenir la valeur de recherche

                let $container = $('.professor-container'); // Conteneur des cartes

                // Réorganiser les cartes basées sur la recherche
                $container.each(function() {
                    let $card = $(this).find('.professor-card');
                    let professorName = $card.find('.professor-name').text().toLowerCase();
                    let professorPhone = $card.find('.professor-phone').text().toLowerCase();

                    if (professorName.includes(searchTerm) || professorPhone.includes(searchTerm)) {
                        $(this).show();
                        $(this).prependTo($('.professor-list')); // Déplacer la carte en haut
                    } else {
                        $(this).hide();
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
            <h6 class="m-0 font-weight-bold text-primary">Liste des Professeurs</h6>
        
            <div class="search-bar">
                <input type="text" name="search" class="search-input" placeholder="Rechercher... ">
            </div>
        </div>
    </div>

    <div class="row professor-list"> <!-- Ajout d'un conteneur parent -->
        <?php
        $query = "SELECT * FROM professeurs";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-lg-3 col-md-6 col-sm-6 professor-container">
                    <a href="detaille_prof.php?id=<?php echo htmlspecialchars($row['ProfesseurID']); ?>" class="card-link">
                        <div class="professor-card">
                            <h3 class="professor-name"><?php echo htmlspecialchars($row['Professeur_name'] . ' ' . $row['Professeur_prenom']); ?></h3>
                            <p class="professor-phone">Téléphone: <?php echo htmlspecialchars($row['Tele']); ?></p>
                        </div>
                    </a>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-center'>Aucun professeur trouvé</p>";
        }
        ?>
    </div>
</div>

<!-- Scripts nécessaires pour Bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php
include('includes/footer.php');
?>
</body>
</html>
