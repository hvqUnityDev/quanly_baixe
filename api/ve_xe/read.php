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
$read = $vexe->read();
$num = $read->rowCount();

if($num > 0){
    $vexe_array = [];
    $vexe_array['vexe'] = [];

    while($row = $read->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $vexe_item = array(
            'id' => $id,
            'id_nguoidung' => $id_nguoidung,
            'Ho_ten' => $Ho_ten,
            'bien_so_xe' => $bien_so_xe,
            'ngay_dang_ky' => $ngay_dang_ky,
            'ngay_het_han' => $ngay_het_han
        );

        array_push($vexe_array['vexe'], $vexe_item);
    }

    echo json_encode($vexe_array);

}

?>
