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
            <h6 class="m-0 font-weight-bold text-primary">Modifier les données d'utilisateur</h6>
        </div>
        <div class="card-body">
            <?php
            if(isset($_POST['updatabtn']))
            {
                $UserID = $_POST['edita_id'];
                $query = "SELECT * FROM users WHERE UserID='$UserID'";
                $query_run = mysqli_query($connection, $query);
                $row = mysqli_fetch_assoc($query_run);
            ?>
            <form action="code.php" method="post">
                <input type="hidden" name="edita_id" value="<?php echo $row['UserID'] ?>">
                <div class="form-group">
                    <label>Nom d'utilisateur</label>
                    <input type="text" name="edit_username" value="<?php echo $row['Username'] ?>" class="form-control" placeholder="Entrer Nom d'utilisateur">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="edit_email" value="<?php echo $row['Email'] ?>" class="form-control" placeholder="Entrer Email">
                </div>
                <div class="form-group">
                    <label>Mot de passe</label>
                    <div class="input-group">
                        <input type="password" name="edit_password" value="<?php echo $row['Password'] ?>" class="form-control" placeholder="Entrer Mot de passe">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-eye" id="togglePassword"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Rôle</label>
                    <select name="update_usertype" class="form-control">
                        <option value="Admin" <?php if($row['Usertype'] == 'Admin') echo 'selected="selected"'; ?>>Admin</option>
                        <option value="Super" <?php if($row['Usertype'] == 'Super') echo 'selected="selected"'; ?>>Super</option>
                    </select>
                </div>
                <a href="register.php" class="btn btn-danger">Annuler</a>
                <button type="submit" name="updatabtn" class="btn btn-primary">Mettre à jour</button>
            </form>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('input[name="edit_password"]');
    
    togglePassword.addEventListener('click', function (e) {
        // Change le type du champ entre password et text
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Change l'icône de l'œil
        this.classList.toggle('fa-eye-slash');
    });
</script>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
