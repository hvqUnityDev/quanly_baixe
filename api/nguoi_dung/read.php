<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');


include_once('../../config/db.php');
include_once('../../model/nguoidung.php');

$db = new db();
$connect = $db->connect();
$nguoidung = new nguoidung($connect);
$read = $nguoidung->read();
$num = $read->rowCount();

if($num > 0){
    $nguoidung_array = [];
    $nguoidung_array['nguoidung'] = [];

    while($row = $read->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $nguoidung_item = array(
            'ID' => $ID,
            'Pass' => $Pass,
            'Ho_Ten' => $Ho_Ten,
            'Que_Quan' => $Que_Quan,
            'So_DT' => $So_DT,
            'Gioi_Tinh' => $Gioi_Tinh,
            'NameRole' => $NameRole,
        );

        array_push($nguoidung_array['nguoidung'], $nguoidung_item);
    }

    echo json_encode($nguoidung_array);

}

?>
