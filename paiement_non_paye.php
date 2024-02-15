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
            <h6 class="m-0 font-weight-bold text-primary">Liste des Groupes</h6>
            <form method="get" action="">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Moins</label>
                        <select name="mois" class="form-control">
                            <option value="" selected disabled>sélectionner le moins</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </div>
                  <div class="col-lg-4">
                        <div class="form-group">
                            <label class="invisible">Submit</label>
                            <button type="submit" class="btn btn-primary btn-block" name="btn_list_etudiants" value="true">Afficher les étudiants</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>







    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Non Paiements</h6>
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
                if (isset($_GET['btn_list_etudiants'])) {
                    $mois = $_GET['mois'];
                    $query = "SELECT *
                    FROM etudiants
                    WHERE NOT EXISTS (
                        SELECT 1
                        FROM paiements
                        WHERE paiements.CIN = etudiants.CIN 
                        AND paiements.mois = '$mois'
                    ) ;
                    ";
                $query_run = mysqli_query($connection, $query);
                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>CIN</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>etat</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>
                                <tr>
                                    <td><?php echo $row['EtudiantID']; ?></td>
                                    <td><?php echo $row['CIN']; ?></td>
                                    <td><?php echo $row['Etudiant_name']; ?></td>
                                    <td><?php echo $row['Etudiant_prenom']; ?></td>
                                    <td>
                                        <span class="badge badge-danger">
                                            non paye
                                        </span>
                                    </td>
                                    <td>
                                        <a href="Ajouter_paiement.php?cin=<?php echo $row['CIN']; ?>" class="badge badge-primary" style="font-size: 16px;">
                                        paye
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
                <?php
                } else {
                    echo "Veuillez sélectionner un mois";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
