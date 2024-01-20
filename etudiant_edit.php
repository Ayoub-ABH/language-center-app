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
        <h6 class="m-0 font-weight-bold text-primary">Modifier les données du etudiant</h6>
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
                <label> Nom d'etudiant</label>
                <input type="text" name="edit_etudiantname" value="<?php echo $row['Etudiant_name'] ?>" class="form-control" placeholder="Entrer nom d'etudiant">
            </div>
            <div class="form-group">
                <label> Prenom d'etudiant</label>
                <input type="text" name="edit_etudiantprenom" value="<?php echo $row['Etudiant_prenom'] ?>" class="form-control" placeholder="Entrer prenom d'etudiant">
            </div>
            <div class="form-group">
                <label> CIN </label>
                <input type="text" name="edit_etudiantcin" value="<?php echo $row['CIN'] ?>" class="form-control" placeholder="Entrer cin d'etudiant">
            </div>
            <div class="form-group">
                <label> Email</label>
                <input type="email" name="edit_email" value="<?php echo $row['Email'] ?>"  class="form-control" placeholder="Entrer Email">
            </div>
            <div class="form-group">
                <label> Tele d'etudiant</label>
                <input type="text" name="edit_etudianttele" value="<?php echo $row['Tele'] ?>" class="form-control" placeholder="Entrer tele d'etudiant">
            </div>
            <div class="form-group">
                <label> Adresse d'etudiant</label>
                <input type="text" name="edit_etudiantadresse" value="<?php echo $row['Adresse'] ?>" class="form-control" placeholder="Entrer Adresse d'etudiant">
            </div>
            <div class="form-group">
                <label> Date d'inscription </label>
                <input type="date" name="edit_etudiantdate" value="<?php echo $row['Date_inscription'] ?>" class="form-control" placeholder="Entrer Date d'inscription">
            </div>
            
         <div class="form-group">
    <label  for="niveau">Niveau du etudiant</label>

    <select name="edit_visiteurniveau" class="form-control">
        <option value="" selected disabled>Sélectionner un niveau</option>
        <?php 
            $query = "SELECT * FROM `niveau`";
            $query_run = mysqli_query($connection, $query);
            if ($query_run) {
                while ($niveauRow = mysqli_fetch_assoc($query_run)) { 
        ?>
        <option value="<?php echo $niveauRow['Niveau_name']; ?>"><?php echo $niveauRow['Niveau_name']; ?></option>
        <?php
                }
            }
        ?>
    </select>
</div>

            <div class="form-group">
                <label> Groupe </label>
                <input type="text" name="edit_etudiantgroupe" value="<?php echo $row['Groupe'] ?>" class="form-control" placeholder="choisir groupe">
            </div>
            <div class="form-group">
                <label> Image d'etudiant</label>
                <input type="file" name="edit_etudiantimage" value="<?php echo $row['Image'] ?>" class="form-control" placeholder="Entrer image d'etudiant">
            </div>
            <a href="etudiants.php" class="btn btn-danger">Cancel</a>
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