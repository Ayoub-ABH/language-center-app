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
        <h6 class="m-0 font-weight-bold text-primary">Modifier les données du visiteur</h6>
</div>
<div class="card-body">
<?php


if(isset($_POST['editv_btn']))
{
    $VisiteurID = $_POST['edit_id'];
    $query = "SELECT * FROM visiteurs WHERE VisiteurID='$VisiteurID' ";
    $query_run = mysqli_query($connection, $query);

    foreach($query_run as $row)
    {
        ?>



            <form action="code.php" method="post">
                <input type="hidden" name="edit_id" value="<?php echo $row['VisiteurID'] ?>">
            <div class="form-group">
                <label> Nom du visiteur</label>
                <input type="text" name="edit_visiteurname" value="<?php echo $row['Visiteur_name'] ?>" class="form-control" placeholder="Entrer nom du visiteur">
            </div>
            <div class="form-group">
                <label> Prenom du visiteur</label>
                <input type="text" name="edit_visiteurprenom" value="<?php echo $row['Visiteur_prenom'] ?>" class="form-control" placeholder="Entrer prenom du visiteur">
            </div>
            <div class="form-group">
                <label> CIN </label>
                <input type="text" name="edit_visiteurcin" value="<?php echo $row['CIN'] ?>" class="form-control" placeholder="Entrer cin du visiteur">
            </div>
            <div class="form-group">
                <label> Email</label>
                <input type="email" name="edit_email" value="<?php echo $row['Email'] ?>"  class="form-control" placeholder="Entrer Email">
            </div>
            <div class="form-group">
                <label> Tele du visiteur</label>
                <input type="text" name="edit_visiteurtele" value="<?php echo $row['Tele'] ?>" class="form-control" placeholder="Entrer tele du visiteur">
            </div>
            <div class="form-group">
                <label> Adresse du visiteur</label>
                <input type="text" name="edit_visiteuradresse" value="<?php echo $row['Adresse'] ?>" class="form-control" placeholder="Entrer Adresse du visiteur">
            </div>
            <div class="form-group">
                <label> Date du visite </label>
                <input type="date" name="edit_visiteurdate" value="<?php echo $row['Date_visite'] ?>" class="form-control" placeholder="Entrer Date_visite du visiteur">
            </div>



         <div class="form-group">
    <label  for="niveau">Niveau du visiteur</label>

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
                <label> Observation </label>
                <input type="text" name="edit_visiteurobs" value="<?php echo $row['Observation'] ?>" class="form-control" placeholder="Entrer Observation">
            </div>
            
            <a href="register.php" class="btn btn-danger">Cancel</a>
            <button type="submit" name="updatevbtn" class="btn btn-primary">Mettre à jour </button>
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