<?php 
include('dbconfig.php');
include('security.php');
secSuper();
include('supAdminVille.php');
include('includes/header.php');


?>


<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="superadmin.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <!-- <i class="fas fa-laugh-wink"></i> -->
        <i class="fas fa-plane-departure"></i>
    </div>
    <div class="sidebar-brand-text mx-3">BILKER </div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="superadmin.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>
Tableau de bord</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->



<!-- <li class="nav-item">
    <a class="nav-link collapsed" href="list_comptoires_super.php"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-download  text-red-50"></i>
        <span>Generate Report </span>
    </a>
   
</li> -->

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="register_super.php">
    <i class="fas fa-user-plus"></i>
        <span>ajouter un administrateur</span>
    </a>
    
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="visiteurs_super.php">
        <i class="fas fa-building"></i>
        <span>Visiteurs</span>
    </a>
    
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="professeurs_super.php">
    <i class="fas fa-chair"></i>
        <span>Professeurs</span>
    </a>
    
</li>


<li class="nav-item">
    <a class="nav-link collapsed" href="liste_etudiants_super.php">
    <i class="fas fa-chair"></i>
        <span>Etudiants</span>
    </a>
    
</li>





<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Addons
</div>

<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="charts.php">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Graphique</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="tables.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Équipement</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>



</ul>
<!-- End of Sidebar -->


  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
        <form
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Rechercher...."
                    aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search"
                                aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

           
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
              <?php echo $_SESSION['username']; ?>

                    </span>
                    <img class="img-profile rounded-circle"
                        src="img/undraw_profile.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="register_super.php">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                      
                    Editer le profil
                    </a>
                    <a class="dropdown-item" href="">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        
                    Paramètres
                    </a>
                    <!-- <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Activity Log
                    </a> -->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Se déconnecter
                    </a>
                </div>
            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->
 <!-- Scroll to Top Button-->
 <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Prêt à partir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Sélectionnez "Se déconnecter" ci-dessous si vous êtes prêt à mettre fin à votre session en cours.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    <form action="logout.php" method="POST"> 
                    <button type="submit" name="logout_btn" class="btn btn-primary">Se déconnecter</button>
                    </form>

                </div>
            </div>
        </div>
    </div> 




<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter des données d'administration</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="close">
          <span aria-hidden="true">&times;</span>
        </button>
            
       
      </div>

      <form action="code_super.php" method="POST">

      <div class="modal-body">
        
            <div class="form-group">
                <label> Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control" placeholder="Entrer Nom d'utilisateur">
            </div>
            <div class="form-group">
                <label> Email</label>
                <input type="email" name="email" class="form-control" placeholder="Entrer Email">
            </div>
            <div class="form-group">
                <label> le mot de passe</label>
                <input type="password" name="password" class="form-control" placeholder="Entrer le mot de passe">
            </div>
            <div class="form-group">
                <label> Confirmer le mot de passe</label>
                <input type="password" name="confirmepassword" class="form-control" placeholder="confirmer le mot de passe">
            </div>
            <select class="form-control"  name="ville">
                    <option selected disabled>Selectionner une ville</option>
                    <option value="1">Casablanca</option>
                    <option value="2">Marrakech Menara</option>
                    <option value="3">Fez</option>
                    <option value="4">Rabat Sale</option>
                    <option value="5">Oujda</option>
                    <option value="6">Agadir Al Massira</option>
                    <option value="7">Tanger Boukhalef</option>
                    <option value="8">Nador</option>
                    <option value="9">Al Hoceima</option>
                    <option value="10">Dakhla</option>
                    <option value="11">Ouarzazate</option>
                    <option value="12">Tetouan</option>
                    <option value="13">Zagora</option>
                    <option value="14">Laayoune</option>
                    <option value="15">Beni Mellal</option>
                    <option value="16">Errachidia</option>
                    <option value="17">Goulimime</option>
                    <option value="18">Tan Tan</option>
                    <option value="19">Essaouira Mogador</option>
            </select>
</br>
            <select name="usertype" class="form-control">
                   <option value="admin">administrateur</option>
                
               </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fermer</button>
        <button type="submit" name="registerbtn" class="btn btn-primary">enregistrer</button>
      </div>
         </form>
    </div>
  </div>
</div>

<div class="container-fluid">


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">profil de super administrateur
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addadminprofile">        
        ajouter un administrateur
        </button>
        </h6>
    </div>
<div class="card-body">

<?php

if(isset($_SESSION['success']) && $_SESSION['success'] !='')
{
    echo '<h2 class="bg-primary text-white"> '.$_SESSION['success'].' </h2>
    <meta http-equiv="refresh" content="5; url = register_super.php" />
    ';
    unset($_SESSION['success']);
}

if(isset($_SESSION['status']) && $_SESSION['status'] !='')
{
    echo '<h2 class="bg-danger  text-white"> '.$_SESSION['status'].' </h2>';
    unset($_SESSION['status']);
}

?>
    <div class="table-responsive">
<?php 


$query = "SELECT * FROM users WHERE Usertype = 'admin' or Usertype = 'super' ";
$query_run = mysqli_query($connection,$query);

?>



        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Administrateur</th>
                    <th>Email</th>
                    <th>Mot de passe</th>
                    <th>Rôle</th>
                    <th>Éditer</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(mysqli_num_rows($query_run) > 0)
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                        ?>
                <tr>
                  <td><?php echo $row['UserID']; ?></td>
                  <td><?php echo $row['Username']; ?></td>
                  <td><?php echo $row['Email']; ?></td>
                  <td><?php echo $row['Password']; ?></td>
                  <td><?php echo $row['Usertype']; ?></td>
                  <td>
                      <form action="register_super_edit.php" method="post">
                          <input type="hidden" name="edit_id" value="<?php echo $row['UserID']; ?>">
                      <button type="submit" name="edit_btn"  class="btn btn-success">Éditer</button>
                      </form>
                  </td>
                  <td>
                  <form action="code_super.php" method="post">
                          <input type="hidden" name="delete_id" value="<?php echo $row['UserID']; ?>">
                      <button type="submit" name="delete_btn"  class="btn btn-danger">Supprimer</button>
                      </form>
                  </td>
                </tr>
                <?php
                }
            }
                 else{
                        echo "no record found";
                         }
                    ?>
            </tbody>
        </table>
       </div>
     </div>
   </div>
</div>

</div>
            <!-- End of Main Content -->
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>