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
                <meta http-equiv="refresh" content="5; url = Ajouter_paiement.php" />';
                unset($_SESSION['success']);
            }

            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                echo '<h2 class="bg-danger text-white"> ' . $_SESSION['status'] . ' </h2>';
                unset($_SESSION['status']);
            }
            ?>
        </div>

        <div class="card-body">
            <form action="code.php" method="post">
                <?php
                if (isset($_GET['Id'])) {
                    $Id = $_GET['Id'];
                ?>
                    <input type="hidden" name="Id"  value=<?php echo $Id; ?>>
                <?php
                }
                ?>
                <div class="form-group">
                    <label> Carte d'identiter nationale</label>
                    <?php
                    if (isset($_GET['cin'])) {
                        $CIN = $_GET['cin'];
                    ?>
                        <input type="text" name="CIN" class="form-control" value=<?php echo $CIN; ?> placeholder="carte didentiter nationale">
                    <?php
                    }else {
                    ?>
                        <input type="text" name="CIN" class="form-control" placeholder="carte didentiter nationale">
                    <?php
                    }
                    ?>
                </div>

                <div class="form-group">
                    <label for="type_de_paiement">Type de paiement</label>
                    <select name="type_de_paiement" class="form-control">
                        <option value="extensive" selected>extensive</option>
                        <option value="normal">normal</option>
                    </select>
                </div>

                <div class="form-group">
                    <label> Paiement complet ou avance</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="nature_de_paiement" id="complet" value="complet" checked>
                        <label class="form-check-label" for="complet">
                            Paiement complet
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="nature_de_paiement" id="avance" value="avance">
                        <label class="form-check-label" for="avance">
                            Paiement avance
                        </label>
                    </div>
                </div>


                <div class="form-group">
                    <label> Avance en DH</label>
                    <input type="number" name="avance" class="form-control" value="0" placeholder="Avance">
                </div>


                <div class="form-group">
                    <label> Mois du paiement</label>
                    <input type="date" name="mois_paiement" class="form-control" placeholder="Mois du paiment">
                </div>



                <button type="submit" name="UpdatePaiementBtn" class="btn btn-primary">modifier paiement</button>
            </form>

        </div>
    </div>
</div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
