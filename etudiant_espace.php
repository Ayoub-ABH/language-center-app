<?php
session_start();
include ('dbconfig.php');
// include('security.php');
if (!isset($_SESSION['EtudiantID'])) {
    header('location: etudiant_log.php');
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="etudiant_espace.php">
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
                <a class="nav-link collapsed" href="etudiant_espace.php">
                    <i class="fas fa-user-graduate"></i>
                    <span>Mon profil</span>
                </a>

            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="etudiant_fichiers.php">
                    <i class="fas fa-file"></i>
                    <span>Mes documents</span>
                </a>

            </li>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="etudiant_contact.php">
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
                                    <?php echo $_SESSION['Etudiant_name']; ?>

                                    <?php
                                    $image_base_path = 'upload/images/';
                                    $query_image = "SELECT Image FROM etudiants WHERE EtudiantID = {$_SESSION['EtudiantID']}";
                                    $result_image = mysqli_query($connection, $query_image);
                                    if ($result_image && mysqli_num_rows($result_image) > 0) {
                                        $row_image = mysqli_fetch_assoc($result_image);
                                        $image_name = $row_image['Image'];
                                        $image_path = $image_base_path . $image_name;
                                    } else {
                                        $image_path = 'img/undraw_profile.svg';
                                    }
                                    ?>
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
                                <form action="etudiant_controller.php" method="POST">
                                    <button type="submit" name="logout_btn" class="btn btn-primary">Se
                                        déconnecter</button>
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
                                <meta http-equiv="refresh" content="5; url = etudiant_espace.php" />
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

                    <form role="form" method="post" action="etudiant_controller.php" style="margin-bottom : 170px"
                        enctype="multipart/form-data">
                        <div class="form-row">

                            <?php
                            if (mysqli_num_rows($query_run) > 0) {
                                $row = mysqli_fetch_assoc($query_run);
                                ?>

                                <div class="container bootstrap snippet">

                                    <div class="row">
                                        <div class="col-sm-3">

                                            <!-- form -->
                                            <form class="form" action="etudiant_controller.php" method="post">

                                                <div class="text-center">
                                                    <img src="upload/images/<?php echo $row['Image']; ?>"
                                                        class="avatar img-circle img-thumbnail" alt="avatar"
                                                        style="width: 250px; height: 225px;">
                                                    <h6>
                                                        <?php echo $row['Etudiant_name'] . ' ' . $row['Etudiant_prenom']; ?>
                                                    </h6>
                                                    <input type="file" name="image"
                                                        class="text-center center-block file-upload">
                                                </div>

                                                <ul class="list-group">
                                                    <li class="list-group-item"><span class="pull-left"><strong>Les
                                                                stages</strong></li>

                                                    <li class="list-group-item">
                                                        <label><input type="radio" name="mois_stage" value="aucun" <?php echo ($row['mois_stage'] == 'aucun') ? 'checked' : ''; ?>>
                                                            aucun</label><br>
                                                        <label><input type="radio" name="mois_stage" value="1-2 mois" <?php echo ($row['mois_stage'] == '1-2 mois') ? 'checked' : ''; ?>>
                                                            1-2 mois</label><br>
                                                        <label><input type="radio" name="mois_stage" value="3-6 mois" <?php echo ($row['mois_stage'] == '3-6 mois') ? 'checked' : ''; ?>>
                                                            3-6 mois</label><br>
                                                        <label><input type="radio" name="mois_stage" value="plus" <?php echo ($row['mois_stage'] == 'plus') ? 'checked' : ''; ?>>
                                                            plus</label><br>
                                                    </li>
                                                    <li class="list-group-item"><span
                                                            class="pull-left"><strong>Experiences</strong></li>
                                                    <li class="list-group-item">
                                                        <label><input type="radio" name="experience" value="aucun" <?php echo ($row['experience'] == 'aucun') ? 'checked' : ''; ?>>
                                                            aucun</label><br>
                                                        <label><input type="radio" name="experience" value="6 mois" <?php echo ($row['experience'] == '6 mois') ? 'checked' : ''; ?>> 6
                                                            mois</label><br>
                                                        <label><input type="radio" name="experience" value="1 ans" <?php echo ($row['experience'] == '1 ans') ? 'checked' : ''; ?>> 1
                                                            ans</label><br>
                                                        <label><input type="radio" name="experience" value="plus" <?php echo ($row['experience'] == 'plus') ? 'checked' : ''; ?>>
                                                            plus</label><br>
                                                    </li>

                                                    <li class="list-group-item"><span class="pull-left"><strong>Mot de
                                                                passe</strong></li>
                                                    <li class="list-group-item">

                                                        <label for="ancien_mot_de_passe">Ancien mot de passe</label>
                                                        <div class="input-group">
                                                            <!-- <input type="password" name="ancien_mot_de_passe"class="form-control" id="ancien_mot_de_passe" value="<?php echo $row['Password']; ?>"> -->
                                                            <input type="password" name="ancien_mot_de_passe"
                                                                class="form-control" id="ancien_mot_de_passe">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-eye" id="toggleAncienMotDePasse"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <label for="nouveau_mot_de_passe">Nouveau mot de passe</label>
                                                        <div class="input-group">
                                                            <input type="password" name="nouveau_mot_de_passe"
                                                                class="form-control" id="nouveau_mot_de_passe">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-eye-slash"
                                                                        id="toggleNouveauMotDePasse"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <!-- <button type="button" class="btn btn-primary" id="updatePasswordBtn">
                                                            <i class="fas fa-sync-alt"></i>
                                                        </button> -->
                                                    </li>


                                                </ul>
                                        </div>
                                        <div class="col-sm-9">
                                            <ul class="nav nav-tabs">
                                                <h4>Informations personnelles</h4>
                                            </ul>
                                            <br>
                                            <div class="form-group">
                                                <div class="col-xs-6">
                                                    <label for="inputEmail4">Nom etudiant</label>
                                                    <input type="text" name="etudiant_nom" class="form-control"
                                                        value="<?php echo $row['Etudiant_name']; ?>">
                                                </div>
                                                <div class="col-xs-6">
                                                    <label for="inputEmail4">Prenom etudiant</label>
                                                    <input type="text" name="etudiant_prenom" class="form-control"
                                                        value="<?php echo $row['Etudiant_name']; ?>">
                                                </div>
                                                <div class="col-xs-6">
                                                    <label for="CIN">CIN</label>
                                                    <input type="text" name="CIN" class="form-control"
                                                        value="<?php echo $row['CIN']; ?>">
                                                </div>
                                                <div class="col-xs-6">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" class="form-control"
                                                        value="<?php echo $row['Email']; ?>">
                                                </div>
                                                <div class="col-xs-6">
                                                    <label for="tele">Téléphone</label>
                                                    <input type="text" name="tele" class="form-control"
                                                        value="<?php echo $row['Tele']; ?>">
                                                </div>
                                                <div class="col-xs-6">
                                                    <label for="adresse">Adresse</label>
                                                    <input type="text" name="adresse" class="form-control"
                                                        value="<?php echo $row['Adresse']; ?>">
                                                </div>

                                                <br>
                                                <ul class="nav nav-tabs">
                                                    <h4>Autres Informations </h4>
                                                </ul>
                                                <br>

                                                <div class="col-xs-6">
                                                    <label for="niveau_etude">Niveau d'étude</label>
                                                    <select name="niveau_etude" class="form-control">
                                                        <option value="niveau-bac" <?php if (isset($row['niveau_etude']) && $row['niveau_etude'] == 'niveau-bac')
                                                            echo 'selected'; ?>>
                                                            Niveau Bac</option>
                                                        <option value="bac" <?php if (isset($row['niveau_etude']) && $row['niveau_etude'] == 'bac')
                                                            echo 'selected'; ?>>Bac
                                                        </option>
                                                        <option value="bac+1" <?php if (isset($row['niveau_etude']) && $row['niveau_etude'] == 'bac+1')
                                                            echo 'selected'; ?>>Bac +1
                                                        </option>
                                                        <option value="bac+2" <?php if (isset($row['niveau_etude']) && $row['niveau_etude'] == 'bac+2')
                                                            echo 'selected'; ?>>Bac +2
                                                        </option>
                                                        <option value="bac+3" <?php if (isset($row['niveau_etude']) && $row['niveau_etude'] == 'bac+3')
                                                            echo 'selected'; ?>>Bac +3
                                                        </option>
                                                        <option value="plus" <?php if (isset($row['niveau_etude']) && $row['niveau_etude'] == 'plus')
                                                            echo 'selected'; ?>>Plus
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-xs-6">
                                                    <label for="serie_bac">Série du bac</label>
                                                    <select name="serie_bac" class="form-control">
                                                        <option value="sciences_agronomiques" <?php if ($row['serie_bac'] == 'sciences_agronomiques')
                                                            echo 'selected'; ?>>BAC SCIENCES AGRONOMIQUES</option>
                                                        <option value="sciences_economiques" <?php if ($row['serie_bac'] == 'sciences_economiques')
                                                            echo 'selected'; ?>>BAC SCIENCES ÉCONOMIQUES</option>
                                                        <option value="techniques_gestion_comptabilite" <?php if ($row['serie_bac'] == 'techniques_gestion_comptabilite')
                                                            echo 'selected'; ?>>BAC TECHNIQUES DE GESTION ET
                                                            COMPTABILITÉ</option>
                                                        <option value="svt" <?php if ($row['serie_bac'] == 'svt')
                                                            echo 'selected'; ?>>SVT BAC</option>
                                                        <option value="lettres" <?php if ($row['serie_bac'] == 'lettres')
                                                            echo 'selected'; ?>>BAC LETTRES</option>
                                                        <option value="sciences_mathematiques_a" <?php if ($row['serie_bac'] == 'sciences_mathematiques_a')
                                                            echo 'selected'; ?>>BAC SCIENCES MATHÉMATIQUES A</option>
                                                        <option value="sciences_humaines" <?php if ($row['serie_bac'] == 'sciences_humaines')
                                                            echo 'selected'; ?>>SCIENCES HUMAINES</option>
                                                        <option value="sciences_mathematiques_b" <?php if ($row['serie_bac'] == 'sciences_mathematiques_b')
                                                            echo 'selected'; ?>>BAC SCIENCES MATHÉMATIQUES B</option>
                                                        <option value="sciences_chariaa" <?php if ($row['serie_bac'] == 'sciences_chariaa')
                                                            echo 'selected'; ?>>SCIENCES DE LA CHARIAA</option>
                                                        <option value="langue_arabe" <?php if ($row['serie_bac'] == 'langue_arabe')
                                                            echo 'selected'; ?>>
                                                            LANGUE ARABE</option>
                                                        <option value="arts_appliques" <?php if ($row['serie_bac'] == 'arts_appliques')
                                                            echo 'selected'; ?>>
                                                            ARTS APPLIQUÉS</option>
                                                        <option value="sciences_physiques" <?php if ($row['serie_bac'] == 'sciences_physiques')
                                                            echo 'selected'; ?>>BAC SCIENCES PHYSIQUES</option>
                                                        <option value="sciences_technologies_electriques" <?php if ($row['serie_bac'] == 'sciences_technologies_electriques')
                                                            echo 'selected'; ?>>BAC SCIENCES ET TECHNOLOGIES ÉLECTRIQUES
                                                        </option>
                                                        <option value="sciences_technologies_mecaniques" <?php if ($row['serie_bac'] == 'sciences_technologies_mecaniques')
                                                            echo 'selected'; ?>>BAC SCIENCES ET TECHNOLOGIES MÉCANIQUES
                                                        </option>
                                                    </select>
                                                </div>


                                                <div class="col-xs-6">
                                                    <label for="annee_bac">Date d'obtention du bac</label>
                                                    <input type="date" name="annee_bac" class="form-control"
                                                        value="<?php echo isset($row['annee_bac']) ? $row['annee_bac'] : ''; ?>">
                                                </div>

                                                <div class="col-xs-6">
                                                    <label for="intitule_diplome">Intitulé du diplôme</label>
                                                    <input type="text" name="intitule_diplome" class="form-control"
                                                        value="<?php echo $row['intitule_diplome']; ?>">
                                                </div>

                                                <div class="col-xs-6">
                                                    <label for="annee_diplome">Année du diplôme</label>
                                                    <input type="date" name="annee_diplome" class="form-control"
                                                        value="<?php echo $row['annee_diplome']; ?>">
                                                </div>

                                                <div class="col-xs-6">
                                                    <label for="specialite">Spécialité</label>
                                                    <select name="specialite" class="form-control">
                                                        <?php
                                                        $specialites = [
                                                            "Économie",
                                                            "Entrepreneuriat",
                                                            "Digital",
                                                            "Mécanique",
                                                            "Electricité"
                                                            ,
                                                            "Audiovisuel et Infographie",
                                                            "Gestion des entreprises",
                                                            "Développement Durable",
                                                            "Administration"
                                                            ,
                                                            "Information et Multimédia",
                                                            "Management",
                                                            "Finance",
                                                            "Sciences politiques",
                                                            "Logistique",
                                                            "Psychologie",
                                                            "Immobilier",
                                                            "Enseignement",
                                                            "Langues",
                                                            "Banque assurance",
                                                            "Médical",
                                                            "Commerce distribution",
                                                            "Droit",
                                                            "Ressources humaines",
                                                            "Biologie chimie pharmacie",
                                                            "Journalisme",
                                                            "Aéronautique et espace",
                                                            "Tourisme",
                                                            "Bâtiment - Travaux publics",
                                                            "Agroalimentaire et alimentaire",
                                                            "Artisanat - métiers d'art",
                                                            "Sport",
                                                            "Communication",
                                                            "Audit comptabilité gestion",
                                                            "Sciences humaines",
                                                            "Marketing",
                                                            "Environnement",
                                                            "Industrie",
                                                            "Informatique télécom web",
                                                            "Bâtiment génie civil"
                                                        ];
                                                        foreach ($specialites as $specialite) {
                                                            // Vérifier si la spécialité correspond à celle récupérée de la base de données
                                                            $selected = ($row['Specialite'] == $specialite) ? 'selected' : '';
                                                            echo "<option value=\"$specialite\" $selected>$specialite</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-xs-6">
                                                    <label for="parcours_souhaite">Parcours souhaite </label>
                                                    <select name="parcours_souhaite" class="form-control">
                                                        <option value="travail" <?php if ($row['parcours_souhaite'] == 'travail')
                                                            echo 'selected'; ?>>Travail</option>
                                                        <option value="etude" <?php if ($row['parcours_souhaite'] == 'etude')
                                                            echo 'selected'; ?>>Etude</option>
                                                        <option value="formation" <?php if ($row['parcours_souhaite'] == 'formation')
                                                            echo 'selected'; ?>>Formation</option>
                                                    </select>
                                                </div><br>

                                                <div class="form-group">
                                                    <label> Motivation </label>
                                                    <textarea name="motivation" class="form-control"
                                                        placeholder="Entrer la motivation"
                                                        maxlength="255"><?php echo $row['motivation'] ?></textarea>
                                                </div>

                                                <?php
                            } else {
                                echo "No Record Found";
                            }
                            ?>
                                            <button type="submit" name="modiferEtudiant"
                                                class="btn btn-primary">Modifier</button>
                                        </div>
                    </form>
                    <!-- end form -->
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    document.getElementById('toggleAncienMotDePasse').addEventListener('click', function () {
        var ancienMotDePasseInput = document.getElementById('ancien_mot_de_passe');
        var toggleAncienMotDePasseIcon = document.getElementById('toggleAncienMotDePasse');
        if (ancienMotDePasseInput.type === 'password') {
            ancienMotDePasseInput.type = 'text';
            toggleAncienMotDePasseIcon.classList.remove('fa-eye');
            toggleAncienMotDePasseIcon.classList.add('fa-eye-slash');
        } else {
            ancienMotDePasseInput.type = 'password';
            toggleAncienMotDePasseIcon.classList.remove('fa-eye-slash');
            toggleAncienMotDePasseIcon.classList.add('fa-eye');
        }
    });

    document.getElementById('toggleNouveauMotDePasse').addEventListener('click', function () {
        var nouveauMotDePasseInput = document.getElementById('nouveau_mot_de_passe');
        var toggleNouveauMotDePasseIcon = document.getElementById('toggleNouveauMotDePasse');
        if (nouveauMotDePasseInput.type === 'password') {
            nouveauMotDePasseInput.type = 'text';
            toggleNouveauMotDePasseIcon.classList.remove('fa-eye');
            toggleNouveauMotDePasseIcon.classList.add('fa-eye-slash');
        } else {
            nouveauMotDePasseInput.type = 'password';
            toggleNouveauMotDePasseIcon.classList.remove('fa-eye-slash');
            toggleNouveauMotDePasseIcon.classList.add('fa-eye');
        }
    });
</script>


<?php
include ('includes/scripts.php');
include ('includes/footer.php');
?>