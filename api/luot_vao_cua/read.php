<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');


include_once('../../config/db.php');
include_once('../../model/luotvaocua.php');

$db = new db();
$connect = $db->connect();
$luotvaocua = new luotvaocua($connect);
$read = $luotvaocua->read();
$num = $read->rowCount();

if($num > 0){
    $luotvaocua_array = [];
    $luotvaocua_array['luotvaocua'] = [];

    while($row = $read->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $luotvaocua_item = array(
            'id_ve_xe' => $id_ve_xe,
            'id_baixe' => $id_baixe,
            'check_in' => $check_in,
            'check_out' => $check_out,
        );

        array_push($luotvaocua_array['luotvaocua'], $luotvaocua_item);
    }

    echo json_encode($luotvaocua_array);

}

?>
