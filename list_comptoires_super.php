<?php 
include('dbconfig.php');
include('security.php');
secSuper();
include('includes/header.php');
include('includes/navbar.php');

?>
<?php 

$villeID = $_SESSION['villeID'];
$sql_time = "SELECT C.comptoirs as Comptoirs, SUM( Tbf) as TotalTimeMC FROM  `comptoir` as `C` left outer JOIN `intervention` as `I` ON C.ComptoirID = I.ComptoirID   GROUP By C.comptoirs ORDER BY C.ComptoirID ASC ";
if(isset($_POST['filter_date_tbf'])){
    
    if(isset($_POST['end_date_tbf']) && isset($_POST['start_date_tbf'])){
        $end_date = $_POST['end_date_tbf'];
        $start_date = $_POST['start_date_tbf'];
        $_SESSION['start_date'] = $start_date;
        $_SESSION['end_date'] = $end_date;
        $sql_time = "SELECT  C.comptoirs as Comptoirs, SUM( Tbf) as TotalTimeMC FROM  `comptoir` as `C` left outer JOIN `intervention` as `I` ON C.ComptoirID = I.ComptoirID WHERE I.VilleID = $villeID AND I.Date BETWEEN '$start_date' AND '$end_date'  GROUP By C.comptoirs ORDER BY C.ComptoirID ASC ";
    }
}
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="superadmin.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>
<div class="card shadow mb-4">
  <?php 

  ?>
<div class="card-body">
                            <form method="post">
                            <div class="row">
                                <?php
                                 $sessStartDate = '';
                                 $sessEndDate = '';
                                 if(isset($_SESSION['start_date']) && isset($_SESSION['end_date'])){
                                     $sessStartDate = $_SESSION['start_date'];
                                     $sessEndDate = $_SESSION['end_date'];
                                 }
                                ?>
                                     <div class="col-md-2">
                                          <div class="form-group">
                                              <label>from date </label>
                                              <input required type="date" value="<?php echo $sessStartDate;?>" class="form-control" name="start_date_tbf" placeholder="Start Date" >
                                          </div>
                                     </div>
  
                                    <div class="col-md-2">
                                          <div class="form-group">
                                              <label>to date </label>
                                              <input required type="date" value="<?php echo $sessEndDate;?>" class="form-control" name="end_date_tbf" placeholder="End Date">
                                          </div>
                                     </div>
                                     <div class="col-md-2 pt-4"><button id="filter_date_tbf" name="filter_date_tbf" class="btn btn-outline-info btn-sm">Filter</button></div>
                            </div>
                            </form>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>  
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>   



                            <div class="table-responsive">
                            <input class="btn btn-primary btn-sm" type="button" onclick="tableToExcel('dataTable', 'W3C Example Table')" value="Export to Excel" >
                            <input class="btn btn-primary btn-sm"  type="button" value="Create PDF" id="btPrint" onclick="createPDF()" />
                            <div id="tab">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                    <tbody>
                                    <th  rowspan="2"  style="text-align: center;align-items: center;padding-bottom: 34px;text-transform: uppercase;color: blue;font-weight: 900;font-size: 50px;">Sita</th>
                                                <th colspan="3" rowspan="2" style="text-align: center;align-items: center;padding-top: 32px;text-transform: uppercase;color: blue;font-weight: 900;font-size: 18px;">
                                                  TAUX DE BON FONCTIONNEMENT DES EQUIPEMENT CUTE (TBF)
                                                  </th>

                                                  <th style="text-align: center;align-items: center;text-transform: uppercase;color: blue;font-weight: 900;font-size: 14px;"> <?php  echo  "date " . date("Y-m-d") ; ?></th>
                                                </tr>
                                                <tr>
                                                  <th style="text-align: center;align-items: center;text-transform: uppercase;color: blue;font-weight: 900;font-size: 14px;">SITE: AEROPORT  <?php 

$villeID = $_SESSION['villeID'];
$query = "SELECT Libelle FROM ville WHERE VilleID = $villeID";
$query_run = mysqli_query($connection,$query);

?>

<?php
                if(mysqli_num_rows($query_run) > 0)
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                        ?>

<?php echo $row['Libelle']; ?>


