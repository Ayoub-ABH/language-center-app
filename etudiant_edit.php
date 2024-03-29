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
            <h6 class="m-0 font-weight-bold text-primary">Modifier les données de l'étudiant</h6>
        </div>
        <div class="card-body">
            <?php

            if(isset($_POST['edite_btn']))
            {
                $EtudiantID = $_POST['edit_id'];
                $query = "SELECT * FROM etudiants WHERE EtudiantID='$EtudiantID' ";
                $query_run = mysqli_query($connection, $query);

                foreach($query_run as $row)
                {
                    ?>


                    <form action="code.php" method="post"  enctype="multipart/form-data">

                        <input type="hidden" name="edit_id" value="<?php echo $row['EtudiantID'] ?>">
                        <div class="form-group">
                            <label> Nom d'étudiant</label>
                            <input type="text" name="edit_etudiantname" value="<?php echo $row['Etudiant_name'] ?>" class="form-control" placeholder="Entrer nom d'étudiant">
                        </div>
                        <div class="form-group">
                            <label> Prénom d'étudiant</label>
                            <input type="text" name="edit_etudiantprenom" value="<?php echo $row['Etudiant_prenom'] ?>" class="form-control" placeholder="Entrer prénom d'étudiant">
                        </div>
                        <div class="form-group">
                            <label> CIN </label>
                            <input type="text" name="edit_etudiantcin" value="<?php echo $row['CIN'] ?>" class="form-control" placeholder="Entrer CIN d'étudiant">
                        </div>
                        <div class="form-group">
    <label> Genre </label>
    <select name="edit_etudiantgenre" class="form-control">
        <option value="" disabled>Sélectionner le genre</option>
        <option value="Masculin" <?php echo ($row['genre'] == 'Masculin') ? 'selected' : ''; ?>>Masculin</option>
        <option value="Féminin" <?php echo ($row['genre'] == 'Féminin') ? 'selected' : ''; ?>>Féminin</option>
    </select>
</div>
       <div class="form-group">
                            <label> Email</label>
                            <input type="email" name="edit_email" value="<?php echo $row['Email'] ?>"  class="form-control" placeholder="Entrer Email">
                        </div>
                        <div class="form-group">
                            <label> Téléphone</label>
                            <input type="text" name="edit_etudianttele" value="<?php echo $row['Tele'] ?>" class="form-control" placeholder="Entrer téléphone d'étudiant">
                        </div>
                        <div class="form-group">
                            <label> Adresse</label>
                            <input type="text" name="edit_etudiantadresse" value="<?php echo $row['Adresse'] ?>" class="form-control" placeholder="Entrer Adresse d'étudiant">
                        </div>
                        <div class="form-group">
                            <label> Date d'inscription </label>
                            <input type="date" name="edit_etudiantdate" value="<?php echo $row['Date_inscription'] ?>" class="form-control" placeholder="Entrer Date d'inscription">
                        </div>
                        <div class="form-group">
                            <label> Niveau d'étudiant</label>
                            <select name="edit_etudiantniveau" class="form-control">
                                <option value="" disabled>Sélectionner un niveau</option>
                                <?php 
                                $query = "SELECT * FROM `niveau`";
                                $query_run = mysqli_query($connection, $query);
                                if ($query_run) {
                                    while ($niveauRow = mysqli_fetch_assoc($query_run)) {
                                        $selected = ($niveauRow['Niveau_name'] == $row['Niveau']) ? 'selected' : '';
                                        ?>
                                        <option value="<?php echo $niveauRow['Niveau_name']; ?>" <?php echo $selected; ?>><?php echo $niveauRow['Niveau_name']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label> Groupe</label>
                            <select name="edit_etudiantgroupe" class="form-control">
                                <option value="" disabled>Sélectionner un groupe</option>
                                <?php 
                                $query = "SELECT * FROM `groupes`";
                                $query_run = mysqli_query($connection, $query);
                                if ($query_run) {
                                    while ($groupeRow = mysqli_fetch_assoc($query_run)) {
                                        $selected = ($groupeRow['Groupe_name'] == $row['Groupe']) ? 'selected' : '';
                                        ?>
                                        <option value="<?php echo $groupeRow['Groupe_name']; ?>" <?php echo $selected; ?>><?php echo $groupeRow['Groupe_name']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Image d'étudiant actuelle</label>
                            <br>
                            <img src="upload/images/<?php echo $row['Image']; ?>" alt="Image d'étudiant" width="100">
                        </div>
                        <div class="form-group">
                            <label> Nouvelle image d'étudiant</label>
                            <input type="file" name="edit_etudiantimage" class="form-control">
                        </div>
                        <div class="form-group">
                            <label> Prix</label>
                            <input type="text" name="edit_etudiantprix" value="<?php echo $row['prix'] ?>" class="form-control" placeholder="Entrer prix ">
                        </div>
                        <div class="form-group">
    <label> Type des cours </label>
    <select name="type_cours" class="form-control">
        <option value="" disabled>Sélectionner le type des cours</option>
        <option value="extensive" <?php echo ($row['type_cours'] == 'extensive') ? 'selected' : ''; ?>>Extensive</option>
        <option value="normal" <?php echo ($row['type_cours'] == 'normal') ? 'selected' : ''; ?>>Normal</option>
        <option value="Enligne" <?php echo ($row['type_cours'] == 'Enligne') ? 'selected' : ''; ?>>En ligne</option>
    </select>
</div>
                        <div class="form-group">
                            <label> Password </label>
                            <input type="text" name="edit_etudiantpassword" value="<?php echo $row['Password'] ?>" class="form-control" placeholder="Entrer mot de passe d'étudiant">
                        </div>
                        
                        <a href="etudiants.php" class="btn btn-danger">Annuler</a>
                        <button type="submit" name="updateebtn" class="btn btn-primary">Mettre à jour </button>
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
