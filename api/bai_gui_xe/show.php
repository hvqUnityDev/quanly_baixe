<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');


include_once('../../config/db.php');
include_once('../../model/baiguixe.php');

$db = new db();
$connect = $db->connect();
echo "para:" . isset($_GET['id']) . ":". $_GET['id'];
$baiguixe = new BaiGuiXe($connect);
$baiguixe->id = isset($_GET['id']) ? $_GET['id'] : die();
echo $baiguixe->id;

$baiguixe->show();

$baiguixe_item = array(
    'id' => $baiguixe->id,
    'name' => $baiguixe->name,
);

print_r(json_encode($baiguixe_item));

?>