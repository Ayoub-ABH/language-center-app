
<?php
session_start();
class Model
{
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "deutsch_school";
    private $conn;


    public function __construct()
    {
        try {
            $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
        } catch (\Throwable $th) {
            //throw $th;
            echo "Connection error " . $th->getMessage();
        }
    }

     public function fetch()
    {
        
        $data = [];
        
        $query = "SELECT etudiants.*, Etudiant_name.etudiants  as ComptoirName from etudiants ";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function date_range($start_date, $end_date,$systeme)
    {
        $villeID = $_SESSION['villeID'];
        $data = [];

        if (isset($start_date) && isset($end_date)  && isset($systeme)) {
            $query = "SELECT intervention.*, comptoir.Comptoirs  as ComptoirName from intervention, comptoir WHERE intervention.ComptoirID = comptoir.ComptoirID AND  `Date` BETWEEN '$start_date' AND '$end_date' AND intervention.Type_intervention = '$systeme' AND intervention.VilleID =  $villeID";
            if ($sql = $this->conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }
        }

        return $data;
    }
}