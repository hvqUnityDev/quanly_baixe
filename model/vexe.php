<?php
class VeXe
{
    private $conn;

    //question properties
    public $id;
    public $bien_so_xe;
    public $ngay_dang_ky;
    public $ngay_het_han;

    // connect db
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // read data
    public function read()
    {
        $query = "SELECT * FROM ve_xe order by id asc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // show data
    public function show()
    {
        $query = "SELECT * FROM ve_xe where id=? limit 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->bien_so_xe = $row["bien_so_xe"];
        $this->ngay_dang_ky = $row["ngay_dang_ky"];
        $this->ngay_het_han = $row["ngay_het_han"];
    }

    // create data
    public function create()
    {
        $query = "INSERT INTO ve_xe set id=:id, bien_so_xe=:bien_so_xe, ngay_dang_ky=:ngay_dang_ky, ngay_het_han=:ngay_het_han";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->bien_so_xe = htmlspecialchars(strip_tags($this->bien_so_xe));
        $this->ngay_dang_ky = htmlspecialchars(strip_tags($this->ngay_dang_ky));
        $this->ngay_het_han = htmlspecialchars(strip_tags($this->ngay_het_han));

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":bien_so_xe", $this->bien_so_xe);
        $stmt->bindParam(":ngay_dang_ky", $this->ngay_dang_ky);
        $stmt->bindParam(":ngay_het_han", $this->ngay_het_han);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error %s.\n" . $stmt->error);
        return false;
    }


    // update data
    public function update()
    {
        $query = "update ve_xe set bien_so_xe=:bien_so_xe, ngay_dang_ky=:ngay_dang_ky, ngay_het_han=:ngay_het_han
        where id =:id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->bien_so_xe = htmlspecialchars(strip_tags($this->bien_so_xe));
        $this->ngay_dang_ky = htmlspecialchars(strip_tags($this->ngay_dang_ky));
        $this->ngay_het_han = htmlspecialchars(strip_tags($this->ngay_het_han));
        

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":bien_so_xe", $this->bien_so_xe);
        $stmt->bindParam(":ngay_dang_ky", $this->ngay_dang_ky);
        $stmt->bindParam(":ngay_het_han", $this->ngay_het_han);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error %s.\n" . $stmt->error);
        return false;
    }

    // delete data
    public function delete()
    {
        $query = "delete from ve_xe where id =:id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":id", $this->id);
        if ($stmt->execute()) {
            return true;
        }

        printf("Error %s.\n" . $stmt->error);
        return false;
    }
}
