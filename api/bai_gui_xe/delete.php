<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../../config/db.php');
include_once('../../model/baiguixe.php');

$db = new db();
$connect = $db->connect();
$baiguixe = new BaiGuiXe($connect);

$data = json_decode(file_get_contents("php://input"));
$baiguixe->id = $data->id;

if($baiguixe->delete()){
    echo json_encode(array('message', 'baiguixe Deleted'));
}else{
    echo json_encode(array('message', 'baiguixe not Deleted'));
}


?>