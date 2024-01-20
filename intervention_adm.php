<?php
include('dbconfig.php');
include('security.php');
secAdmin();
include('includes/header.php');
include('includes/navbar.php');
?>


    <form role="form" method="post" action="codeinterv.php" >
    <div class="container-fluid">


    <div class="card shadow mb-4">
    <div class="card-header py-3">
    <?php

if(isset($_SESSION['success']) && $_SESSION['success'] !='')
{
    echo '<h2 class="bg-primary text-white"> '.$_SESSION['success'].' </h2>';
    unset($_SESSION['success']);
}

if(isset($_SESSION['status']) && $_SESSION['status'] !='')
{
    echo '<h2 class="bg-danger  text-white"> '.$_SESSION['status'].' </h2>';
    unset($_SESSION['status']);
}

?>


    </div>
</div>



    
    <!-- <div id="barcodeScanner">
        <span id='loading-status' style='font-size:x-large'>Loading Library...</span>
    </div> -->

    <!-- <div class="form-row"> -->
    <!-- <div class="form-group col-md-6">
      <label for="inputEmail4">Codebare</label>
      <input type="text" class="form-control" name="id" id="id"  placeholder=" Scan Barecode" autocomplete="off" onkeydown="return event.key != 'Enter';" >
    </div> -->
   
<!-- </div>  -->
  <div class="form-row">
  <div class="form-group col-md-4">
    <label for="inputEmail4">Emplacement</label>
    <select name="emplacement" class="form-control">
          <option value="" selected disabled>sélectionner d'un emplacement</option>
                        <?php 
                       $villeID = $_SESSION['villeID'];
                       $query = "SELECT * FROM `emplacement`WHERE VilleID = $villeID";
            
                       $query_run = mysqli_query($connection,$query);
                       if($query_run){
                       while($row = mysqli_fetch_assoc($query_run)){ 
                       ?>
                       
                       <option value="<?php echo $row['Emplacement'];?>"><?php echo $row['Emplacement'];?></option>
                       <?php
                    }} ?>
       
      </select>    
    </div>

    <div class="form-group col-md-4">
      <label for="inputEmail4">Equipement</label>
      <select name="equipement" class="form-control">
        <option value="" selected disabled >sélectionner d'un Equipement</option>
        <option value="ATB">ATB</option>
        <option value="BTP">BTP</option>
        <option value="ATB/BTP">ATB/BTP</option>
        <option value="PC">PC</option>
        <option value="ECRAN">ECRAN</option>
        <option value="CLAVIER">CLAVIER</option>
        <option value="KEYBOARD/DESKO">KEYBOARD/DESKO</option>
        <option value="MOUSE">MOUSE</option>
        <option value="BGR">BGR</option>
        <option value="OKI">OKI</option>
        <option value="IMPRIMANTE">IMPRIMANTE</option>
        <option value="HHT">HHT</option>
        <option value="WKS">WKS</option>
        <option value="DCP">DCP</option>
        <option value="WORKSTATION">WORKSTATION</option>
        <option value="MISCELLANEOUS">MISCELLANEOUS</option>
        <option value="NETWORK">NETWORK</option>
        <option value="SCREEN">SCREEN</option>
        <option value="SYSTEM">SYSTEM</option>
      </select>     
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Comptoir</label>
      <select name="comptoir" id="comptoir" class="form-control">
      <option value="" selected disabled>sélectionner d'un comptoir</option>
                        <?php 
                       $villeID = $_SESSION['villeID'];
                       $query = "SELECT * FROM `comptoir`WHERE VilleID = $villeID";
            
                       $query_run = mysqli_query($connection,$query);
                       if($query_run){
                       while($row = mysqli_fetch_assoc($query_run)){ 
                       ?>
                       
                       <option value="<?php echo $row['ComptoirID'];?>"><?php echo $row['Comptoirs'];?></option>
                       <?php
                    }} ?>
                        
                    </select></div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Debut Intervention</label>
      <input type="time" class="form-control" id="debut" name="debut" placeholder="debut" autocomplete="off" onkeydown="return event.key != 'Enter';">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Fin Intervention</label>
      <input type="time" class="form-control"  id="fin" name="fin" placeholder="Fin Intervention" autocomplete="off" onkeydown="return event.key != 'Enter';">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Compagnie</label>
      <select name="compagnie" id="compagnie" class="form-control">
      <option value="" selected disabled>Sélectionner d'une Compagnie </option>
                        <?php 
                       $villeID = $_SESSION['villeID'];
                       $query = "SELECT * FROM `compagnie`WHERE VilleID = $villeID";
                     
                       $query_run = mysqli_query($connection,$query);
                       if($query_run){
                       while($row = mysqli_fetch_assoc($query_run)){ 
                       ?>
                       
                       <option value="<?php echo $row['Compagnie'];?>"><?php echo $row['Compagnie'];?></option>
                       <?php
                    }} ?>
                        
                    </select>
    </div>
    <div class="form-group col-md-3">
      <label for="inputState">Nature Intervention</label>
      <select name="nature" class="form-control">
        <option selected value="Curatif">Curatif</option>
        <option value="Préventif">Préventif</option>
        <option value="Modification">Modification</option>
        <option value="Traveaux Neufs">Traveaux Neufs</option>
      </select>
    </div>
    <div class="form-group col-md-3">
    <label for="inputState">Signalé Par</label>
      <select name="signale" class="form-control">
        <option selected value="CCO">CCO</option>
        <option value="LOCAL">LOCAL</option>
        <option value="RAM">RAM</option>
        <option value="SWP">SWP</option>
        <option value="OP">OP</option>
      </select>
    </div>
  </div>
  <div class="form-group">
      <label for="inputCity">Probleme Détecté</label>
     
      <select name="probleme" class="form-control">
     <option value="" selected disabled>Sélectionner un Probleme </option>
                        <?php 
                       $villeID = $_SESSION['villeID'];
                       $query = "SELECT * FROM `probleme`WHERE VilleID = $villeID";
                     
                       $query_run = mysqli_query($connection,$query);
                       if($query_run){
                       while($row = mysqli_fetch_assoc($query_run)){ 
                       ?>
                       
                       <option value="<?php echo $row['Probleme'];?>"><?php echo $row['Probleme'];?></option>
                       <?php
                    }} ?>
      </select>
    
    
      <label for="inputZip">Travaux réalisés</label>
      <select name="travaux" class="form-control">
         <option value="" selected disabled>Sélectionner un Traveau </option>
                        <?php 
                       $villeID = $_SESSION['villeID'];
                       $query = "SELECT * FROM `traveau`WHERE VilleID = $villeID";
                     
                       $query_run = mysqli_query($connection,$query);
                       if($query_run){
                       while($row = mysqli_fetch_assoc($query_run)){ 
                       ?>
                       
                       <option value="<?php echo $row['Traveau'];?>"><?php echo $row['Traveau'];?></option>
                       <?php
                    }} ?>
    </select>
  </div>
  <div class="form-row">
  
  <div class="form-group col-md-3">
    <label for="inputState">Observation</label>
       <input type="text" name="observation" class="form-control" placeholder="Entrer un Observation">
    </div>
    <div class="form-group col-md-3">
      <label for="inputState">Type Intervention</label>
      <select name="typeintervention" class="form-control">
        <option selected value="CUTE">CUTE</option>
        <option value="BRS">BRS</option>
        <option value="EGATE">EGATE</option>
      </select>
    </div>
  </div>
 
  <button type="submit" name="registerbtn" class="btn btn-primary">Enregitrer</button>
</div>
</form>


    
  
<?php 
include('includes/scripts.php');
include('includes/footer.php');
?>