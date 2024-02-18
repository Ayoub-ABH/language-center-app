<?php 
include('dbconfig.php');
include('security.php');
secAdmin();
include('includes/header.php');
include('includes/navbar.php');

?>
  
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">Ajouter un visiteur</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
          <span aria-hidden="true">&times;</span>
        </button>
            
       
      </div>

      
      <form action="code.php" method="POST">

      <div class="modal-body">
        
            <div class="form-group">
                <label>Nom du visiteur </label>
                <input type="text" name="nom" class="form-control" placeholder="Entrer Nom du visiteur">
            </div>
            <div class="form-group">
                <label>Prénom du visiteur </label>
                <input type="text" name="prenom" class="form-control" placeholder="Entrer Prénom du visiteur">
            </div>
            <div class="form-group">
                <label>CIN</label>
                <input type="text" name="cin" class="form-control" placeholder="Entrer CIN">
            </div>
            <div class="form-group">
                <label> Email</label>
                <input type="email" name="email" class="form-control" placeholder="Entrer Email">
            </div> 
             <div class="form-group">
                <label>Numéro de telephone</label>
                <input type="text" name="telephone" class="form-control" placeholder="Entrer Numéro de téléphone">
            </div>
            <div class="form-group">
                <label> Adresse</label>
                <input type="text" name="adresse" class="form-control" placeholder="Entrer Adresse">
            </div>
            <div class="form-group">
                <label> Date de visite</label>
                <input type="date" name="date_visite" class="form-control" placeholder="Entrer Date de visite">
            </div>


            <div class="form-group">
    <label for="niveau">Niveau</label>
    <!-- Utiliser un seul champ (select) pour le niveau -->
    <select name="niveau" class="form-control">
        <option value="" selected disabled>Sélectionner un niveau</option>
        <?php 
        $query = "SELECT * FROM `niveau`";
        $query_run = mysqli_query($connection, $query);
        if ($query_run) {
            while ($row = mysqli_fetch_assoc($query_run)) { 
        ?>
        <option value="<?php echo $row['Niveau_name']; ?>"><?php echo $row['Niveau_name']; ?></option>
        <?php
            }
        }
        ?>
    </select>
</div>
            <div class="form-group">
                <label> Observation</label>
                <textarea type="text" name="observation" class="form-control" placeholder="Entrer Observation"></textarea>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="submit" name="visiteurbtn" class="btn btn-primary">Enregistrer</button>
      </div>
         </form>
    </div>
  </div>
</div>

<div class="container-fluid">


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Profils visiteurs
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addadminprofile">        
        Ajouter un visiteur
        </button>
        </h6>
     </div>
 <div class="card-body">

<?php

if(isset($_SESSION['success']) && $_SESSION['success'] !='')
{
    echo '<h6 class="alert alert-success" role="alert"> '.$_SESSION['success'].' </h2>
    <meta http-equiv="refresh" content="5; url = visiteurs.php" />
    ';
    unset($_SESSION['success']);
}

if(isset($_SESSION['status']) && $_SESSION['status'] !='')
{
    echo '<h6 class="alert alert-danger" role="alert"> '.$_SESSION['status'].' </h2>';
    unset($_SESSION['status']);
}

?>
 


    <div class="table-responsive">


<?php 
$query = "SELECT * FROM visiteurs ";
$query_run = mysqli_query($connection,$query);

?>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>CIN</th>
                <th>Email</th>
                <th>Tele</th>
                <th>Adresse</th>
                <th>Date de visite</th>
                <th>Niveau</th>
                <th>Observation</th>
                <th>Éditer</th>
                <th>supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(mysqli_num_rows($query_run) > 0) {
                while($row = mysqli_fetch_assoc($query_run)) {
            ?>
            <tr>
                <td><?php echo $row['VisiteurID']; ?></td>
                <td><?php echo $row['Visiteur_name']; ?></td>
                <td><?php echo $row['Visiteur_prenom']; ?></td>
                <td><?php echo $row['CIN']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td><?php echo $row['Tele']; ?></td>
                <td><?php echo $row['Adresse']; ?></td>
                <td><?php echo $row['Date_visite']; ?></td>
                <td><?php echo $row['Niveau']; ?></td>
                <td><?php echo $row['Observation']; ?></td>
                <td>
                    <form action="visiteur_edit.php" method="post">
                        <input type="hidden" name="edit_id" value="<?php echo $row['VisiteurID']; ?>">
                        <button type="submit" name="editv_btn"  class="btn btn-success">Éditer</button>
                    </form>
                </td>
                <td>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal<?php echo $row['VisiteurID']; ?>">Supprimer</button>
                    <!-- Ajouter une boîte de dialogue de confirmation de suppression pour chaque visiteur -->
                    <div class="modal fade" id="confirmDeleteModal<?php echo $row['VisiteurID']; ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Voulez-vous vraiment supprimer cet utilisateur?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <form action="code.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['VisiteurID']; ?>">
                                        <button type="submit" name="deletev_btn" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
                }
            } else {
                echo "no record found";
            }
            ?>
        </tbody>
    </table>
</div>

            <!-- End of Main Content -->
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>