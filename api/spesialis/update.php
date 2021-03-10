<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Spesialis.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $spesialis = new Spesialis($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $spesialis->id_spesialis = $data->id_spesialis;
  $spesialis->spesialis = $data->spesialis;
  $spesialis->detail = $data->detail;

  // Update post
  if($spesialis->update()) {
    echo json_encode(
      array('message' => 'Spesialis Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Spesialis not updated')
    );
  }
