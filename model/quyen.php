<?php
class Quyen
{
    private $conn;

    //Quyen properties
    public $ID;
    public $Name;

    // connect db
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // read data
    public function read()
    {
        $query = "SELECT * FROM quyen order by ID asc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // show data
    public function show()
    {
        $query = "SELECT * FROM quyen where ID=? limit 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->Name = $row["Name"];
        $this->ID = $row["ID"];
    }

    
}
