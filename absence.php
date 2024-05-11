<?php
include('dbconfig.php'); 
include('security.php'); 
secAdmin(); 
include('includes/header.php'); 
include('includes/navbar.php'); 

?>

<div class="container-fluid" style="padding: 20px;">
    <div class="row" style="flex-direction: column; gap: 15px;"> 
        <?php
        $query = "SELECT groupes.GroupeID, groupes.Groupe_name, professeurs.Professeur_name
                  FROM groupes
                  INNER JOIN professeurs ON groupes.ProfesseurID = professeurs.ProfesseurID
                  ORDER BY professeurs.Professeur_name"; // Classement par nom de professeur

        $query_run = mysqli_query($connection, $query);

        if (mysqli_num_rows($query_run) > 0) {
            $current_professeur = '';

            while ($row = mysqli_fetch_assoc($query_run)) {
                if ($current_professeur !== $row['Professeur_name']) {
                    $current_professeur = $row['Professeur_name'];
                    ?>
                    <div class="col-12">
                        <h6 class="font-weight-bold text-primary">Professeur : <?php echo htmlspecialchars($current_professeur); ?></h6>
                    </div>
                    <?php
                }

                // Carte du groupe 
                ?>
                <div class="col-12">
                    <a href="marque_abs.php?groupe_id=<?php echo htmlspecialchars($row['GroupeID']); ?>" style="text-decoration: none; color: #000000;">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <span class="font-weight-bold">Groupe : <?php echo htmlspecialchars($row['Groupe_name']); ?></span>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
        } else {
            echo "<div class='col-12'>Aucun groupe trouvé.</div>"; 
        }
        ?>
    </div>
</div>

<?php
include('includes/scripts.php'); 
include('includes/footer.php'); 
?>
