<?php
include('dbconfig.php');
include('security.php');
secAdmin();

include('includes/header.php');
include('includes/navbar.php');

$queryGroupes = "SELECT * FROM groupes";
$result = mysqli_query($connection, $queryGroupes);

if (!$result) {
    die("Error in query: " . mysqli_error($connection));
}
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Liste des groupes</div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<li class="list-group-item">' . $row['Groupe_name'] . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
