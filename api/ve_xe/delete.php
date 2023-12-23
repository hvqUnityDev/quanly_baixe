<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../../config/db.php');
include_once('../../model/vexe.php');

$db = new db();
$connect = $db->connect();
$vexe = new vexe($connect);

$data = json_decode(file_get_contents("php://input"));
$vexe->id = $data->id;

if($vexe->delete()){
    echo json_encode(array('message', 'vexe Deleted'));
}else{
    echo json_encode(array('message', 'vexe not Deleted'));
}


?>