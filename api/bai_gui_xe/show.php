<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once('../../config/db.php');
include_once('../../model/baiguixe.php');

$db = new db();
$connect = $db->connect();
$baiguixe = new BaiGuiXe($connect);
$baiguixe->id = isset($_GET['id']) ? $_GET['id'] : die();

$baiguixe->show();
$baiguixe_array = [];
$baiguixe_array['data'] = [];
$baiguixe_item = array(
    'id' => $baiguixe->id,
    'name' => $baiguixe->name,
);
array_push($baiguixe_array['data'], $baiguixe_item);

print_r(json_encode($baiguixe_array));
