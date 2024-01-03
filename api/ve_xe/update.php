<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once('../../config/db.php');
include_once('../../model/vexe.php');

$db = new db();
$connect = $db->connect();
$vexe = new vexe($connect);

$data = json_decode(file_get_contents("php://input"));

$vexe->id = $data->id;
$vexe->id_nguoidung = $data->id_nguoidung;
$vexe->Ho_ten = $data->Ho_ten;
$vexe->bien_so_xe = $data->bien_so_xe;
$vexe->ngay_dang_ky = $data->ngay_dang_ky;
$vexe->ngay_het_han = $data->ngay_het_han;
if($vexe->update()){
    echo json_encode(array('message', 'vexe Updated'));
}else{
    echo json_encode(array('message', 'vexe not Updated'));
}


?>