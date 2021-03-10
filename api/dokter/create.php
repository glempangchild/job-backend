<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Dokter.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $dokter = new Dokter($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $dokter->nama_dokter = $data->nama_dokter;
  $dokter->jenis_kelamin = $data->jenis_kelamin;
  $dokter->telphone = $data->telphone;
  $dokter->alamat = $data->alamat;
  $dokter->id_spesialis = $data->id_spesialis;

  // Create post
  if($dokter->create()) {
    echo json_encode(
      array('message' => 'Dokter Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Dokter Not Created')
    );
  }