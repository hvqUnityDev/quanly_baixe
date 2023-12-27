<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers:*');


include_once('../../config/db.php');
include_once('../../model/luotvaocua.php');

$db = new db();
$connect = $db->connect();
$luotvaocua = new luotvaocua($connect);
if(isset($_GET['id_ve_xe'])){
    $luotvaocua->id_ve_xe = $_GET['id_ve_xe'];
}

if(isset($_GET['id_baigui'])){
    $luotvaocua->id_baigui = $_GET['id_baigui'];
}

$luotvaocua->show();
$luotvaocua_item = array(
    'id_ve_xe' => $luotvaocua->id_ve_xe,
    'id_baigui' => $luotvaocua->id_baigui,
    'check_in' => $luotvaocua->check_in,
    'check_out' => $luotvaocua->check_out
);

print_r(json_encode($luotvaocua_item));

?>