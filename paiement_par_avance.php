<?php
include('dbconfig.php');
include('security.php');
secAdmin();
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Paiements par avance</h6>
        </div>


        <div class="card-body">
            <?php
            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<h2 class="bg-primary text-white"> ' . $_SESSION['success'] . ' </h2>
                <meta http-equiv="refresh" content="5; url = paiement_complet.php" />';
                unset($_SESSION['success']);
            }

            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                echo '<h2 class="bg-danger text-white"> ' . $_SESSION['status'] . ' </h2>';
                unset($_SESSION['status']);
            }
            ?>
            <div class="table-responsive">
                <?php
                $query = "SELECT * FROM etudiants JOIN paiements ON etudiants.CIN = paiements.CIN and paiements.nature = 'avance';";
                $query_run = mysqli_query($connection, $query);
                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>CIN</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>type de paiement</th>
                            <th>nature de paiement</th>
                            <th>mois</th>
                            <th>annee</th>
                            <th>avance</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>
                                <tr>
                                    <td><?php echo $row['Id']; ?></td>
                                    <td><?php echo $row['CIN']; ?></td>
                                    <td><?php echo $row['Etudiant_name']; ?></td>
                                    <td><?php echo $row['Etudiant_prenom']; ?></td>
                                    <td><?php echo $row['type'] ?></td>
                                    <td>
                                        <span class="badge badge-warning" style="font-size: 16px;">
                                            <?php echo $row['nature'] ?></td>
                                        </span>
                                    <td><?php echo $row['mois'] ?></td>
                                    <td><?php echo $row['annee'] ?></td>
                                    <td>
                                        <?php echo $row['Avance'] ?>
                                    </td>
                                    <td>
                                        <a href="update_paiement.php?cin=<?php echo $row['CIN']; ?>&Id=<?php echo $row['Id']; ?>" class="badge badge-success" style="font-size: 16px;">
                                            modifier
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "Aucun enregistrement trouvé";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- WhatsApp Floating Button -->
        <div class="whatsapp-float">
            <a href="https://api.whatsapp.com/send?phone=YOUR_PHONE_NUMBER" target="_blank" class="whatsapp-float-button">WhatsApp</a>
        </div>
        <!-- End WhatsApp Floating Button -->
        
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
