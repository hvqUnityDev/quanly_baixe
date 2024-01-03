<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once('../../config/db.php');
include_once('../../model/baiguixe.php');

$db = new db();
$connect = $db->connect();
$baiguixe = new BaiGuiXe($connect);
$read = $baiguixe->read();
$num = $read->rowCount();

if ($num > 0) {
    $baiguixe_array = [];
    $baiguixe_array['data'] = [];

    while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $baiguixe_item = array(
            'id' => $id,
            'name' => $name
        );

        array_push($baiguixe_array['data'], $baiguixe_item);
    }

    echo json_encode($baiguixe_array);
}
