<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');


include_once('../../config/db.php');
include_once('../../model/baiguixe.php');

$db = new db();
$connect = $db->connect();
$baiguixe = new BaiGuiXe($connect);
$read = $baiguixe->read();
$num = $read->rowCount();

if($num > 0){
    $baiguixe_array = [];
    $baiguixe_array['baiguixe'] = [];

    while($row = $read->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $baiguixe_item = array(
            'id' => $id,
            'name' => $name
        );

        array_push($baiguixe_array['baiguixe'], $baiguixe_item);
    }

    echo json_encode($baiguixe_array);

}

?>
