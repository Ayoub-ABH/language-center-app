<?php
include('dbconfig.php');
include('security.php');
secAdmin();

include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container py-5">
    <div class="row mt-3">
        <div class="col-md-12">
            <h1 class="h3 mb-0 text-gray-800">Liste des Etudiants</h1>
        </div>
    </div>

    <div class="row mt-4">
        <?php
        $query = "SELECT * FROM `etudiants`";
        $query_run = mysqli_query($connection, $query);

        if (mysqli_num_rows($query_run) > 0) {
            while ($row = mysqli_fetch_assoc($query_run)) {
        ?>
                <div class="col-md-3 mt-3">
                    <div class="card">
                        <img src="upload/<?php echo $row['Image']; ?>" width="250px" height="200px" alt="Etudiant_image">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $row['Etudiant_name']; ?></h4>
                            <h3 class="card-title"><?php echo $row['Niveau']; ?></h3>
                            <p class="card-text">
                                <?php echo $row['Description']; ?>
                            </p>
                            <button class="btn btn-success">Afficher Details</button>
                        </div>
                    </div>
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
if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
    echo '<h2 class="bg-primary text-white"> ' . $_SESSION['success'] . ' </h2>
    <meta http-equiv="refresh" content="5; url = liste_etudiants.php" />';
    unset($_SESSION['success']);
}

if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    echo '<h2 class="bg-danger  text-white"> ' . $_SESSION['status'] . ' </h2>';
    unset($_SESSION['status']);
}

include('includes/scripts.php');
include('includes/footer.php');
?>
