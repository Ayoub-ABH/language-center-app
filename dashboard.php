<?php

include('security.php');
secAdmin();

include('includes/header.php');
include('includes/navbar.php');

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">

        <!-- Total Visiteurs -->
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

                                echo '<h5>' . $row . '</h5>'
                                ?>


                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-friends fa-2x" style="color:#c8241c;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TOTAL Etudiants -->
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

                                echo '<h5>' . $row . '</h5>'
                                ?>


                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x" style="color:#c8241c;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Professeurs -->
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

                                echo '<h5>' . $row . '</h5>'
                                ?>
                            </div>
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x" style="color:#c8241c;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Total Groupes -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Groupes</div>


                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php
                                require 'dbconfig.php';
                                $query = "SELECT GroupeID FROM groupes ";
                                $query_run = mysqli_query($connection, $query);

                                $row = mysqli_num_rows($query_run);

                                echo '<h5>' . $row . '</h5>'
                                ?>
                            </div>
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-users fa-2x" style="color:#c8241c;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


    <!-- Content Row -->
    <div class="row">
        <div class="card shadow mb-4" style="width: 100% !important; margin: 0 10px 0 10px;">

            <div class="card-body">

                <div class="table-responsive">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Partir de la date </label>
                                <input type="date" class="form-control" id="start_date">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>À ce jour</label>
                                <input type="date" class="form-control" id="end_date">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">

                                <button id="filter" class="btn btn-outline-info btn-sm">Filter</button>

                                <button id="reset" class="btn btn-outline-warning btn-sm">Réinitialiser</button>

                            </div>
                        </div>
                    </div>



                    <div>
                        <table class="table table-borderless " id="records">

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
            </div>

            <?php
            include('includes/scripts.php');
            ?>
            <!-- Font Awesome -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
            <!-- Datepicker -->
            <!-- Datatables -->
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js">
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
                        success: function(data) {
                            // Datatables
                            $('#records').DataTable({
                                "data": data,
                                "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                                    "<'row'<'col-sm-12'tr>>" +
                                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                                "buttons": ['excel', 'print'],
                                "responsive": true,
                                "columns": [{
                                        "data": "Date_inscription",
                                        "render": function(data, type, row, meta) {
                                            return moment(row.Date_inscription).format('DD-MM-YYYY');
                                        }
                                    },
                                    {
                                        "data": "Nom",
                                        "render": function(data, type, row, meta) {
                                            return `${row.Etudiant_name}`;
                                        }
                                    },
                                    {
                                        "data": "Prenom",
                                        "render": function(data, type, row, meta) {
                                            return `${row.Etudiant_prenom}`;
                                        }
                                    },
                                    {
                                        "data": "CIN",
                                        "render": function(data, type, row, meta) {
                                            return `${row.CIN}`;
                                        }
                                    },
                                    {
                                        "data": "Tele",
                                        "render": function(data, type, row, meta) {
                                            return `${row.Tele}`;
                                        }
                                    },
                                    {
                                        "data": "Adresse",
                                        "render": function(data, type, row, meta) {
                                            return `${row.Adresse}`;
                                        }
                                    }
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

                    if (start_date !== "" && end_date !== "") {
                        $('#records').DataTable().destroy();
                        fetch(start_date, end_date);
                    } else if (start_date !== "" && end_date == "") {
                        $('#records').DataTable().destroy();
                        fetch(start_date, '', '');
                    } else if (start_date == "" && end_date !== "") {
                        $('#records').DataTable().destroy();
                        fetch('', end_date);
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




    <?php
    include('includes/footer.php');
    ?>