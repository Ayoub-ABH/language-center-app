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
                $query = "SELECT paiements.*, etudiants.Tele , etudiants.Etudiant_name , etudiants.Etudiant_prenom FROM etudiants JOIN paiements ON etudiants.CIN = paiements.CIN and paiements.nature = 'avance';";
                $query_run = mysqli_query($connection, $query);
                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>CIN</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Telephone</th>
                            <th>type de paiement</th>
                            <th>nature de paiement</th>
                            <th>mois</th>
                            <th>annee</th>
                            <th>avance</th>
                            <th>Action</th>
                            <th>WhatsApp</th> <!-- New column for WhatsApp button -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($query_run) {
                            if (mysqli_num_rows($query_run) > 0) {
                                while ($row = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['Id']; ?></td>
                                        <td><?php echo $row['CIN']; ?></td>
                                        <td><?php echo $row['Etudiant_name']; ?></td>
                                        <td><?php echo $row['Etudiant_prenom']; ?></td>
                                        <td><?php echo $row['Tele']; ?></td>
                                        <td><?php echo $row['type']; ?></td>
                                        <td>
                                            <span class="badge badge-warning" style="font-size: 16px;">
                                                <?php echo $row['nature']; ?>
                                            </span>
                                        </td>
                                        <td><?php echo $row['mois']; ?></td>
                                        <td><?php echo $row['annee']; ?></td>
                                        <td><?php echo $row['Avance']; ?></td>
                                        <td>
                                            <a href="update_paiement.php?cin=<?php echo $row['CIN']; ?>&Id=<?php echo $row['Id']; ?>" class="badge badge-success" style="font-size: 16px;">modifier</a>
                                        </td>
                                        <td> <!-- WhatsApp button column -->
                                            <a href="https://api.whatsapp.com/send?phone=<?php echo $row['Tele']; ?>&text=Bonjour <?php echo $row['Etudiant_name']; ?> <?php echo $row['Etudiant_prenom']; ?>, Merci de compléter votre paiement." target="_blank" class="btn btn-success btn-sm">WhatsApp</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "Aucun enregistrement trouvé";
                            }
                        } else {
                            echo "Erreur dans la requête : " . mysqli_error($connection);
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
