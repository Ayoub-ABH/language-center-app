<?php 

include('security.php');
secAdmin();

include('includes/header.php');
include('includes/navbar.php');

?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

</a>


                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                               Total Visiteurs</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                          require 'dbconfig.php';
                                            $query = "SELECT VisiteurID FROM visiteurs ";
                                            $query_run = mysqli_query($connection, $query);
                                            
                                            $row = mysqli_num_rows($query_run);
                                            
                                            echo '<h5>' .$row. '</h5>'
                                            ?>


                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-users fa-2x" style="color:#4e73df;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                TOTAL Etudiants</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                            require 'dbconfig.php';
                                            $query = "SELECT EtudiantID FROM etudiants ";
                                            $query_run = mysqli_query($connection, $query);
                                            
                                            $row = mysqli_num_rows($query_run);
                                            
                                            echo '<h5>' .$row. '</h5>'
                                            ?>
                                            
                                            
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                           <i class="fas fa-users fa-2x" style="color:#1cc88a;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Total Professeurs</div>


                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                            require 'dbconfig.php';
                                            $query = "SELECT ProfesseurID FROM professeurs ";
                                            $query_run = mysqli_query($connection, $query);
                                            
                                            $row = mysqli_num_rows($query_run);
                                            
                                            echo '<h5>' .$row. '</h5>'
                                            ?>
                                                    </div>
                                                </div>
                                                
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x" style="color:#36b9cc;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                     <!-- Earnings (Monthly) Card Example 
                     <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                               Total Compagnie</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                          require 'dbconfig.php';
                                          $villeID = $_SESSION['villeID'];
                                            $query = "SELECT CompagnieID FROM compagnie Where VilleID = $villeID ";
                                            $query_run = mysqli_query($connection, $query);
                                            
                                            $row = mysqli_num_rows($query_run);
                                            
                                            echo '<h5>' .$row. '</h5>'
                                            ?>


                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-building fa-2x" style="color:#CC0000;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>-->
                            


                    <!-- Content Row -->
                    


<div class="card shadow mb-4">
  
  <div class="card-body">
                              
                              <div class="table-responsive">
                                
                                      <div class="row">
                                          <div class="col-md-2">
                                          <div class="form-group">
                                              <label>Partir de la date </label>
                                              <input type="date" class="form-control" id="start_date" >
                                          </div>
                                          </div>
  
                                          <div class="col-md-2">
                                          <div class="form-group">
                                              <label>À ce jour</label>
                                              <input type="date" class="form-control" id="end_date" >
                                          </div>
                                          </div>
                                          <div class="row">
                                          <div class="col-12">
                                          <label>Systeme</label>
                                           <select name="fetchval" id="fetchval" class="form-control border-1 small">
                                               <option value="" disabled="" selected="">selectionner Systeme</option>
                                           </select>
                                          

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
                                        <!-- <th>ID</th> -->
                                        <!-- <th>Date</th> -->
                                              <th>Etudiant</th>
                                              <th>Professeur</th>
                                              <th>Visiteur</th>
                                          
                                            
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

    function fetch(start_date, end_date ,systeme) {
        $.ajax({
            url: "records_adm.php",
            type: "POST",
            data: {
                start_date: start_date,
                end_date: end_date,
                systeme: systeme
            },
            dataType: "json",
            success: function(data) {
                // Datatables
                var i = "1";

                $('#records').DataTable({
                    "data": data,   
                    
                // buttons
                    "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    "buttons": [
                         'excel', 'print'
                    ],
                    // responsive
                    "responsive": true,
                    "columns": [
                       
                        {
                            "data": "Emplacement",
                            "render": function(data, type, row, meta) {
                                return `${row.Etudiant}`;
                            }
                        },
                        {
                            "data": "Equipement",
                            "render": function(data, type, row, meta) {
                                return `${row.Professeur}`;
                            }
                        },
                        {
                            "data": "Comptoir",
                            "render": function(data, type, row, meta) {
                                return `${row.Visiteur}`;
                            }
                        }

                       
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
        var systeme = $("#fetchval").val();

        if (start_date !== "" && end_date !== "" && systeme !== "") {
            $('#records').DataTable().destroy();
            fetch(start_date, end_date,systeme);
        } else if (start_date !== "" && end_date == "" && systeme == "") {
            $('#records').DataTable().destroy();
            fetch(start_date, '','');
        } else if (start_date == "" && end_date !== "" && systeme !== "") {
            $('#records').DataTable().destroy();
            fetch('', end_date,systeme);
        } else {
            $('#records').DataTable().destroy();
            fetch();
        }
    });

    // Reset

    $(document).on("click", "#reset", function(e) {
        e.preventDefault();

        $("#start_date").val(''); // empty value
        $("#end_date").val('');
        $("#fetchval").val('');

        $('#records').DataTable().destroy();
        fetch();
    });

    //filter systeme

    

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