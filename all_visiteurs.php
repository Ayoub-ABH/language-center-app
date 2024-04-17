<?php
include('security.php');
secAdmin();

include('includes/header.php');
include('includes/navbar.php');
include('dbconfig.php');
?>

<head>
    <link rel="stylesheet" type="text/css" href="css/etudiant_admin.css?v=1.0">
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
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .visitor-info {
            margin-top: 10px;
            font-size: 16px;
            color: #555;
        }
    </style>
</head>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des Visiteurs</h6>
        </div>
    </div>

    <div class="row">
        <?php
        $query = "SELECT * FROM `visiteurs`"; 
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="detaille_visiteur.php?id=<?php echo htmlspecialchars($row['VisiteurID']); ?>" class="card-link">
                        <div class="visitor-card">
                            <h3 class="visitor-name"><?php echo htmlspecialchars($row['Visiteur_name'] . ' ' . $row['Visiteur_prenom']); ?></h3>
                            <p class="visitor-info">Téléphone: <?php echo htmlspecialchars($row['Tele']); ?></p>
                        </div>
                    </a>
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
include('includes/footer.php');
?>
