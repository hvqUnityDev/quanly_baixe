<?php
class BaiGuiXe
{
    private $conn;

    //question properties
    public $id;
    public $name;

    // connect db
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // read data
    public function read()
    {
        $query = "SELECT * FROM bai_gui_xe order by id asc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // show data
    public function show()
    {
        $query = "SELECT * FROM bai_gui_xe where id=? limit 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row["id"];
        $this->name = $row["name"];
    }

    // create data
    public function create()
    {
        $query = "INSERT INTO bai_gui_xe set id=:id, name=:name";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error %s.\n" . $stmt->error);
        return false;
    }


    // update data
    public function update()
    {
        $query = "update bai_gui_xe set name =:name where id =:id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error %s.\n" . $stmt->error);
        return false;
    }

    // delete data
    public function delete()
    {
        $query = "delete from bai_gui_xe where id =:id";
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
