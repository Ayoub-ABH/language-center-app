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
            <h6 class="m-0 font-weight-bold text-primary">Modifier les données </h6>
        </div>
        <div class="card-body">
            <?php

            if (isset($_POST['editx_btn'])) {
                $XEtudiantID = $_POST['edit_id'];
                $query = "SELECT * FROM x_etudiants WHERE ID='$XEtudiantID' ";
                $query_run = mysqli_query($connection, $query);

                foreach ($query_run as $row) {
            ?>
                    <form action="code.php" method="post" enctype="multipart/form-data">

                        <input type="hidden" name="edit_id" value="<?php echo $row['ID'] ?>">
                        <div class="form-group">
                            <label> Nom </label>
                            <input type="text" name="edit_xetudiantname" value="<?php echo $row['nom'] ?>" class="form-control" placeholder="Entrer nom">
                        </div>
                        <div class="form-group">
                            <label> Prénom </label>
                            <input type="text" name="edit_xetudiantprenom" value="<?php echo $row['prenom'] ?>" class="form-control" placeholder="Entrer prénom">
                        </div>
                        <div class="form-group">
                            <label> CIN </label>
                            <input type="text" name="edit_xetudiantcin" value="<?php echo $row['CIN'] ?>" class="form-control" placeholder="Entrer CIN ">
                        </div>
                        <div class="form-group">
                            <label> Genre </label>
                            <select name="edit_xetudiantgenre" class="form-control">
                                <option value="" disabled>Sélectionner le genre</option>
                                <option value="Masculin" <?php echo ($row['genre'] == 'Masculin') ? 'selected' : ''; ?>>Masculin</option>
                                <option value="Féminin" <?php echo ($row['genre'] == 'Féminin') ? 'selected' : ''; ?>>Féminin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Email</label>
                            <input type="email" name="edit_email" value="<?php echo $row['Email'] ?>" class="form-control" placeholder="Entrer Email">
                        </div>
                        <div class="form-group">
                            <label> Téléphone</label>
                            <input type="text" name="edit_xetudianttele" value="<?php echo $row['Tele'] ?>" class="form-control" placeholder="Entrer téléphone">
                        </div>
                        <div class="form-group">
                            <label> Adresse</label>
                            <input type="text" name="edit_xetudiantadresse" value="<?php echo $row['Adresse'] ?>" class="form-control" placeholder="Entrer Adresse">
                        </div>
                        <div class="form-group">
                            <label> Date d'inscription </label>
                            <input type="date" name="edit_xetudiantdate" value="<?php echo $row['Date_inscription'] ?>" class="form-control" placeholder="Entrer Date d'inscription">
                        </div>


                        <div class="form-group">
                            <label> Niveau d'étudiant</label>
                            <select name="edit_xetudiantniveau" class="form-control">
                                <option value="" disabled>Sélectionner un niveau</option>
                                <?php
                                $query_niveau = "SELECT * FROM `niveau`";
                                $query_run_niveau = mysqli_query($connection, $query_niveau);
                                if ($query_run_niveau) {
                                    while ($niveauRow = mysqli_fetch_assoc($query_run_niveau)) {
                                        $selected = ($niveauRow['Niveau_name'] == $row['Niveau']) ? 'selected' : '';
                                ?>
                                        <option value="<?php echo $niveauRow['Niveau_name']; ?>" <?php echo $selected; ?>>
                                            <?php echo $niveauRow['Niveau_name']; ?>
                                        </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Image actuelle</label>
                            <br>
                            <img src="upload/images_etudiants_exclus/<?php echo $row['Image']; ?>" alt="Image d'étudiant" width="100">
                        </div>
                        <div class="form-group">
                            <label> Nouvelle image </label>
                            <input type="file" name="edit_xetudiantimage" class="form-control">
                        </div>
                        <div class="form-group">
                            <label> Password </label>
                            <input type="text" name="edit_xetudiantpassword" value="<?php echo $row['Password'] ?>" class="form-control" placeholder="Entrer mot de passe ">
                        </div>

                        <div class="form-group">
                            <label> Certifié </label>
                            <select name="edit_xetudiantcertifie" class="form-control">
                                <option value="certifie" <?php echo ($row['certifie'] == 'certifie') ? 'selected' : ''; ?>>certifie</option>
                                <option value="non_certifie" <?php echo ($row['certifie'] == 'non_certifie') ? 'selected' : ''; ?>>non certifie</option>
                            </select>
                        </div>
                        <a href="x_etudiants.php" class="btn btn-danger">Annuler</a>
                        <button type="submit" name="updatexbtn" class="btn btn-primary">Mettre à jour </button>
                    </form>


            <?php
                }
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
