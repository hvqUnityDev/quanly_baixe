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
        $query = "SELECT * FROM cauhoi order by ID asc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // show data
    public function show()
    {
        $query = "SELECT * FROM cauhoi where ID=? limit 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->Name = $row["Name"];
        $this->cau_a = $row["cau_a"];
        $this->cau_b = $row["cau_b"];
        $this->cau_c = $row["cau_c"];
        $this->cau_d = $row["cau_d"];
        $this->cau_dung = $row["cau_dung"];
    }

    // create data
    public function create()
    {
        $query = "INSERT INTO cauhoi set Name=:Name, cau_a=:cau_a, cau_b=:cau_b, cau_c=:cau_c, cau_d=:cau_d, cau_dung =:cau_dung";
        $stmt = $this->conn->prepare($query);

        $this->Name = htmlspecialchars(strip_tags($this->Name));
        $this->cau_a = htmlspecialchars(strip_tags($this->cau_a));
        $this->cau_b = htmlspecialchars(strip_tags($this->cau_b));
        $this->cau_c = htmlspecialchars(strip_tags($this->cau_c));
        $this->cau_d = htmlspecialchars(strip_tags($this->cau_d));
        $this->cau_dung = htmlspecialchars(strip_tags($this->cau_dung));

        $stmt->bindParam(":Name", $this->Name);
        $stmt->bindParam(":cau_a", $this->cau_a);
        $stmt->bindParam(":cau_b", $this->cau_b);
        $stmt->bindParam(":cau_c", $this->cau_c);
        $stmt->bindParam(":cau_d", $this->cau_d);
        $stmt->bindParam(":cau_dung", $this->cau_dung);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error %s.\n" . $stmt->error);
        return false;
    }


    // update data
    public function update()
    {
        $query = "update cauhoi set Name=:Name, cau_a=:cau_a, cau_b=:cau_b, cau_c=:cau_c, cau_d=:cau_d, cau_dung =:cau_dung
        where ID =:ID";
        $stmt = $this->conn->prepare($query);

        $this->Name = htmlspecialchars(strip_tags($this->Name));
        $this->cau_a = htmlspecialchars(strip_tags($this->cau_a));
        $this->cau_b = htmlspecialchars(strip_tags($this->cau_b));
        $this->cau_c = htmlspecialchars(strip_tags($this->cau_c));
        $this->cau_d = htmlspecialchars(strip_tags($this->cau_d));
        $this->cau_dung = htmlspecialchars(strip_tags($this->cau_dung));
        $this->ID = htmlspecialchars(strip_tags($this->ID));

        $stmt->bindParam(":Name", $this->Name);
        $stmt->bindParam(":cau_a", $this->cau_a);
        $stmt->bindParam(":cau_b", $this->cau_b);
        $stmt->bindParam(":cau_c", $this->cau_c);
        $stmt->bindParam(":cau_d", $this->cau_d);
        $stmt->bindParam(":cau_dung", $this->cau_dung);
        $stmt->bindParam(":ID", $this->ID);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error %s.\n" . $stmt->error);
        return false;
    }

    // delete data
    public function delete()
    {
        $query = "delete from cauhoi where ID =:ID";
        $stmt = $this->conn->prepare($query);

        $this->ID = htmlspecialchars(strip_tags($this->ID));

        $stmt->bindParam(":ID", $this->ID);
        if ($stmt->execute()) {
            return true;
        }

        printf("Error %s.\n" . $stmt->error);
        return false;
    }
}
