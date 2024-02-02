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
            echo "Connection error " . $th->getMessage();
        }
    }

    public function fetch()
    {
        $data = [];
        $query = "SELECT * FROM etudiants";
        $sql = $this->conn->query($query);

        if ($sql) {
            while ($row = $sql->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function date_range($start_date, $end_date)
    {
        $data = [];

        if (isset($start_date) && isset($end_date)) {
            $query = "SELECT * FROM etudiants WHERE `Date` BETWEEN '$start_date' AND '$end_date'";
            $sql = $this->conn->query($query);

            if ($sql) {
                while ($row = $sql->fetch_assoc()) {
                    $data[] = $row;
                }
            }
        }

        return $data;
    }
}
