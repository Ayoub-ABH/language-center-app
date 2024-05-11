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
            <h6 class="m-0 font-weight-bold text-primary">Modifier les données professeur</h6>
        </div>
        <div class="card-body">
            <?php

            if(isset($_POST['editp_btn']))
            {
                $ProfesseurID = $_POST['edit_id'];
                $query = "SELECT * FROM professeurs WHERE ProfesseurID ='$ProfesseurID' ";
                $query_run = mysqli_query($connection, $query);

                foreach($query_run as $row)
                {
                    ?>


                    <form action="code.php" method="post"  enctype="multipart/form-data">

                        <input type="hidden" name="edit_id" value="<?php echo $row['ProfesseurID'] ?>">
                        <div class="form-group">
                            <label> Nom professeur</label>
                            <input type="text" name="edit_professeurname" value="<?php echo $row['Professeur_name'] ?>" class="form-control" placeholder="Entrer nom professeur">
                        </div>
                        <div class="form-group">
                            <label> Prénom professeur</label>
                            <input type="text" name="edit_professeurprenom" value="<?php echo $row['Professeur_prenom'] ?>" class="form-control" placeholder="Entrer prénom professeur">
                        </div>
                        <div class="form-group">
                            <label> CIN </label>
                            <input type="text" name="edit_professeurcin" value="<?php echo $row['CIN'] ?>" class="form-control" placeholder="Entrer CIN professeur">
                        </div>
                        <div class="form-group">
    <label> Genre </label>
    <select name="edit_professeurgenre" class="form-control">
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
                            <input type="text" name="edit_professeurtele" value="<?php echo $row['Tele'] ?>" class="form-control" placeholder="Entrer téléphone professeur">
                        </div>
                        <div class="form-group">
                            <label> Adresse</label>
                            <input type="text" name="edit_professeuradresse" value="<?php echo $row['Adresse'] ?>" class="form-control" placeholder="Entrer Adresse professeur">
                        </div>
                        <div class="form-group">
                            <label> Date début du travail </label>
                            <input type="date" name="edit_professeurdate" value="<?php echo $row['Date_debut_travail'] ?>" class="form-control" placeholder="Entrer Date ">
                        </div>
                        <div class="form-group">
                            <label> Image actuelle</label>
                            <br>
                            <img src="upload/images_prof/<?php echo $row['Image']; ?>" alt="Image professeur" width="100">
                        </div>
                        <div class="form-group">
                            <label> Nouvelle image </label>
                            <input type="file" name="edit_professeurimage" class="form-control">
                        </div>
                        <div class="form-group">
                            <label> Password </label>
                            <input type="text" name="edit_professeurpassword" value="<?php echo $row['Password'] ?>" class="form-control" placeholder="Entrer mot de passe ">
                        </div>
                        
                        <a href="professeurs.php" class="btn btn-danger">Annuler</a>
                        <button type="submit" name="updatepbtn" class="btn btn-primary">Mettre à jour </button>
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
