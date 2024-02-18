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
      <h6 class="m-0 font-weight-bold text-primary">Modifier les données du professeur</h6>
    </div>
    <div class="card-body">
      <?php
      if(isset($_POST['editp_btn'])) {
          $ProfesseurID = $_POST['edit_id'];
          $query = "SELECT * FROM professeurs WHERE ProfesseurID='$ProfesseurID' ";
          $query_run = mysqli_query($connection, $query);

          foreach($query_run as $row) {
      ?>

      <form action="code.php" method="post"  enctype="multipart/form-data">

        <input type="hidden" name="edit_id" value="<?php echo $row['ProfesseurID'] ?>">
        <div class="form-group">
          <label> Nom de professeur</label>
          <input type="text" name="edit_professeurname" value="<?php echo $row['Professeur_name'] ?>" class="form-control" placeholder="Entrer nom de professeur">
        </div>
        <div class="form-group">
          <label> Prenom de professeur</label>
          <input type="text" name="edit_professeurprenom" value="<?php echo $row['Professeur_prenom'] ?>" class="form-control" placeholder="Entrer prenom de professeur">
        </div>
        <div class="form-group">
          <label> CIN </label>
          <input type="text" name="edit_professeurcin" value="<?php echo $row['CIN'] ?>" class="form-control" placeholder="Entrer cin de professeur">
        </div>
        <div class="form-group">
          <label> Email</label>
          <input type="email" name="edit_email" value="<?php echo $row['Email'] ?>"  class="form-control" placeholder="Entrer Email">
        </div>
        <div class="form-group">
          <label> Tele de professeur</label>
          <input type="text" name="edit_professeurtele" value="<?php echo $row['Tele'] ?>" class="form-control" placeholder="Entrer tele de professeur">
        </div>
        <div class="form-group">
          <label> Adresse de professeur</label>
          <input type="text" name="edit_professeuradresse" value="<?php echo $row['Adresse'] ?>" class="form-control" placeholder="Entrer Adresse de professeur">
        </div>
        <a href="professeurs.php" class="btn btn-danger">Cancel</a>
        <button type="submit" name="updatepbtn" class="btn btn-primary">Mettre à jour </button>
      </form>

      <?php
          }
      }
      ?>
    </div>
  </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
