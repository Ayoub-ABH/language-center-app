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
        // Retrieve data from the database
        $query = "SELECT * FROM etudiants";
        $result = mysqli_query($connection, $query);

        // Fetch the data and store it in an array
        $students = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $students[] = $row;
        }
    ?>

    <div class="row">
        <div class="col-md-12">
            <h1 class="h3 mb-0 text-gray-800">Charts</h1>
        </div>
        


        <div class="col-md-6">
            <canvas id="studentsPerNiveau"></canvas>   
        </div>
    </div>
        


</div>
<!-- /.container-fluid -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // a test of a graph
    var ctx = document.getElementById('studentsPerNiveau').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Informatique', 'Génie Civil', 'Génie Electrique', 'Génie Mécanique', 'Génie Industriel'],
            datasets: [{
                label: 'Nombre d\'étudiants par département',
                data: [12, 19, 3, 5, 2],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
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
        