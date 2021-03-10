<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
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

  // Set ID to update
  $dokter->id_dokter = $data->id_dokter;

  $dokter->nama_dokter = $data->nama_dokter;
  $dokter->jenis_kelamin = $data->jenis_kelamin;
  $dokter->telphone = $data->telphone;
  $dokter->alamat = $data->alamat;
  $dokter->id_spesialis = $data->id_spesialis;

  // Update post
  if($dokter->update()) {
    echo json_encode(
      array('message' => 'Dokter Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Dokter Not Updated')
    );
  }