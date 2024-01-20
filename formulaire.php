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

    <title>BILKER</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
        <!-- Custom styles for this page -->
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dynamsoft-javascript-barcode@8.2.5/dist/dbr.js"></script>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
  
    <div class="sidebar-brand-text mx-3">BILKER</div>
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
            <a class="collapse-item" href="etudiants.php">Profil</a>
        </div>
    </div> 
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
    <form role="form" method="post" action="codeinterv.php" >
    <div class="container-fluid">


    <div class="card shadow mb-4">
    <div class="card-header py-3">
    <?php

if(isset($_SESSION['success']) && $_SESSION['success'] !='')
{
    echo '<h2 class="bg-primary text-white"> '.$_SESSION['success'].' </h2>
    <meta http-equiv="refresh" content="5; url = formulaire.php" />
    ';
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


  <div class="form-row">
  <div class="form-group col-md-4">
    <label for="inputEmail4">Nom etudiant</label>
                        <input type="text" name="etudiant_nom" class="form-control" value="<?php echo $row['Etudiant_name']; ?>" >
                 
    </div>
  <div class="form-group col-md-4">
    <label for="inputEmail4">Prenom etudiant</label>
                        <input type="text" name="etudiant_nom" class="form-control" value="<?php echo $row['Etudiant_name']; ?>" >
                 
    </div>
  <div class="form-group col-md-4">
    <label for="inputEmail4">CIN</label>
                       <input type="text" name="cin" class="form-control" value="<?php echo $row['CIN']; ?>" >
                 
    </div>
   
    <div class="form-group col-md-4">

                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $row['Email']; ?>" >
                    
  </div>


  <div class="form-group col-md-4">
                        <label for="tele">Téléphone</label>
                        <input type="text" name="tele" class="form-control" value="<?php echo $row['Tele']; ?>" >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="adresse">Adresse</label>
                        <input type="text" name="adresse" class="form-control" value="<?php echo $row['Adresse']; ?>" >
                    </div>
                </div>
          <!-- Champs pour les fichiers (Diplômes) -->
                <div class="form-group" id="diplomeContainer">
                    <label for="diplome1">Diplôme 1</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="diplome1" name="diplome[]">
                            <label class="custom-file-label" for="diplome1">Choisir un fichier</label>
                        </div>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-success" id="ajouterDiplome"><i class="fas fa-plus"></i></button>
                            <button type="button" class="btn btn-danger" id="supprimerDiplome"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
  

  <button type="submit" name="registerbtn" class="btn btn-primary">Enregitrer</button>
</div>
</form>


    
  
<?php 
include('includes/scripts.php');
include('includes/footer.php');
?>

<script>
    // Fonction pour cloner et ajouter un espace de fichier pour les diplômes
    document.getElementById('ajouterDiplome').addEventListener('click', function() {
        var diplomeContainer = document.getElementById('diplomeContainer');
        var clone = diplomeContainer.cloneNode(true);
        clone.querySelector('.custom-file-input').value = '';
        clone.querySelector('.custom-file-label').textContent = 'Choisir un fichier';
        diplomeContainer.parentNode.insertBefore(clone, diplomeContainer.nextSibling);
    });

    // Fonction pour supprimer le champ de fichier Diplôme
    document.getElementById('supprimerDiplome').addEventListener('click', function() {
        var diplomeContainer = document.getElementById('diplomeContainer');
        if (diplomeContainer.parentNode.childElementCount > 1) {
            diplomeContainer.parentNode.removeChild(diplomeContainer);
        }
    });
</script>