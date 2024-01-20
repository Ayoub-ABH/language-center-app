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
        
        //$query = "SELECT intervention.*, comptoir.Comptoirs  as ComptoirName from intervention, comptoir WHERE intervention.ComptoirID = comptoir.ComptoirID AND intervention.VilleID = $villeID";
        $query = "SELECT Etudiant_name FROM etudiants ";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    /*public function date_range($start_date, $end_date)
    {
       
        $data = [];

        if (isset($start_date) && isset($end_date)) {
            $query = "SELECT etudiants.*, Groupe_name.groupes as Groupe_name from etudiants, groupes WHERE etudiant_name.GroupeID = Groupe_name.GroupeID";
            if ($sql = $this->conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }
        }

        return $data;
    }
}*/