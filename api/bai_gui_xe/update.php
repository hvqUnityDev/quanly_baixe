<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/baiguixe.php');

$db = new db();
$connect = $db->connect();
$baiguixe = new BaiGuiXe($connect);

$data = json_decode(file_get_contents("php://input"));

$baiguixe->id = $data->id;
$baiguixe->name = $data->name;

if($baiguixe->update()){
    echo json_encode(array('message', 'baiguixe Updated'));
}else{
    echo json_encode(array('message', 'baiguixe not Updated'));
}

?>