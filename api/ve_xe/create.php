<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../../config/db.php');
include_once('../../model/vexe.php');

$db = new db();
$connect = $db->connect();
$vexe = new VeXe($connect);

$data = json_decode(file_get_contents("php://input"));
$vexe->id = $data->id;
$vexe->bien_so_xe = $data->bien_so_xe;
$vexe->ngay_dang_ky = $data->ngay_dang_ky;
$vexe->ngay_het_han = $data->ngay_het_han;

if($vexe->create()){
    echo json_encode(array('message', 'vexe created'));
}else{
    echo json_encode(array('message', 'vexe not created'));
}


?>