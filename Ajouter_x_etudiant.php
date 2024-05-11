<?php
include ('dbconfig.php');
include ('security.php');
secAdmin();
include ('includes/header.php');
include ('includes/navbar.php');

?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Ajouter xétudiant</h6>
        </div>
        <div class="card-body">
        <?php
            if(isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<h6 class="alert alert-success" role="alert"> '.$_SESSION['success'].' </h6>
                <meta http-equiv="refresh" content="5; url = Ajouter_x_etudiant.php" />';
                unset($_SESSION['success']);
            }

            if(isset($_SESSION['status']) && $_SESSION['status'] != '') {
                echo '<h6 class="alert alert-danger" role="alert"> '.$_SESSION['status'].' </h6>';
                unset($_SESSION['status']);
            }
            ?>
        </div>

        <div class="card-body">
            <form action="code.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nom d'étudiant </label>
                    <input type="text" name="nom" class="form-control" placeholder="Entrer Nom">
                </div>
                <div class="form-group">
                    <label>Prénom d'étudiant </label>
                    <input type="text" name="prenom" class="form-control" placeholder="Entrer Prénom">
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
                    <input type="date" name="date_inscription" class="form-control"
                        placeholder="Entrer Date d'inscription">
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
                    <label>Certifié</label>
                    <select name="genre" class="form-control">
                        <option value="Masculin">Certifié</option>
                        <option value="Féminin">Non certifié</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="xetudiant_image" id="xetudiant_image" class="form-control"
                        placeholder="Entrer Image" onchange="previewImage()">
                    <img id="preview" src="upload/images_etudiants_exclus<?php echo $xetudiant_image; ?>"
                        alt="Aperçu de l'image" style="max-width: 15%; margin-top: 10px; display: none;">
                </div>
                <div class="form-group">
                    <label>Mot de passe</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Entrer Mot de passe">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i
                                class="far fa-eye" id="eye"></i></button>
                    </div>
                </div>

                <div class="form-group">
                    <label> Confirmer le mot de passe</label>
                    <input type="password" name="confirmepassword" class="form-control"
                        placeholder="Confirmer le mot de passe">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" name="xetudiantbtn" class="btn btn-primary">Enregistrer</button>
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
        const file = document.getElementById('xetudiant_image').files[0];
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
include ('includes/scripts.php');
include ('includes/footer.php');
?>