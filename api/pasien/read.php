<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Pasien.php';

    $database = new Database();
    $db = $database->connect();

    $pasien = new Pasien($db);

    $result  = $pasien->read();

    $num = $result->rowCount();

    if ($num > 0) {
        $pasien_arr = array();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
                
            $pasien_item = array(
            'id_pasien' => $id_pasien,
            'nama' => $nama,
            'alamat' => $alamat,
            'jenis_kelamin' => $jenis_kelamin,
            'nama_kota' => $nama_kota,
            'tanggal_lahir' => $tanggal_lahir
        );
        array_push($pasien_arr, $pasien_item);
        }

        echo json_encode($pasien_arr);
    }else {
        echo json_encode(
        array('message' => 'No Posts Found')
        );
    }
?>