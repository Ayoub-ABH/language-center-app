<?php
include('security.php');
include('dbconfig.php');

secAdmin();
include('includes/header.php');
include('includes/navbar.php');

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <?php
        // Retrieve data from the database for students
        $query_students = "SELECT YEAR(date_inscription) AS annee, COUNT(*) AS nombre_etudiants FROM etudiants GROUP BY YEAR(date_inscription)";
        $result_students = mysqli_query($connection, $query_students);

        // Fetch the data and store it in arrays for students
        $annees_students = [];
        $nombre_etudiants = [];
        while ($row = mysqli_fetch_assoc($result_students)) {
            $annees_students[] = $row['annee'];
            $nombre_etudiants[] = $row['nombre_etudiants'];
        }

        // Retrieve data from the database for visitors
        $query_visitors = "SELECT YEAR(date_visite) AS annee, COUNT(*) AS nombre_visiteurs FROM visiteurs GROUP BY YEAR(date_visite)";
        $result_visitors = mysqli_query($connection, $query_visitors);

        // Fetch the data and store it in arrays for visitors
        $annees_visitors = [];
        $nombre_visiteurs = [];
        while ($row = mysqli_fetch_assoc($result_visitors)) {
            $annees_visitors[] = $row['annee'];
            $nombre_visiteurs[] = $row['nombre_visiteurs'];
        }

        // Query to get the count of students per level
        $query_levels = "SELECT NiveauID, COUNT(*) AS nombre_etudiants FROM etudiants GROUP BY NiveauID";
        $result_levels = mysqli_query($connection, $query_levels);

        // Fetch the data and store it in arrays
        $niveaux = [];
        $nombre_etudiants_par_niveau = [];
        $total_etudiants = 0; // Initialize total number of students
        while ($row = mysqli_fetch_assoc($result_levels)) {
            // Assuming you have another table for Niveaux where you can fetch the level name based on its ID
            $niveau_query = "SELECT Niveau_name FROM niveau WHERE NiveauID = " . $row['NiveauID'];
            $niveau_result = mysqli_query($connection, $niveau_query);
            $niveau_row = mysqli_fetch_assoc($niveau_result);
            $niveaux[] = $niveau_row['Niveau_name'];
            $nombre_etudiants_par_niveau[] = $row['nombre_etudiants'];
            $total_etudiants += $row['nombre_etudiants']; // Increment total number of students
        }

        // Calculate percentage of students per level
        $pourcentage_etudiants_par_niveau = [];
        foreach ($nombre_etudiants_par_niveau as $nombre_etudiants) {
            $pourcentage_etudiants_par_niveau[] = ($nombre_etudiants / $total_etudiants) * 100;
        }
    ?>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistiques des étudiants par année</h6>
                </div>
                <div class="card-body">
                    <canvas id="studentsPerYear"></canvas>   
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Statistiques des visiteurs par année</h6>
                </div>
                <div class="card-body">
                    <canvas id="visitorsPerYear"></canvas>   
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pourcentage des étudiants par niveau</h6>
                </div>
                <div class="card-body">
                    <canvas id="studentsPerLevel"></canvas>   
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Chart configuration for students
    var ctx_students = document.getElementById('studentsPerYear').getContext('2d');
    var myChartStudents = new Chart(ctx_students, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($annees_students); ?>,
            datasets: [{
                label: 'Nombre d\'étudiants',
                data: <?php echo json_encode($nombre_etudiants); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Chart configuration for visitors
    var ctx_visitors = document.getElementById('visitorsPerYear').getContext('2d');
    var myChartVisitors = new Chart(ctx_visitors, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($annees_visitors); ?>,
            datasets: [{
                label: 'Nombre de visiteurs',
                data: <?php echo json_encode($nombre_visiteurs); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Chart configuration for students per level
    var ctx_students_per_level = document.getElementById('studentsPerLevel').getContext('2d');
    var myChartStudentsPerLevel = new Chart(ctx_students_per_level, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($niveaux); ?>,
            datasets: [{
                label: 'Pourcentage des étudiants par niveau',
                data: <?php echo json_encode($pourcentage_etudiants_par_niveau); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
