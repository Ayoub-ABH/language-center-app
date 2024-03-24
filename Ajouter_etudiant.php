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
            <h6 class="m-0 font-weight-bold text-primary">Ajouter etudiant</h6>
        </div>
        <div class="card-body">
            <?php
            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<h2 class="bg-primary text-white"> ' . $_SESSION['success'] . ' </h2>
                <meta http-equiv="refresh" content="5; url = Ajouter_etudiant.php" />';
                unset($_SESSION['success']);
            }

            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                echo '<h2 class="bg-danger text-white"> ' . $_SESSION['status'] . ' </h2>';
                unset($_SESSION['status']);
            }
            ?>
        </div>

        <div class="card-body">
            <form action="code.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                <label>Nom d'étudiant </label>
                <input type="text" name="nom" class="form-control" placeholder="Entrer Nom d'étudiant">
            </div>
            <div class="form-group">
                <label>Prénom d'étudiant </label>
                <input type="text" name="prenom" class="form-control" placeholder="Entrer Prénom d'étudiant">
            </div>
            <div class="form-group">
                <label>CIN</label>
                <input type="text" name="cin" class="form-control" placeholder="Entrer CIN">
            </div>

        <div class="form-group">
    <label>Genre</label>
    <select name="genre" class="form-control">
        <option value="" selected disabled>Sélectionner le genre</option>
        <option value="Masculin">Masculin</option>
        <option value="Féminin">Féminin</option>
    </select>
</div>

            <div class="form-group">
                <label> Email</label>
                <input type="email" name="email" class="form-control" placeholder="Entrer Email">
            </div> 

            
             <div class="form-group">
                <label>Numéro de téléphone</label>
                <input type="text" name="telephone" class="form-control" placeholder="Entrer Numéro de téléphone">
            </div>
            <div class="form-group">
                <label> Adresse</label>
                <input type="text" name="adresse" class="form-control" placeholder="Entrer Adresse">
            </div>
            <div class="form-group">
                <label> Date d'inscription</label>
                <input type="date" name="date_inscription" class="form-control" placeholder="Entrer Date d'inscription">
            </div>

            <div class="form-group">
                <label for="niveau">Niveau</label>
                <!-- Utiliser un seul champ (select) pour le niveau -->
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
                <label for="niveau">Groupe</label>
                <!-- Utiliser un seul champ (select) pour le niveau -->
                <select name="groupe" class="form-control">
                    <option value="" selected disabled>Sélectionner un groupe</option>
                    <?php 
                    $query = "SELECT * FROM `groupes`";
                    $query_run = mysqli_query($connection, $query);
                    if ($query_run) {
                        while ($row = mysqli_fetch_assoc($query_run)) { 
                    ?>
                    <option value="<?php echo $row['Groupe_name']; ?>"><?php echo $row['Groupe_name']; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
    <label>Image</label>
    <input type="file" name="etudiant_image" id="etudiant_image" class="form-control" placeholder="Entrer Image" onchange="previewImage()">
    <img id="preview" src="upload/images<?php echo $etudiant_image; ?>" alt="Aperçu de l'image" style="max-width: 15%; margin-top: 10px; display: none;">
   

</div>

<div class="form-group">
    <label>Prix</label>
    <input type="text" name="prix" class="form-control" placeholder="Entrer Prix">
</div>

<div class="form-group">
    <label>Type des cours</label>
    <select name="type_cours" class="form-control">
        <option value="" selected disabled>Sélectionner le type des cours</option>
        <option value="extensive">Extensive</option>
        <option value="normal">Normal</option>
        <option value="Enligne">En ligne</option>
    </select>
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

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
    <button type="submit" name="etudiantbtn" class="btn btn-primary">Enregistrer</button>
</div>
    </form>
    </div>
  </div>
</div>
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('far', 'fa-eye');
            eyeIcon.classList.add('fas', 'fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fas', 'fa-eye-slash');
            eyeIcon.classList.add('far', 'fa-eye');
        }
    });

    function previewImage() {
        const preview = document.getElementById('preview');
        const file = document.getElementById('etudiant_image').files[0];
        const reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            preview.style.display = 'block';
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
