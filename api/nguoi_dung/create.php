<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../../config/db.php');
include_once('../../model/nguoidung.php');

$db = new db();
$connect = $db->connect();
$nguoidung = new nguoidung($connect);

$data = json_decode(file_get_contents("php://input"));
$nguoidung->ID = $data->ID;
$nguoidung->Pass = $data->Pass;
$nguoidung->Ho_Ten = $data->Ho_Ten;
$nguoidung->Que_Quan = $data->Que_Quan;
$nguoidung->So_DT = $data->So_DT;
$nguoidung->Gioi_Tinh = $data->Gioi_Tinh;
$nguoidung->ID_Role = $data->ID_Role;

if($nguoidung->create()){
    echo json_encode(array('message', 'nguoidung Created'));
}else{
    echo json_encode(array('message', 'nguoidung not Created'));
}


?>