<?php
                }
            }
                 else{
                        echo "no record found";
                         }
                    ?>
                    
                
                </th>
                                                </tr>
                                      
                                              </tr>
                                        <tr>
                                           
                                            <th>Equipement CUTE</th>
                                            <th style="text-align:center">Temps d'arrêt MC</th>
                                            <th style="text-align:center">Temps d'arrêt MP</th>
                                            <th style="text-align:center">Temps total</th>
                                <th style="text-align:center">(TBF) en %</th>
                                           
                                        </tr>
                                   
                                   
                                    <?php
                                        $sql_comptoirs = "SELECT comptoirs as Comptoirs FROM comptoir WHERE VilleID = $villeID";
                                        $query_comptoirs = mysqli_query($connection, $sql_comptoirs);
                                        $query_time = mysqli_query($connection, $sql_time);
                                        $totalMC = 0;
                                        $totalMP = 0;
                                        $totalTemps = 0;
                                        $isFound;
                                        $dataComptoirs = $query_comptoirs->fetch_all(MYSQLI_ASSOC);
                                        $dataTBF = $query_time->fetch_all(MYSQLI_ASSOC);
                                        
                                        foreach($dataComptoirs as $id => $row_comptoir){ 
                                        $isFound = false;
                                        $comptoir1 = $row_comptoir['Comptoirs'];
                                        foreach($dataTBF as $id => $row2){ 
                                             
                                             $comptoir2 = $row2['Comptoirs'];
                                            if($comptoir1 == $comptoir2 ){
                                                
                                                $isFound = true;
                                                $totalMC = $totalMC + $row2['TotalTimeMC'];
                                                $totalMP = $totalMP + 5 ;
                                                $totalTemps = $totalTemps + ($row2['TotalTimeMC']+5);
                                                $total = ((744-($row2['TotalTimeMC']/60))/744)*100;
                                        ?>
                                            <tr>
                         <td> <?php echo $row2['Comptoirs'];?></td>
                     <td style="text-align:center"> <?php echo $row2['TotalTimeMC'];?> Min</td>
                            <td style="text-align:center"> 5 </td>
                                            <td style="text-align:center"> <?php echo $row2['TotalTimeMC']+5;?></td>
                                            <td style="text-align:center"><?php echo number_format($total,3);?>(%)</td>
                                            </tr>
                                        
                                        <?php } // end if intervention
                                        } // end while intervention
                                        if( $isFound === false ){
                                            ?>
                                             <tr>
                                    <td> <?php echo $row_comptoir['Comptoirs'];?></td>
                                    <td style="text-align:center"> 0 Min</td>
                                    <td style="text-align:center"> 5 </td>
                                    <td style="text-align:center"> 5</td>
                                    <td style="text-align:center">100.000(%)</td>
                                            </tr>
                                            <?php
                                        }
                                        }// end while comptoir ------- 
                                        
                                        $globalTotalTemps =number_format($totalMC/60,2); 
                                        $tauxCUTEAll = number_format(((744-$globalTotalTemps)/744)*100,3);
                                        $tauxCUTESingle = number_format(((744-($globalTotalTemps/59))/744)*100,3);
                                        ?>
                                        <tr class="bg-warning">
                                    <td style="text-align:center"><?php echo "Total Temps TBF" ;?></td>
                                    <td style="text-align:center"><?php echo $totalMC ;?></td>
                                <td style="text-align:center"><?php echo $totalMP;?></td>
                                <td style="text-align:center"><?php echo $totalTemps;?></td>
                             <td style="text-align:center"><?php echo number_format(((744-$totalMC/60)/744)*100,3);?> (%)</td>
                                        </tr>
                                        <tr>
                                            <td rowspan="6" scope="rowgroup"style="text-align:center">TBF</td>
                                          
                                              <tr>
                                                <td colspan="3"> Temps d'arrêt Total pour reparation en Min est :</td>
                                                <td style="text-align:center"><?php echo $totalMC;?></td>
                                              </tr>
                                        <tr>
                                            <td colspan="3"> Temps d'arrêt Total pour PM en Min est : </td>
                                            <td style="text-align:center"><?php echo $totalMP;?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"> Temps total d'arrêt (Temps d'arrêt pour PM + temps total Pour Maintenance Currative) en Heur :</td>
                                            <td style="text-align:center"><?php echo $globalTotalTemps;?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" > Taux moyenne de Bon fonctionnement de tous les equipements CUTE est:</td>
                                <td style="color:red;text-align:center"><?php echo $tauxCUTEAll;?>(%)</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"> Taux moyenne de Bon fonctionnement d'un seul equipement CUTE est: </td>
                                            <td style="text-align:center"><?php echo $tauxCUTESingle;?>(%)</td>
                                        </tr>
                                          
                                        </tr>
                                        
                                       
                                       
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <script type="text/javascript">
var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()
</script>
<script>
    function createPDF() {
        var sTable = document.getElementById('tab').innerHTML;

        var style = "<style>";
        style = style + "table {width: 100%;height: 50px;font: 17px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        // CREATE A WINDOW OBJECT.
        var win = window.open('', '', 'height=700,width=700');

        win.document.write('<html><head>');
        win.document.write('<title>TBF</title>');   // <title> FOR PDF HEADER.
        win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
        win.document.write('</body></html>');

        win.document.close(); 	// CLOSE THE CURRENT WINDOW.

        win.print();    // PRINT THE CONTENTS.
    }
</script>
   
<?php 
include('includes/scripts.php');
include('includes/footer.php');
?>