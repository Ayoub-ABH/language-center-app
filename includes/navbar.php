
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
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

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="register.php">
        <i class="fas fa-key"></i>
        <span>Administration</span>
    </a>
</li>


<li class="nav-item">
    <a class="nav-link collapsed" href="visiteurs.php">
        <i class="fas fa-users"></i>
        <span>Visiteurs</span>
    </a>
    
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGroupes"
        aria-expanded="true" aria-controls="collapseGroupes">
        <i class="fas fa-cogs"></i>
        <span>Groupes</span>
    </a>
    <div id="collapseGroupes" class="collapse" aria-labelledby="headingGroupes" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="groupes.php">Ajouter Groupes</a>
            <a class="collapse-item" href="etudiants_all_groupes.php">liste groupes</a>
        </div>
    </div>
</li>


<li class="nav-item">
    <a class="nav-link collapsed" href="professeurs.php">
        <i class="fas fa-chalkboard-teacher"></i>
        <span>Professeurs</span>
    </a>
    
</li>


<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEtudiants"
        aria-expanded="true" aria-controls="collapseEtudiants">
        <i class="fas fa-user-graduate"></i>
        <span>Etudiants</span>
    </a>
    <div id="collapseEtudiants" class="collapse" aria-labelledby="headingEtudiants" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="etudiants.php">Ajouter Etudiants</a>
            <a class="collapse-item" href="liste_etudiants.php">liste Etudiants</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseXEtudiants"
        aria-expanded="true" aria-controls="collapseXEtudiants">
        <i class="fas fa-user-graduate"></i>
        <span>XEtudiants</span>
    </a>
    <div id="collapseXEtudiants" class="collapse" aria-labelledby="headingXEtudiants" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="x_etudiants.php">Ajouter Etudiants</a>
            <a class="collapse-item" href="liste_x_etudiants.php">liste Etudiants</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAbsence"
        aria-expanded="true" aria-controls="collapseEtudiants">
        <i class="fas fa-calendar-times"></i>
        <span>Absence</span>
    </a>
    <div id="collapseAbsence" class="collapse" aria-labelledby="headingAbsence" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="list_groupe2.php">Ajouter Absence</a>
            <a class="collapse-item" href="liste_absence.php">liste Absence</a>
        </div>
    </div>
</li>


<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePaiement"
        aria-expanded="true" aria-controls="collapsePaiement">
        <i class="fas fa-money-check-alt"></i>
        <span>Paiement</span>
    </a>
    <div id="collapsePaiement" class="collapse" aria-labelledby="headingPaiement" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="Ajouter_paiement.php">Ajouter paiement</a>
            <a class="collapse-item" href="paiement_complet.php">paiements complet</a>
            <a class="collapse-item" href="paiement_par_avance.php">liste par avance</a>
            <a class="collapse-item" href="paiement_non_paye.php">liste non paye</a>
        </div>
    </div>
</li>



<!-- Divider -->
<hr class="sidebar-divider">


<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="charts.php">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Graphique</span></a>
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
                <input type="text" class="form-control bg-light border-0 small" placeholder="Rechercher..."
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
                    <a class="dropdown-item" href="register.php">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                      
                    Editer le profil
                    </a>
            
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
