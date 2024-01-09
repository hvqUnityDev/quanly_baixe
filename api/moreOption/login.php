<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$ret = [
    'result' => 'OK',
];
// header('Access-Control-Allow-Origin:*');
// header('Content-Type: application/json');
// header('Access-Control-Allow-Headers:*');
// header('Access-Control-Allow-Methods:GET, POST, OPTIONS, PUT, DELETE');


include_once('../../config/db.php');
include_once('../../model/nguoidung.php');

$db = new db();
$connect = $db->connect();
$nguoidung = new nguoidung($connect);

$data = json_decode(file_get_contents("php://input"));
$nguoidung->ID = $data->ID;
$nguoidung->Pass = $data->Pass;
$nguoidung_array = [];
echo $nguoidung->show();
if($nguoidung->show()){
    $nguoidung_array['data'] = [];
    $nguoidung = array(
        'ID' => $nguoidung->ID,
        'Pass' => $nguoidung->Pass,
        'Ho_Ten' => $nguoidung->Ho_ten,
        'Que_Quan' => $nguoidung->Que_quan,
        'Gioi_Tinh' => $nguoidung->Gioi_tinh,
        'So_DT' => $nguoidung->So_DT,
        'ID_Role' => $nguoidung->ID_Role,
    );

    array_push($luotvaocua_array['data'], $nguoidung);
    $nguoidung_array['message'] = ['complete'];
}else{
    $nguoidung_array['message'] = ['error'];
}

print_r(json_encode($nguoidung_array));
