<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Pasien.php';


    $data = json_decode(file_get_contents("php://input"));
    $id = $data->id_provinsi;
    $database = new Database();
    $db = $database->connect();

    $kota = new Pasien($db);

    $result  = $kota->readKota($id);

    $num = $result->rowCount();

    if ($num > 0) {
        $kota_arr = array();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
                
            $kota_item = array(
            'id_kota' => $id_kota,
            'nama_kota' => $nama_kota,
        );
        array_push($kota_arr, $kota_item);
        }

        echo json_encode($kota_arr);
    }else {
        echo json_encode(
        array('message' => 'No Posts Found')
        );
    }
?>