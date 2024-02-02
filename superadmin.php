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
                <input type="text" class="form-control bg-light border-0 small" placeholder="Rechercher..."
                    aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
        <ul class="navbar-nav text-center">
        <?php if($_SESSION['userType'] == "super"){
            ?>
            <li class="nav-item ">

            </li>
            <?php }?>
        </ul>
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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                  

                    <!-- Content Row -->
                    <div class="row">

                    
                    </div>

                    <!-- Content Row -->
                    


<div class="card shadow mb-4">
  
  <div class="card-body">
                              
                              <div class="table-responsive">
                                
                                      <div class="row">
                                          <div class="col-md-2">
                                          <div class="form-group">
                                              <label>Partir de la date </label>
                                              <input type="date" class="form-control" id="start_date" placeholder="Start Date" >
                                          </div>
                                          </div>
  
                                          <div class="col-md-2">
                                          <div class="form-group">
                                              <label>À ce jour </label>
                                              <input type="date" class="form-control" id="end_date" placeholder="End Date">
                                          </div>
                                          </div>
  
                                          <div class="col-md-3">
                                          <div class="form-group">
                                        
                                          <button id="filter" class="btn btn-outline-info btn-sm">Filter</button>
                                          <button id="reset" class="btn btn-outline-warning btn-sm">Réinitialiser</button>
  
                                          </div>
                                          </div>
                                      </div>
                                
                                 
                                  <div class="table-responsive">
                              <table class="table table-borderless display nowrap" id="records" style="width:100%">
                                  <thead>
                                      <tr>
                                            <th>Date_inscription</th>
                                              <th>Nom</th>
                                              <th>Prenom</th>
                                              <th>Cin</th>
                                              <th>Telephone</th>
                                              <th>Adresse</th>
                                            
                                      </tr>
                                  </thead>
                              </table>
                              </div>
                       
                            
  
                  </div>
                  <!-- /.container-fluid -->
  
              </div>
              <!-- End of Main Content -->





           
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <!-- Datepicker -->
    
    <!-- Datatables -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
    </script>
    <!-- Momentjs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
          

    <script>
    // Fetch records

    function fetch(start_date, end_date) {
        $.ajax({
            url: "records.php",
            type: "POST",
            data: {
                start_date: start_date,
                end_date: end_date
            },
          dataType: "json",
            success: function (data) {
                // Datatables
                $('#records').DataTable({
                    "data": data,
                    "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    "buttons": ['excel', 'print'],
                    "responsive": true,
                    "columns": [
                        {
                        "data": "Date_inscription",
                        "render": function (data, type, row, meta) {
                            return moment(row.Date_inscription).format('DD-MM-YYYY'); 
                        }
                    },
                    {
                        "data": "Nom", 
                        "render": function (data, type, row, meta) {
                            return `${row.Etudiant_name}`;
                        }
                    },
                    {
                        "data": "Prenom", 
                        "render": function (data, type, row, meta) {
                            return `${row.Etudiant_prenom}`;
                        }
                    },
                    {
                        "data": "CIN",
                        "render": function (data, type, row, meta) {
                            return `${row.CIN}`;
                        }
                    },
                    {
                        "data": "Tele",
                        "render": function (data, type, row, meta) {
                            return `${row.Tele}`;
                        }
                    },
                    {
                        "data": "Adresse",
                        "render": function (data, type, row, meta) {
                            return `${row.Adresse}`;
                        }}
                        // Add rendering for other columns as needed
                    ]
                });
            }
        });
    }

    fetch();


    // Filter

    $(document).on("click", "#filter", function(e) {
        e.preventDefault();

        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();

        if (start_date == "" || end_date == "") {
            alert("both date required");
        } else {
            $('#records').DataTable().destroy();
            fetch(start_date, end_date);
        }
    });

    // Reset

    $(document).on("click", "#reset", function(e) {
        e.preventDefault();

        $("#start_date").val(''); // empty value
        $("#end_date").val('');

        $('#records').DataTable().destroy();
        fetch();
    });
    </script>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

         

     <!-- Custom scripts for all pages-->
     <script src="js/sb-admin-2.min.js"></script>
<?php 
// include('includes/scripts.php');
include('includes/footer.php');