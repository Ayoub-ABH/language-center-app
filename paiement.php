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
            <h6 class="m-0 font-weight-bold text-primary">Paiements</h6>
        </div>
        <div class="card-body">
            <?php
            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<h2 class="bg-primary text-white"> ' . $_SESSION['success'] . ' </h2>
                <meta http-equiv="refresh" content="5; url = paiement.php" />';
                unset($_SESSION['success']);
            }

            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                echo '<h2 class="bg-danger text-white"> ' . $_SESSION['status'] . ' </h2>';
                unset($_SESSION['status']);
            }
            ?>
            <div class="table-responsive">
                <?php
                $query = "SELECT * FROM etudiants ";
                $query_run = mysqli_query($connection, $query);
                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Date de Paiement</th>
                            <th>Nombre de mois</th>
                            <th>Prix</th>
                            <th>Total</th>
                            <th>Paiement</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['EtudiantID']; ?></td>
                                    <td><?php echo $row['Etudiant_name']; ?></td>
                                    <td><?php echo $row['Etudiant_prenom']; ?></td>
                                    <td><?php echo date('Y-m-d H:i:s'); ?></td>
                                    <td>
                                        <div class="input-group">
                                            <button class="btn btn-outline-secondary" type="button" onclick="incrementMonths(this)">+</button>
                                            <input type="text" name="nombre_mois" value="1" class="qty_quantityInput" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" name="prix" value="<?php echo $row['Prix']; ?>" class="qty_quantityInput" />
                                        </div>
                                    </td>
                                    <td>
                                        <span id="total_<?php echo $row['EtudiantID']; ?>"><?php echo $row['Quantite'] * $row['Prix']; ?></span>
                                    </td>
                                    <td>
                                        <form action="code.php" method="post">
                                            <input type="hidden" name="etudiant_id" value="<?php echo $row['EtudiantID']; ?>">
                                            <input type="hidden" name="date_paiement" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                            <button type="submit" name="payer_btn" class="btn btn-danger">Payer</button>
                                        </form>
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
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>

<script>
    function incrementMonths(button) {
        var input = button.parentNode.querySelector('input[name="nombre_mois"]');
        var value = parseInt(input.value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        input.value = value;

        var prixInput = button.parentNode.parentNode.nextElementSibling.querySelector('input[name="prix"]');
        var prix = parseFloat(prixInput.value);
        var totalSpan = button.parentNode.parentNode.nextElementSibling.nextElementSibling.querySelector('span');
        totalSpan.textContent = (value * prix).toFixed(2);
    }
</script>
