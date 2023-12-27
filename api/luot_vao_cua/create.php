<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../../config/db.php');
include_once('../../model/luotvaocua.php');

$db = new db();
$connect = $db->connect();
$luotvaocua = new luotvaocua($connect);

$data = json_decode(file_get_contents("php://input"));
$luotvaocua->id_baigui = $data->id_baigui;
$luotvaocua->id_ve_xe = $data->id_ve_xe;
$luotvaocua->check_in = $data->check_in;

if($luotvaocua->create()){
    echo json_encode(array('message', 'luotvaocua Created'));
}else{
    echo json_encode(array('message', 'luotvaocua not Created'));
}


?>