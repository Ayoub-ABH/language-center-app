
<?php 
include('security.php');

secAdmin();
include('includes/header.php');
include('includes/navbar.php');
include("database_connection.php");

$query = "SELECT Date,DATE_FORMAT(Date, '%Y') AS year FROM etudiants  GROUP BY year DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

?> 
<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>



      



                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                
                   
                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-10 col-lg-10">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="col-md-3">
                            <select name="year" class="form-control" id="year">
                                <option value="">Select Year</option>
                            <?php
                            foreach($result as $row)
                            {
                                echo '<option value="'.$row["year"].'">'.$row["year"].'</option>';
                            }
                            ?>
                            </select>
                                    </div>
                                </div>
                                                        <div class="card-body">
                                                            <div class="chart-area">
                                    <div id="chart_area" style="width: 850px; height: 330px;"></div>
                                                            </div>
                                   
                                                        </div>
                            </div>

                            <!-- Bar Chart -->
                           

                        </div>
                    </div>    
                                        





<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback();

function load_monthwise_data(year, title)
{
    var temp_title = title + ' '+year+'';
    $.ajax({
        url:"fetch.php",
        method:"POST",
        data:{year:year},
        dataType:"JSON",
        success:function(data)
        {
         
            drawMonthwiseChart(data, temp_title);
        }
    });
}


function drawMonthwiseChart(chart_data, chart_main_title)
{
    
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Month');
    data.addColumn('number', 'etudiants');
    $.each(jsonData, function(i, jsonData){
        var month = jsonData.month;
        var profit = parseFloat($.trim(jsonData.profit));
        data.addRows([[month, profit]]);
    });
    var options = {
        title:chart_main_title,
        bar: {groupWidth: '30%'},
        hAxis: {
            title: "Mois"
        },
        vAxis: {
            title: 'Nombre d\'etudiants'
        }
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
    chart.draw(data, options);
}

function equipmentPerMonth(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'equipement');
    data.addColumn('number', 'value');
    $.each(jsonData, function(i, jsonData){
        var equipement = jsonData.equipement;
        var value = parseFloat($.trim(jsonData.value));
        data.addRows([[equipement, value]]);
    });
    var options = {
        title:chart_main_title,
        bar: {groupWidth: '30%'},
        colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f','red','green',],
        hAxis: {
            title: "Equipement"
        },
        vAxis: {
            title: 'Nombre d\'intervention par Equipement'
        }
    };
    var chart = new google.visualization.ColumnChart(document.getElementById('barchart_material'));
    chart.draw(data, options);
}

function equipmentPerMonthh(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'equipement');
    data.addColumn('number', 'value');
    $.each(jsonData, function(i, jsonData){
        var equipement = jsonData.equipement;
        var value = parseFloat($.trim(jsonData.value));
        data.addRows([[equipement, value]]);
    });
    var options = {
        title:chart_main_title,
        is3D: true,
        hAxis: {
            title: "Equipement"
        },
        vAxis: {
            title: 'Nombre d\'intervention par Equipement'
        }
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
}


</script>

<script>
    
$(document).ready(function(){

    $('#year').change(function(){
   
        var year = $(this).val();
        if(year != '')
        {
            load_monthwise_data(year, 'Nombre des incidents par mois pour');
        }
    });

});

</script>

<script>
    $(document).on("click", "#filter_date_chartt", function(e) {
        e.preventDefault();
        let startDatee =  $("#start_date_chartt").val();
        let endDatee = $("#end_date_chartt").val()

        $.ajax({
        url:"fetch.php",
        method:"POST",
        data:{startDatee:startDatee, endDatee:endDatee},
        dataType:"JSON",
        success:function(data)
        {
            equipmentPerMonth(data,"Répartition des incidents par équipement : ");
        }
    });
    });
    
</script>


<script>
    $(document).on("click", "#filter_date_chart", function(e) {
        e.preventDefault();
        let startDate =  $("#start_date_chart").val();
        let endDate = $("#end_date_chart").val()

        $.ajax({
        url:"fetch.php",
        method:"POST",
        data:{startDate:startDate, endDate:endDate},
        dataType:"JSON",
        success:function(data)
        {
            equipmentPerMonthh(data,"Maintenence Preventive - Check list : ");
        }
    });
    });
    
</script>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           

    

   

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


   

    <?php 
    include('includes/scripts.php');
    include('includes/footer.php');
    ?>