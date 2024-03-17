<?php 
include('dbconfig.php');
include('security.php');
secAdmin();
include('includes/header.php');
include('includes/navbar.php');
?>
<<<<<<< HEAD
=======
  
<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">Ajouter étudiant</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
          <span aria-hidden="true">&times;</span>
        </button>        
       
      </div>

      
      <form action="code.php" method="POST"  enctype="multipart/form-data">

      <div class="modal-body">
        
            <div class="form-group">
                <label>Nom d'étudiant </label>
                <input type="text" name="nom" class="form-control" placeholder="Entrer Nom d'étudiant">
            </div>
            <div class="form-group">
                <label>Prénom d'étudiant </label>
                <input type="text" name="prenom" class="form-control" placeholder="Entrer Prénom d'étudiant">
            </div>
            <div class="form-group">
                <label>CIN</label>
                <input type="text" name="cin" class="form-control" placeholder="Entrer CIN">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" class="form-control" placeholder="Entrer Password">
            </div>

            <div class="form-group">
                <label> Email</label>
                <input type="email" name="email" class="form-control" placeholder="Entrer Email">
            </div> 

            
             <div class="form-group">
                <label>Numéro de téléphone</label>
                <input type="text" name="telephone" class="form-control" placeholder="Entrer Numéro de téléphone">
            </div>
            <div class="form-group">
                <label> Adresse</label>
                <input type="text" name="adresse" class="form-control" placeholder="Entrer Adresse">
            </div>
            <div class="form-group">
                <label> Date d'inscription</label>
                <input type="date" name="date_inscription" class="form-control" placeholder="Entrer Date d'inscription">
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
                <label for="niveau">Groupe</label>
                <!-- Utiliser un seul champ (select) pour le niveau -->
                <select name="groupe" class="form-control">
                    <option value="" selected disabled>Sélectionner un groupe</option>
                    <?php 
                    $query = "SELECT * FROM `groupes`";
                    $query_run = mysqli_query($connection, $query);
                    if ($query_run) {
                        while ($row = mysqli_fetch_assoc($query_run)) { 
                    ?>
                    <option value="<?php echo $row['Groupe_name']; ?>"><?php echo $row['Groupe_name']; ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label> Image </label>
                <input type="file" name="etudiant_image" id="etudiant_image" class="form-control" placeholder="Entrer Groupe">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="submit" name="etudiantbtn" class="btn btn-primary">Enregistrer</button>
      </div>
    </form>
    </div>
  </div>
</div>
>>>>>>> a8a4c66109726189c9ae83bb2012ccb0140e87db

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Profils etudiant
                <button type="button" class="btn btn-primary" onclick="window.location.href='Ajouter_etudiant.php'">Ajouter</button>
            </h6>
        </div>
        <div class="card-body">
            <?php
            if(isset($_SESSION['success']) && $_SESSION['success'] != '') {
                echo '<h6 class="alert alert-success" role="alert"> '.$_SESSION['success'].' </h6>
                <meta http-equiv="refresh" content="5; url = etudiants.php" />';
                unset($_SESSION['success']);
            }

            if(isset($_SESSION['status']) && $_SESSION['status'] != '') {
                echo '<h6 class="alert alert-danger" role="alert"> '.$_SESSION['status'].' </h6>';
                unset($_SESSION['status']);
            }
            ?>
        </div>

<<<<<<< HEAD
        <div class="card-body">
            <div class="table-responsive">
            <?php 
=======
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Profils étudiants
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addadminprofile">        
        Ajouter un étudiant
        </button>
        </h6>
    </div>
<div class="card-body">

<?php

if(isset($_SESSION['success']) && $_SESSION['success'] !='')
{
   echo '<h6 class="alert alert-success" role="alert"> '.$_SESSION['success'].' </h2>
    <meta http-equiv="refresh" content="5; url = etudiants.php" />
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
>>>>>>> a8a4c66109726189c9ae83bb2012ccb0140e87db
$query = "SELECT e.EtudiantID, e.Etudiant_name, e.Etudiant_prenom, e.CIN , e.Password, e.Email, e.Tele, e.Adresse, e.Date_inscription, n.Niveau_name, g.Groupe_name, e.Image
FROM etudiants e
JOIN niveau n ON e.NiveauID = n.NiveauID
JOIN groupes g ON e.GroupeID = g.GroupeID";

$query_run = mysqli_query($connection, $query);
?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <th<tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>CIN</th>
                <th>Password</th>
                <th>Email</th>
                <th>Tele</th>
                <th>Adresse</th>
                <th>Date d'inscription</th>
                <th>Niveau</th>
                <th>Groupe</th>
                <th>Image</th>
                <th>Éditer</th>
                <th>Supprimer</th>
            </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(mysqli_num_rows($query_run) > 0) {
                            while($row = mysqli_fetch_assoc($query_run)) {
                        ?>
                         <tr>
                        <td><?php echo $row['EtudiantID']; ?></td>
                        <td><?php echo $row['Etudiant_name']; ?></td>
                        <td><?php echo $row['Etudiant_prenom']; ?></td>
                        <td><?php echo $row['CIN']; ?></td>
                        <td><?php echo $row['Password']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
                        <td><?php echo $row['Tele']; ?></td>
                        <td><?php echo $row['Adresse']; ?></td>
                        <td><?php echo $row['Date_inscription']; ?></td>
                        <td><?php echo $row['Niveau_name']; ?></td>
                        <td><?php echo $row['Groupe_name']; ?></td>
                        <td><?php echo '<img src="upload/' . $row['Image'] . '" width="100px;" height="100px;" alt="Image">'; ?></td>
                        <td>
                            <form action="etudiant_edit.php" method="post">
                                <input type="hidden" name="edit_id" value="<?php echo $row['EtudiantID']; ?>">
                                <button type="submit" name="edite_btn" class="btn btn-success">Éditer</button>
                            </form>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal<?php echo $row['EtudiantID']; ?>">Supprimer</button>
                            <!-- Ajouter une boîte de dialogue de confirmation de suppression pour chaque visiteur -->
                            <div class="modal fade" id="confirmDeleteModal<?php echo $row['EtudiantID']; ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Voulez-vous vraiment supprimer cet étudiant?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <form action="code.php" method="post">
                                                <input type="hidden" name="deletet_id" value="<?php echo $row['EtudiantID']; ?>">
                                                <button type="submit" name="deletee_btn" class="btn btn-danger">Supprimer</button>
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
                            echo "<tr><td colspan='12'>Aucun enregistrement trouvé</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
