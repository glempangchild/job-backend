<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Pasien.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $pasien = new Pasien($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $pasien->nama = $data->nama;
  $pasien->alamat = $data->alamat;
  $pasien->jenis_kelamin = $data->jenis_kelamin;
  $pasien->id_kota = $data->id_kota;
  $pasien->tanggal_lahir = $data->tanggal_lahir;

  // Create post
  if($pasien->create()) {
    echo json_encode(
      array('message' => 'Post Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Post Not Created')
    );
  }