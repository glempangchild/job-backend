<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Pasien.php';

    $database = new Database();
    $db = $database->connect();

    $pasien = new Pasien($db);

    $result  = $pasien->readProvinsi();

    $num = $result->rowCount();

    if ($num > 0) {
        $provinsi_arr = array();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
                
            $provinsi_item = array(
            'id_provisni' => $id_provisni,
            'nama_provinsi' => $nama_provinsi,
        );
        array_push($provinsi_arr, $provinsi_item);
        }

        echo json_encode($provinsi_arr);
    }else {
        echo json_encode(
        array('message' => 'NoData')
        );
    }
?>