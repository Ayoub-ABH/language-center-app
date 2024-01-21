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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">

                <div class="sidebar-brand-text mx-3">BILKER</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <!-- <li class="nav-item active">
                <a class="nav-link" href="formulaire.php" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>
                        Tableau de bord</span></a>
            </li> -->


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>


            <!-- Nav Item - Utilities Collapse Menu -->


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fab fa-wpforms"></i>
                    <span>Espace Etudiant</span>
                </a>

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Espace Etudiant</h6>
                        <a class="collapse-item" href="etudiant_espace.php">Profile</a>
                        <a class="collapse-item" href="etudiant_fichiers.php">Votre fichiers</a>
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
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
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
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $_SESSION['username']; ?>

                                </span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

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
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <?php

                            if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                                echo '<h6 class="alert alert-success" role="alert"> ' . $_SESSION['success'] . ' </h6>
                                <meta http-equiv="refresh" content="5; url = formulaire.php" />
                                ';
                                unset($_SESSION['success']);
                            }

                            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                                echo '<h6 class="alert alert-danger" role="alert"> ' . $_SESSION['status'] . ' </h6>';
                                unset($_SESSION['status']);
                            }

                            ?>


                        </div>
                    </div>

                    <?php
                    $etudiantID = $_SESSION['EtudiantID'];
                    $query = "SELECT * FROM etudiants WHERE EtudiantID = $etudiantID";
                    $query_run = mysqli_query($connection, $query);
                    ?>
                    <form role="form" method="post" action="etudiant_controller.php" style="margin-bottom : 170px">
                        <div class="form-row">

                            <?php
                            if (mysqli_num_rows($query_run) > 0) {
                                $row = mysqli_fetch_assoc($query_run);
                            ?>

                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Nom etudiant</label>
                                    <input type="text" name="etudiant_nom" class="form-control" value="<?php echo $row['Etudiant_name']; ?>">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">Prenom etudiant</label>
                                    <input type="text" name="etudiant_prenom" class="form-control" value="<?php echo $row['Etudiant_prenom']; ?>">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="inputEmail4">CIN</label>
                                    <input type="text" name="cin" class="form-control" value="<?php echo $row['CIN']; ?>">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $row['Email']; ?>">
                                </div>


                                <div class="form-group col-md-4">
                                    <label for="tele">Téléphone</label>
                                    <input type="text" name="tele" class="form-control" value="<?php echo $row['Tele']; ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="adresse">Adresse</label>
                                    <input type="text" name="adresse" class="form-control" value="<?php echo $row['Adresse']; ?>">
                                </div>

                            <?php
                            } else {
                                echo "No Record Found";
                            }
                            ?>

                            <button type="submit" name="modiferEtudiant" class="btn btn-primary">modifier</button>
                        </div>
                    </form>
                        
                <?php
                include('includes/scripts.php');
                include('includes/footer.php');
                ?>
