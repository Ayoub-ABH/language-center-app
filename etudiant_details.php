<?php
include('dbconfig.php');
include('security.php');
secAdmin();

include('includes/header.php');
include('includes/navbar.php');

if (isset($_GET['id'])) {
    $studentId = $_GET['id'];
    $queryStudent = "SELECT * FROM etudiants WHERE EtudiantID = '$studentId'";
    $queryDocuments = "SELECT * FROM fichiers ";
    
    $queryStudent_run = mysqli_query($connection, $queryStudent);
    $queryDocuments_run = mysqli_query($connection, $queryDocuments);

    if (!$queryStudent_run) {
        die("Error in query: " . mysqli_error($connection));
    }

    if (!$queryDocuments_run) {
        die("Error in query: " . mysqli_error($connection));
    }

    if ($rowStudent = mysqli_fetch_assoc($queryStudent_run)) {
?>
        <div class="container py-5">
            <div class="row mt-3">
                <div class="col-md-12">
                    <h1 class="h3 mb-0 text-gray-800">Détails de l'étudiant</h1>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <img src="upload/<?php echo $rowStudent['Image']; ?>" width="300px" height="250px" alt="Etudiant_image">
                </div>
                <div class="col-md-6">
                    <h5>Nom: <?php echo $rowStudent['Etudiant_name']; ?></h5>
                    <h5>Prénom: <?php echo $rowStudent['Etudiant_prenom']; ?></h5>
                    
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <h2 class="h4 mb-0 text-gray-800">Documents de l'étudiant</h2>
                </div>
            </div>

            <div class="row mt-2">
                <?php
                while ($rowDocument = mysqli_fetch_assoc($queryDocuments_run)) {
                    // Display document details here (adjust as needed)
                    echo '<div class="col-md-3 mt-3">';
                    echo '<div class="card">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $rowDocument['name'] . '</h5>';
                    // Add more document details as needed
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
<?php
    } else {
        echo 'Détails non disponibles';
    }
} else {
    echo 'ID d\'étudiant non spécifié';
}

include('includes/footer.php');
?>
