<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/luotvaocua.php');

$db = new db();
$connect = $db->connect();
$luotvaocua = new luotvaocua($connect);

$data = json_decode(file_get_contents("php://input"));

$luotvaocua->check_out = $data->check_out;

if($luotvaocua->update()){
    echo json_encode(array('message', 'luotvaocua Updated'));
}else{
    echo json_encode(array('message', 'luotvaocua not Updated'));
}

?>