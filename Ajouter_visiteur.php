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
            <h6 class="m-0 font-weight-bold text-primary">Ajouter visiteur</h6>
        </div>
        <div class="card-body">
            <?php
            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<h2 class="bg-primary text-white"> ' . $_SESSION['success'] . ' </h2>
                <meta http-equiv="refresh" content="5; url = Ajouter_visiteur.php" />';
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
                <div class="form-group">
                    <label>Nom du visiteur </label>
                    <input type="text" name="nom" class="form-control" placeholder="Entrer Nom du visiteur">
                </div>
                <div class="form-group">
                    <label>Prénom du visiteur </label>
                    <input type="text" name="prenom" class="form-control" placeholder="Entrer Prénom du visiteur">
                </div>
                <div class="form-group">
                    <label>CIN</label>
                    <input type="text" name="cin" class="form-control" placeholder="Entrer CIN">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Entrer Email">
                </div>
                <div class="form-group">
                    <label>Numéro de téléphone</label>
                    <input type="text" name="telephone" class="form-control" placeholder="Entrer Numéro de téléphone">
                </div>
                <div class="form-group">
                    <label>Adresse</label>
                    <input type="text" name="adresse" class="form-control" placeholder="Entrer Adresse">
                </div>
                <div class="form-group">
                    <label>Date de visite</label>
                    <input type="date" name="date_visite" class="form-control" placeholder="Entrer Date de visite">
                </div>

                <div class="form-group">
                    <label for="niveau">Niveau</label>
                    <select name="niveau" class="form-control">
                        <option value="" selected disabled>Sélectionner un niveau</option>
                        <?php 
                        $query = "SELECT * FROM `niveau`";
                        $query_run = mysqli_query($connection, $query);
                        if ($query_run) {
                            while ($row = mysqli_fetch_assoc($query_run)) { 
                        ?>
                        <option value="<?php echo $row['Niveau_name']; ?>"><?php echo $row['Niveau_name']; ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Observation</label>
                    <textarea type="text" name="observation" class="form-control" placeholder="Entrer Observation"></textarea>
                </div>
        </div>
        <div class="modal-footer">
    <button type="button" class="btn btn-secondary" onclick="window.location.href='visiteurs.php'">Fermer</button>
    <button type="submit" name="visiteurbtn" class="btn btn-primary">Enregistrer</button>


        </div>
        </form>
    </div>
  </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
