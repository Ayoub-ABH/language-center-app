<?php
session_start();
include('dbconfig.php');

// Vérifiez si le professeur est connecté
if (!isset($_SESSION['ProfesseurID'])) {
    header('Location: prof_log.php');
    exit();
}

$professeur_id = $_SESSION['ProfesseurID'];
$upload_error = '';
$upload_success = '';

// Gérer le téléchargement de fichiers
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['doc'])) {
    $target_dir = "upload/documents_prof/";
    
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $file_name = basename($_FILES['doc']['name']);
    $target_file = $target_dir . $file_name;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'txt', 'jpg', 'png', 'jpeg'];

    if (in_array($file_type, $allowed_types)) {
        if (move_uploaded_file($_FILES['doc']['tmp_name'], $target_file)) {
            $query = "INSERT INTO professeur_documents (professeur_id, file_name, file_path, file_type) 
                      VALUES (?, ?, ?, ?)";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("isss", $professeur_id, $file_name, $target_file, $file_type);
            $stmt->execute();

            $upload_success = "Fichier téléchargé avec succès.";
        } else {
            $upload_error = "Erreur lors du déplacement du fichier.";
        }
    } else {
        $upload_error = "Type de fichier non autorisé.";
    }
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
    <style>
        .preview {
            border: 1px solid #ddd;
            padding: 10px;
            min-height: 200px;
            text-align: center;
            margin-top: 10px;
        }

        .list-group-item {
            cursor: pointer;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="prof_espace.php">
                <div class="sidebar-brand-text mx-3">BILKER</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

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
            
            <li class="nav-item">
                <a class="nav-link collapsed" href="test.php">
                    <i class="fas fa-envelope"></i>
                    <span>test</span>
                </a>

            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="prof_contact.php">
                    <i class="fas fa-envelope"></i>
                    <span>Contact</span>
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
             
<body>
    <div class="container-fluid mt-5">
        <div class="row">
            <!-- Formulaire de téléchargement -->
            <div class="col-md-6">
                <h2 class="text-primary">Mes documents</h2>

                <!-- Afficher les messages d'erreur ou de succès -->
                <?php
                if ($upload_error) {
                    echo "<div class='alert alert-danger'>$upload_error</div>";
                } elseif ($upload_success) {
                    echo "<div class='alert alert-success'>$upload_success</div>";
                }
                ?>

                <!-- Formulaire de téléchargement -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="doc" class="form-label">Téléchargez votre document:</label>
                        <input type="file" name="doc" id="doc" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Télécharger</button>
                </form>

                <!-- Liste des documents du professeur -->
                <h3>Vos documents</h3>
                <ul class="list-group">
                    <?php
                    $query = "SELECT file_name, file_path 
                              FROM professeur_documents 
                              WHERE professeur_id = ?";
                    $stmt = $connection->prepare($query);
                    $stmt->bind_param("i", $professeur_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<li class='list-group-item'>";
                            echo htmlspecialchars($row['file_name']);
                            echo "<button class='btn btn-info btn-sm float-right' onclick='previewFile(\"" . htmlspecialchars($row['file_path']) . "\")'>Prévisualiser</button>";
                            echo "</li>";
                        }
                    } else {
                        echo "<li class='list-group-item'>Aucun document disponible.</li>";
                    }
                    ?>
                </ul>
            </div>

            <!-- Espace de prévisualisation -->
            <div class="col-md-6">
                <div class="preview" id="filePreview">
                    <p>Sélectionnez un document pour le prévisualiser.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript pour la prévisualisation -->
    <script>
        function previewFile(filePath) {
            const previewDiv = document.getElementById('filePreview');
            const fileType = filePath.split('.').pop().toLowerCase();

            if (['pdf', 'jpg', 'jpeg', 'png'].includes(fileType)) {
                previewDiv.innerHTML = `<embed src="${filePath}" type="application/pdf" width="100%" height="510px" />`;
            } else {
                previewDiv.innerHTML = "<p>Le type de document ne peut être prévisualisé.</p>";
            }
        }
    </script>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
<?php
include('includes/scripts.php'); 
include('includes/footer.php'); 
?>
