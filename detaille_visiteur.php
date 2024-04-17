<?php
include('dbconfig.php');
include('security.php');
secAdmin();

include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php
            if (isset($_GET['id'])) {
                $visiteurId = $_GET['id'];
                $queryVisiteur = "SELECT * FROM visiteurs WHERE VisiteurID = ?";
                
                if ($stmt = $connection->prepare($queryVisiteur)) {
                    $stmt->bind_param("i", $visiteurId);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($rowVisiteur = $result->fetch_assoc()) {
                        // Vérifier si une photo est disponible, sinon utiliser une image par défaut
                        $visiteurImage = !empty($rowVisiteur['Image']) ? $rowVisiteur['Image'] : 'blanc.png';
                        ?>
                        <div class="card border-0 shadow">
                            <div class="card-body text-center">
                                <div class="mb-4">
                                    <img src="upload/images/<?php echo htmlspecialchars($visiteurImage); ?>" class="img-fluid rounded" alt="avatar" style="max-width: 200px;">
                                </div>
                                <h5 class="card-title text-primary"><?php echo htmlspecialchars($rowVisiteur['Visiteur_name'] . ' ' . $rowVisiteur['Visiteur_prenom']); ?></h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong>CIN:</strong> <?php echo htmlspecialchars($rowVisiteur['CIN']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Email:</strong> <?php echo htmlspecialchars($rowVisiteur['Email']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Téléphone:</strong> <?php echo htmlspecialchars($rowVisiteur['Tele']); ?>
                                        <a href="https://wa.me/<?php echo htmlspecialchars($rowVisiteur['Tele']); ?>" target="_blank" class="text-success ml-2"><i class="fab fa-whatsapp"></i></a>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Adresse:</strong> <?php echo htmlspecialchars($rowVisiteur['Adresse']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Date de visite:</strong> <?php echo htmlspecialchars($rowVisiteur['Date_visite']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Niveau:</strong> <?php echo htmlspecialchars($rowVisiteur['Niveau']); ?>
                                    </li>
                                    <!-- Ajouter d'autres informations du visiteur ici -->
                                </ul>
                            </div>
                        </div>
                        <?php
                    } else {
                        echo '<div class="alert alert-danger text-center mt-4">Détails non disponibles</div>';
                    }
                    $stmt->close();
                } else {
                    echo '<div class="alert alert-danger text-center mt-4">Erreur de préparation de la requête SQL</div>';
                }
            } else {
                echo '<div class="alert alert-warning text-center mt-4">ID du visiteur non spécifié</div>';
            }
            ?>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
