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
        <h6 class="m-0 font-weight-bold text-primary">Modifier le tableau de données</h6>
</div>
<div class="card-body">
<?php



if(isset($_POST['edit_btn']))
{
    $ID = $_POST['edit_id'];
    $query = "SELECT * FROM materiel WHERE ID='$ID' ";
    $query_run = mysqli_query($connection, $query);

    foreach($query_run as $row)
    {
        ?>
            <form action="codetable.php" method="post">
                <input type="hidden" name="edit_id" value="<?php echo $row['ID'] ?>">
            <div class="form-group">
                <label> Codebare</label>
                <input type="text" name="edit_codebare" value="<?php echo $row['Codebare'] ?>" class="form-control" placeholder="Entrer Codebare">
            </div>
            <div class="form-group">
                <label> Emplacement</label>
                <input type="text" name="edit_emplacement" value="<?php echo $row['Emplacement'] ?>"  class="form-control" placeholder="Entrer Emplacement">
            </div>
            <div class="form-group">
                <label> Equipement</label>
                <input type="text" name="edit_equipement" value="<?php echo $row['Equipement'] ?>" class="form-control" placeholder="Entrer Equipement">
            </div>
            <div class="form-group">
                <label> Comptoir</label>
                <input type="text" name="edit_comptoir" value="<?php echo $row['Comptoir'] ?>" class="form-control" placeholder="Entrer Comptoir">
            </div>
            
            <a href="tables.php" class="btn btn-danger">Cancel</a>
            <button type="submit" name="updatebtn" class="btn btn-primary">Mettre à jour</button>
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