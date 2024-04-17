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
                $professorId = $_GET['id'];
                $queryProfessor = "SELECT * FROM professeurs WHERE ProfesseurID = ?";
                
                if ($stmt = $connection->prepare($queryProfessor)) {
                    $stmt->bind_param("i", $professorId);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($rowProfessor = $result->fetch_assoc()) {
                        // Récupérer le nombre de groupes associés à ce professeur
                        $queryCountGroups = "SELECT COUNT(*) AS group_count FROM groupes WHERE ProfesseurID = ?";
                        if ($stmtCount = $connection->prepare($queryCountGroups)) {
                            $stmtCount->bind_param("i", $professorId);
                            $stmtCount->execute();
                            $resultCount = $stmtCount->get_result();
                            $rowCount = $resultCount->fetch_assoc();
                            $groupCount = $rowCount['group_count'];
                            $stmtCount->close();
                        } else {
                            $groupCount = 0;
                        }
                        // Vérifier si une photo est disponible, sinon utiliser une image par défaut
                        $professorImage = !empty($rowProfessor['Image']) ? $rowProfessor['Image'] : 'blanc.png';
                        ?>
                        <div class="card border-0 shadow">
                            <div class="card-body text-center">
                                <div class="mb-4">
                                    <img src="upload/images/<?php echo htmlspecialchars($professorImage); ?>" class="img-fluid rounded" alt="avatar" style="max-width: 200px;">
                                </div>
                                <h5 class="card-title text-primary"><?php echo htmlspecialchars($rowProfessor['Professeur_name'] . ' ' . $rowProfessor['Professeur_prenom']); ?></h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong>CIN:</strong> <?php echo htmlspecialchars($rowProfessor['CIN']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Email:</strong> <?php echo htmlspecialchars($rowProfessor['Email']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Téléphone:</strong> <?php echo htmlspecialchars($rowProfessor['Tele']); ?>
                                        <a href="https://wa.me/<?php echo htmlspecialchars($rowProfessor['Tele']); ?>" target="_blank" class="text-success ml-2"><i class="fab fa-whatsapp"></i></a>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Adresse:</strong> <?php echo htmlspecialchars($rowProfessor['Adresse']); ?>
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Nombre de groupes associés:</strong> <?php echo htmlspecialchars($groupCount); ?>
                                    </li>
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
                echo '<div class="alert alert-warning text-center mt-4">ID du professeur non spécifié</div>';
            }
            ?>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
