<?php
class LuotVaoCua
{
    private $conn;

    //question properties
    public $id_baigui;
    public $id_ve_xe;
    public $check_in;
    public $check_out;

    // connect db
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // read data
    public function read()
    {
        $query = "SELECT * FROM luot_vao_cua order by check_in desc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // show data
    public function show()
    {
        $query = "";
        if($this->id_ve_xe == ""){
            $query = "SELECT * FROM luot_vao_cua where id_baigui=? ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id_baigui);

        }else if($this->id_baigui == ""){
            $query = "SELECT * FROM luot_vao_cua where id_ve_xe =? ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id_ve_xe);

        }else if($this->id_baigui != "" && $this->id_ve_xe != ""){
            $query = "SELECT * FROM luot_vao_cua where id_ve_xe =? && id_baigui =? ";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id_ve_xe);
            $stmt->bindParam(2, $this->id_baigui);
        }

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->check_in = $row["check_in"];
        $this->check_out = $row["check_out"];
    }

    // create data
    public function create()
    {
        $query = "INSERT INTO luot_vao_cua set id_baigui=:id_baigui, id_ve_xe=:id_ve_xe, check_in=:check_in, check_out=:check_out";
        $stmt = $this->conn->prepare($query);

        $this->id_baigui = htmlspecialchars(strip_tags($this->id_baigui));
        $this->id_ve_xe = htmlspecialchars(strip_tags($this->id_ve_xe));
        $this->check_in = htmlspecialchars(strip_tags($this->check_in));
        $this->check_out = htmlspecialchars(strip_tags($this->check_out));

        $stmt->bindParam(":id_baigui", $this->id_baigui);
        $stmt->bindParam(":id_ve_xe", $this->id_ve_xe);
        $stmt->bindParam(":check_in", $this->check_in);
        $stmt->bindParam(":check_out", $this->check_out);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error %s.\n" . $stmt->error);
        return false;
    }


    // update data
    public function update()
    {
        $query = "update luot_vao_cua set check_out=:checkout where id_baigui =:id_baigui and id_ve_xe=:id_ve_xe";
        $stmt = $this->conn->prepare($query);

        $this->id_baigui = htmlspecialchars(strip_tags($this->id_baigui));
        $this->id_ve_xe = htmlspecialchars(strip_tags($this->id_ve_xe));
        $this->check_out = htmlspecialchars(strip_tags($this->check_out));

        $stmt->bindParam(":id_baigui", $this->id_baigui);
        $stmt->bindParam(":id_ve_xe", $this->id_ve_xe);
        $stmt->bindParam(":check_out", $this->check_out);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error %s.\n" . $stmt->error);
        return false;
    }
}
