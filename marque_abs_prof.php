<?php

session_start();
include ('dbconfig.php');
// include('security.php');
if (!isset ($_SESSION['ProfesseurID'])) {
    header('location: prof_log.php');
}

if (isset($_GET['groupe_id']) && is_numeric($_GET['groupe_id'])) {
    $groupe_id = intval($_GET['groupe_id']); 
} 
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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="" data-toggle="collapse"
                data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">

                <div class="sidebar-brand-text mx-3">BILKER</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <!-- Nav Item - Pages Collapse Menu -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="prof_espace.php">
                    <i class="fas fa-user-graduate"></i>
                    <span>Mon profil</span>
                </a>

            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="prof_fichiers.php">
                    <i class="fas fa-file"></i>
                    <span>Mes documents</span>
                </a>

            </li>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="prof_contact.php">
                    <i class="fas fa-envelope"></i>
                    <span>Contact</span>
                </a>

            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="test.php">
                    <i class="fas fa-envelope"></i>
                    <span>test</span>
                </a>

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
                              
                                    <img class="img-profile rounded-circle" src="<?php echo $image_path; ?>">
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
                            <div class="modal-body">Sélectionnez "Se déconnecter" ci-dessous si vous êtes prêt à mettre
                                fin à votre session en cours.</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                                <form action="prof_controller.php" method="POST">
                                    <button type="submit" name="logout_btn" class="btn btn-primary">Se
                                        déconnecter</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>








<head>
    <title>Ajouter Absence</title> 
    <link rel="stylesheet" type="text/css" href="css/etudiant_admin.css?v=1.0">
    <style>
        .visitor-card {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            margin-bottom: 20px;
            width: 250px;
            height: 150px;
            overflow: hidden;
        }

        .visitor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        }

        .etudiant-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ajouter Absence</h6>
                <div class="card-body"> 
                    <label>
                        <input type="checkbox" id="mark-all" onclick="toggleAttendance(this)"> Marquer tous les étudiants
                    </label>
                    <?php
                    
                    if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
                        echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                        unset($_SESSION['success']); 
                    }

                    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                        echo '<div class="alert alert-danger">' . $_SESSION['status'] . '</div>';
                        unset($_SESSION['status']); 
                    }
                    ?>
                </div>
            </div>
        </div>

        <form action="marquer_absence_prof.php" method="POST"> 
            <div class="row">
                <?php
                $query = "SELECT EtudiantID, Etudiant_name, Etudiant_prenom 
                          FROM etudiants 
                          WHERE GroupeID = ?";
                $stmt = $connection->prepare($query);

                if ($stmt) { 
                    $stmt->bind_param("i", $groupe_id);
                    $stmt->execute(); 
                    $result = $stmt->get_result();

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="visitor-card">
                                    <h3 class="etudiant-name"><?php echo htmlspecialchars($row['Etudiant_name'] . ' ' . $row['Etudiant_prenom']); ?></h3>
                                    <input type="checkbox" name="etudiant_ids[]" value="<?php echo htmlspecialchars($row['EtudiantID']); ?>" class="attendance-checkbox"> 
                                </div>
                            </div>
                            <?php
                        }
                    } }
                ?>
            </div>

            <div>
                <button type="submit" class="btn btn-success" name="marquer_presence_tous">Marquer Présence</button>
                <button type="submit" class="btn btn-danger" name="marquer_absence_tous">Marquer Absence</button>
            </div>
        </form>
    </div>

    <script>
        function toggleAttendance(checkbox) {
            const checkboxes = document.querySelectorAll('.attendance-checkbox');
            checkboxes.forEach(cb => {
                cb.checked = checkbox.checked; // Basculer l'état de tous les checkboxes
            });
        }
    </script>
</body>

<?php
include('includes/footer.php'); 
?>
