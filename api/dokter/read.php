<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Dokter.php';

    $database = new Database();
    $db = $database->connect();

    $dokter = new Dokter($db);

    $result  = $dokter->read();

    $num = $result->rowCount();

    if ($num > 0) {
        $dokter_arr = array();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
                
            $dokter_item = array(
            'id_dokter' => $id_dokter,
            'nama_dokter' => $nama_dokter,
            'jenis_kelamin' => $jenis_kelamin,
            'telphone' => $telphone,
            'alamat' => $alamat,
            'spesialis' => $spesialis,
            'detail' => $detail,
        );
        array_push($dokter_arr, $dokter_item);
        }

        echo json_encode($dokter_arr);
    }else {
        echo json_encode(
        array('message' => 'No Posts Found')
        );
    }
?>