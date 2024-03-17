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
            <h6 class="m-0 font-weight-bold text-primary">Ajouter admin</h6>
        </div>
        <div class="card-body">
            <?php
            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<h2 class="bg-primary text-white"> ' . $_SESSION['success'] . ' </h2>
                <meta http-equiv="refresh" content="5; url = Ajouter_admin.php" />';
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
                    <label>Nom </label>
                    <input type="text" name="nom" class="form-control" placeholder="Entrer Nom">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Entrer Email">
                </div>
                <div class="form-group">
    <label>Mot de passe</label>
    <div class="input-group">
        <input type="password" name="password" id="password" class="form-control" placeholder="Entrer Mot de passe">
        <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="far fa-eye" id="eye"></i></button>
    </div>
</div>

<div class="form-group">
    <label> Confirmer le mot de passe</label>
    <input type="password" name="confirmepassword" class="form-control" placeholder="Confirmer le mot de passe">
</div>
<div class="form-group">
    <label>Type</label>
    <select name="type" class="form-control">
        <option value="" selected disabled>Sélectionner le type</option>
        <option value="Admin">Admin</option>
        <option value="Super">Super</option>
    </select>
</div>
        </div>
        <div class="modal-footer">
    <button type="button" class="btn btn-secondary" onclick="window.location.href='register.php'">Fermer</button>
    <button type="submit" name="adminbtn" class="btn btn-primary">Enregistrer</button>


        </div>
        </form>
    </div>
  </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
