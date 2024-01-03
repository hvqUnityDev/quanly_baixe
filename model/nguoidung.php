<?php
class nguoIDung
{
    private $conn;

    //nguoIDung properties
    public $ID;
    public $Pass;
    public $Ho_Ten;
    public $Que_Quan;
    public $So_DT;
    public $Gioi_Tinh;
    public $ID_Role;

    // connect db
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // read data
    public function read()
    {
        $query = "SELECT n.id, n.Pass, n.Ho_ten, n.Que_quan, n.So_DT, n.Gioi_tinh, q.Name FROM nguoi_dung as n join quyen as q on n.ID_Role = q.ID";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // show data
    public function show()
    {
        $query = "SELECT * FROM nguoi_dung where ID=? limit 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->Pass = $row["Pass"];
        $this->Ho_Ten = $row["Ho_Ten"];
        $this->Que_Quan = $row["Que_Quan"];
        $this->So_DT = $row["So_DT"];
        $this->Gioi_Tinh = $row["Gioi_Tinh"];
        $this->ID_Role = $row["ID_Role"];
    }

    // create data
    public function create()
    {
        $query = "INSERT INTO nguoi_dung set Pass=:Pass, Ho_Ten=:Ho_Ten, Que_Quan=:Que_Quan, So_DT=:So_DT, Gioi_Tinh=:Gioi_Tinh, ID_Role =:ID_Role";
        $stmt = $this->conn->prepare($query);

        $this->Pass = htmlspecialchars(strip_tags($this->Pass));
        $this->Ho_Ten = htmlspecialchars(strip_tags($this->Ho_Ten));
        $this->Que_Quan = htmlspecialchars(strip_tags($this->Que_Quan));
        $this->So_DT = htmlspecialchars(strip_tags($this->So_DT));
        $this->Gioi_Tinh = htmlspecialchars(strip_tags($this->Gioi_Tinh));
        $this->ID_Role = htmlspecialchars(strip_tags($this->ID_Role));

        $stmt->bindParam(":Pass", $this->Pass);
        $stmt->bindParam(":Ho_Ten", $this->Ho_Ten);
        $stmt->bindParam(":Que_Quan", $this->Que_Quan);
        $stmt->bindParam(":So_DT", $this->So_DT);
        $stmt->bindParam(":Gioi_Tinh", $this->Gioi_Tinh);
        $stmt->bindParam(":ID_Role", $this->ID_Role);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error %s.\n" . $stmt->error);
        return false;
    }


    // update data
    public function update()
    {
        $query = "update nguoi_dung set Pass=:Pass, Ho_Ten=:Ho_Ten, Que_Quan=:Que_Quan, So_DT=:So_DT, Gioi_Tinh=:Gioi_Tinh, ID_Role =:ID_Role
        where ID =:ID";
        $stmt = $this->conn->prepare($query);

        $this->Pass = htmlspecialchars(strip_tags($this->Pass));
        $this->Ho_Ten = htmlspecialchars(strip_tags($this->Ho_Ten));
        $this->Que_Quan = htmlspecialchars(strip_tags($this->Que_Quan));
        $this->So_DT = htmlspecialchars(strip_tags($this->So_DT));
        $this->Gioi_Tinh = htmlspecialchars(strip_tags($this->Gioi_Tinh));
        $this->ID_Role = htmlspecialchars(strip_tags($this->ID_Role));

        $stmt->bindParam(":Pass", $this->Pass);
        $stmt->bindParam(":Ho_Ten", $this->Ho_Ten);
        $stmt->bindParam(":Que_Quan", $this->Que_Quan);
        $stmt->bindParam(":So_DT", $this->So_DT);
        $stmt->bindParam(":Gioi_Tinh", $this->Gioi_Tinh);
        $stmt->bindParam(":ID_Role", $this->ID_Role);
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
        $query = "delete from nguoi_dung where ID =:ID";
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
