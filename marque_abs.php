<?php
include('security.php');
secAdmin(); 

include('includes/header.php');
include('includes/navbar.php');
include('dbconfig.php'); 

if (isset($_GET['groupe_id']) && is_numeric($_GET['groupe_id'])) {
    $groupe_id = intval($_GET['groupe_id']); 
} 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Ajouter Absence</title> 
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
            width: 250px;
            height: 150px;
            overflow: hidden;
        }

        .visitor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        }

        .etudiant-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ajouter Absence</h6>
                <div class="card-body"> 
                    <label>
                        <input type="checkbox" id="mark-all" onclick="toggleAttendance(this)"> Marquer tous les étudiants
                    </label>
                    <?php
                    
                    if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                        echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                        unset($_SESSION['success']); 
                    }

                    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                        echo '<div class="alert alert-danger">' . $_SESSION['status'] . '</div>';
                        unset($_SESSION['status']); 
                    }
                    ?>
                </div>
            </div>
        </div>

        <form action="marquer_absence.php" method="POST"> 
            <div class="row">
                <?php
                $query = "SELECT EtudiantID, Etudiant_name, Etudiant_prenom 
                          FROM etudiants 
                          WHERE GroupeID = ?";
                $stmt = $connection->prepare($query);

                if ($stmt) { 
                    $stmt->bind_param("i", $groupe_id);
                    $stmt->execute(); 
                    $result = $stmt->get_result();

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="visitor-card">
                                    <h3 class="etudiant-name"><?php echo htmlspecialchars($row['Etudiant_name'] . ' ' . $row['Etudiant_prenom']); ?></h3>
                                    <input type="checkbox" name="etudiant_ids[]" value="<?php echo htmlspecialchars($row['EtudiantID']); ?>" class="attendance-checkbox"> 
                                </div>
                            </div>
                            <?php
                        }
                    } }
                ?>
            </div>

            <div>
                <button type="submit" class="btn btn-success" name="marquer_presence_tous">Marquer Présence</button>
                <button type="submit" class="btn btn-danger" name="marquer_absence_tous">Marquer Absence</button>
            </div>
        </form>
    </div>

    <script>
        function toggleAttendance(checkbox) {
            const checkboxes = document.querySelectorAll('.attendance-checkbox');
            checkboxes.forEach(cb => {
                cb.checked = checkbox.checked; // Basculer l'état de tous les checkboxes
            });
        }
    </script>
</body>

<?php
include('includes/footer.php'); 
?>
