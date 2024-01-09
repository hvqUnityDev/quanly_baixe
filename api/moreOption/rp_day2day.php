
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once('../../config/db.php');
include_once('../../model/luotvaocua.php');

$db = new db();
$connect = $db->connect();
$luotvaocua = new luotvaocua($connect);

$data = json_decode(file_get_contents("php://input"));
$luotvaocua->check_in = $data->check_in;
$luotvaocua->check_out = $data->check_out;

$read = $luotvaocua->rp_day2day();
$num = $read->rowCount();
$luotvaocua_array = [];

if($num > 0){
    $luotvaocua_array['data'] = [];

    while($row = $read->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $luotvaocua_item = array(
            'id_ve_xe' => $id_ve_xe,
            'id_baigui' => $id_baigui,
            'check_in' => $check_in,
            'idnv_checkin' => $idnv_checkin,
            'check_out' => $check_out,
            'idnv_checkout' => $idnv_checkout,
        );

        array_push($luotvaocua_array['data'], $luotvaocua_item);
    }

    $luotvaocua_array['message'] = ["complete"];
}else{
    $luotvaocua_array['message'] = ["error"];
}

echo json_encode($luotvaocua_array);


?>
