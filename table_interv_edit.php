<?php 
include('dbconfig.php');
include('security.php');
secUser();

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SITA - Dashboard</title>
 
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
    <!-- Custom fonts for this template-->
    <link rel="shortcut icon" type="image/png" href="SITA-logo.png" >
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" /> 

        
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        
        
        
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <!-- <i class="fas fa-laugh-wink"></i> -->
        <i class="fas fa-plane-departure"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SITA Admin </div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="formulaire.php"  data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
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
<li class="nav-item">
    <a class="nav-link collapsed" href=""  data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-download  text-red-50"></i>
        <span>Générer TBF </span>
    </a>
   
</li>

<!-- Nav Item - Utilities Collapse Menu -->


<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fab fa-wpforms"></i>
        <span>Formulaire</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Formulaire : </h6>
            <a class="collapse-item" href="formulaire.php">Register Formulaire</a>
            <a class="collapse-item" href="table_interv.php">Table de Formulaire</a>
              <a class="collapse-item" href="probleme.php">Ajouter un Probleme</a>
                <a class="collapse-item" href="traveau.php">Ajouter un traveau</a>
        </div>
    </div> 
    
</li>


<li class="nav-item">
    <a class="nav-link collapsed" href=""  data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-user-plus"></i>
        <span>Ajouter un utilisateur</span>
    </a>
    
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href=""  data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-building"></i>
        <span>Ajouter une Compagnie</span>
    </a>
    
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href=""  data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-chair"></i>
        <span>Ajouter un Comptoire</span>
    </a>
    
</li>

<!-- Divider -->

<!-- Nav Item - Utilities Collapse Menu -->


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Addons
</div>


<li class="nav-item">
    <a class="nav-link" href=""  data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Charts</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href=""  data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span></a>
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
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
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

    <div class="container-fluid">

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">EDIT table intervention</h6>
</div>
<div class="card-body">
<?php



if(isset($_POST['edit_btn']))
{
    $ID = $_POST['edit_id'];
    $query = "SELECT intervention.*, comptoir.Comptoirs as ComptoirName from intervention, comptoir WHERE intervention.ComptoirID = comptoir.ComptoirID AND ID='$ID' ";
    $query_run = mysqli_query($connection, $query);

    foreach($query_run as $row)
    {
        ?>
            <form action="code_interv.php" method="post">
                <input type="hidden" name="edit_id" value="<?php echo $row['ID'] ?>">
            <div class="form-group">
                <label> Emplacement</label>
                <input type="text" name="edit_emplacement" value="<?php echo $row['Emplacement'] ?>" class="form-control" placeholder="Entrer Emplacement">
            </div>
            <div class="form-group">
                <label> Equipement</label>
                <input type="text" name="edit_equipement" value="<?php echo $row['Equipement'] ?>"  class="form-control" placeholder="Entrer Equipement">
            </div>
            <div class="form-group">
                <label> Comptoir</label>
                <input type="text" name="edit_comptoir" value="<?php echo $row['ComptoirName'] ?>" class="form-control" placeholder="Entrer Comptoir">
            </div>
            <div class="form-group">
                <label> Debut interventio</label>
                <input type="text" name="edit_debut" value="<?php echo $row['Debut'] ?>" class="form-control" placeholder="Entrer Debut">
            </div>
            <div class="form-group">
                <label> Fin intervention</label>
                <input type="text" name="edit_fin" value="<?php echo $row['Fin'] ?>" class="form-control" placeholder="Entrer Fin">
            </div>
            <div class="form-group">
                <label> Compagnie</label>
                <input type="text" name="edit_compagnie" value="<?php echo $row['Compagnie'] ?>" class="form-control" placeholder="Entrer Compagnie">
            </div>
            <div class="form-group">
                <label> Nature intervention</label>
                <input type="text" name="edit_nature" value="<?php echo $row['Nature'] ?>" class="form-control" placeholder="Entrer Nature">
            </div>
            <div class="form-group">
                <label> Signale Par</label>
                <input type="text" name="edit_signale" value="<?php echo $row['Signale'] ?>" class="form-control" placeholder="Signale Par">
            </div>
            <div class="form-group">
                <label> Problème Détecté</label>
                <input type="text" name="edit_probleme" value="<?php echo $row['Probleme'] ?>" class="form-control" placeholder="Entrer le Problème">
            </div>
            <div class="form-group">
                <label> Travaux réalisés</label>
                <input type="text" name="edit_travaux" value="<?php echo $row['Travaux'] ?>" class="form-control" placeholder="Entrer le Travaux">
            </div>
            <div class="form-group">
                <label> Observation</label>
                <input type="text" name="edit_observation" value="<?php echo $row['Observation'] ?>" class="form-control" placeholder="Entrer Observation">
            </div>
            <a href="table_interv.php" class="btn btn-danger">CANCEL</a>
            <button type="submit" name="updatebtn" class="btn btn-primary">Update </button>
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