<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
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

  // Delete post
  if($dokter->delete()) {
    echo json_encode(
      array('message' => 'Dokter Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Dokter Not Deleted')
    );
  }
