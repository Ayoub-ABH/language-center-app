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
        <h6 class="m-0 font-weight-bold text-primary">Modifier les données du groupe</h6>
</div>
<div class="card-body">
<?php


if(isset($_POST['editg_btn']))
{
    $GroupeID = $_POST['edit_id'];
    $query = "SELECT * FROM groupes WHERE GroupeID='$GroupeID' ";
    $query_run = mysqli_query($connection, $query);

    foreach($query_run as $row)
    {
        ?>



            <form action="code.php" method="post">
                <input type="hidden" name="edit_id" value="<?php echo $row['GroupeID'] ?>">
            <div class="form-group">
                <label> Nom du groupe</label>
                <input type="text" name="edit_groupename" value="<?php echo $row['Groupe_name'] ?>" class="form-control" placeholder="Entrer nom du groupe">
            </div>
            <div class="form-group">
                <label for="niveau"> Niveau du groupe</label>
    <select name="edit_groupeniveau" class="form-control">
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
                <label> Date du creation </label>
                <input type="date" name="edit_groupedate" value="<?php echo $row['Date_creation'] ?>" class="form-control" placeholder="Entrer Date_creation">
            </div>

            
            
            <a href="register.php" class="btn btn-danger">Cancel</a>
            <button type="submit" name="updategbtn" class="btn btn-primary">Mettre à jour </button>
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