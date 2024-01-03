<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once('../../config/db.php');
include_once('../../model/vexe.php');

$db = new db();
$connect = $db->connect();

$vexe = new vexe($connect);
$vexe->id = isset($_GET['id']) ? $_GET['id'] : die();
$vexe->show();

$vexe_item = array(
    'id_vexe' => $vexe->id,
    'bien_so_xe' => $vexe->bien_so_xe,
    'ngay_dang_ky' => $vexe->ngay_dang_ky,
    'ngay_het_han' => $vexe->ngay_het_han
);

print_r(json_encode($vexe_item));


?>