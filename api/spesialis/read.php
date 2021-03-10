<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Spesialis.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $spesialis = new Spesialis($db);

  // Category read query
  $result = $spesialis->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $sep_arr = array();
        $sep_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $sep_item = array(
            'id_spesialis' => $id_spesialis,
            'spesialis' => $spesialis,
            'detail' => $detail,
          );

          // Push to "data"
          array_push($sep_arr['data'], $sep_item);
        }

        // Turn to JSON & output
        echo json_encode($sep_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No Categories Found')
        );
  }
