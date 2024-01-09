<?php
class nguoIDung
{
    private $conn;

    //nguoIDung properties
    public $ID;
    public $Pass;
    public $Ho_ten;
    public $Que_quan;
    public $So_DT;
    public $Gioi_tinh;
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
        $query = "SELECT * FROM nguoi_dung where ID=? and Pass=? limit 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID);
        $stmt->bindParam(2, $this->Pass);
        if(!$stmt->execute()){
            return false;
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() == 0){
            return false;
        }
        
        $this->Ho_ten = $row["Ho_ten"];
        $this->Que_quan = $row["Que_quan"];
        $this->So_DT = $row["So_DT"];
        $this->Gioi_tinh = $row["Gioi_tinh"];
        $this->ID_Role = $row["ID_Role"];
        return true;
    }

    // create data
    public function create()
    {
        $query = "INSERT INTO nguoi_dung set Pass=:Pass, Ho_ten=:Ho_ten, Que_quan=:Que_quan, So_DT=:So_DT, Gioi_tinh=:Gioi_tinh, ID_Role =:ID_Role";
        $stmt = $this->conn->prepare($query);

        $this->Pass = htmlspecialchars(strip_tags($this->Pass));
        $this->Ho_ten = htmlspecialchars(strip_tags($this->Ho_ten));
        $this->Que_quan = htmlspecialchars(strip_tags($this->Que_quan));
        $this->So_DT = htmlspecialchars(strip_tags($this->So_DT));
        $this->Gioi_tinh = htmlspecialchars(strip_tags($this->Gioi_tinh));
        $this->ID_Role = htmlspecialchars(strip_tags($this->ID_Role));

        $stmt->bindParam(":Pass", $this->Pass);
        $stmt->bindParam(":Ho_ten", $this->Ho_ten);
        $stmt->bindParam(":Que_quan", $this->Que_quan);
        $stmt->bindParam(":So_DT", $this->So_DT);
        $stmt->bindParam(":Gioi_tinh", $this->Gioi_tinh);
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
        $query = "update nguoi_dung set Pass=:Pass, Ho_ten=:Ho_ten, Que_quan=:Que_quan, So_DT=:So_DT, Gioi_tinh=:Gioi_tinh, ID_Role =:ID_Role
        where ID =:ID";
        $stmt = $this->conn->prepare($query);

        $this->Pass = htmlspecialchars(strip_tags($this->Pass));
        $this->Ho_ten = htmlspecialchars(strip_tags($this->Ho_ten));
        $this->Que_quan = htmlspecialchars(strip_tags($this->Que_quan));
        $this->So_DT = htmlspecialchars(strip_tags($this->So_DT));
        $this->Gioi_tinh = htmlspecialchars(strip_tags($this->Gioi_tinh));
        $this->ID_Role = htmlspecialchars(strip_tags($this->ID_Role));

        $stmt->bindParam(":Pass", $this->Pass);
        $stmt->bindParam(":Ho_ten", $this->Ho_ten);
        $stmt->bindParam(":Que_quan", $this->Que_quan);
        $stmt->bindParam(":So_DT", $this->So_DT);
        $stmt->bindParam(":Gioi_tinh", $this->Gioi_tinh);
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
