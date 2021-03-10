<?php
  class Spesialis {
    // DB Stuff
    private $conn;
    private $table = 'spesialis';

    // Properties
    public $id_spesialis;
    public $spesialis;
    public $detail;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get categories
    public function read() {
      // Create query
      $query = 'SELECT
        id_spesialis,
        spesialis,
        detail
      FROM
        ' . $this->table . '
      ORDER BY
        id_spesialis DESC';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Category
  public function read_single(){
    // Create query
    $query = 'SELECT
          id_spesialis,
          spesialis,
          detail
        FROM
          ' . $this->table . '
      WHERE id = ?
      LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->id_spesialis = $row['id_spesialis'];
      $this->spesialis = $row['spesialis'];
  }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
        spesialis = :spesialis, detail = :detail';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->spesialis = htmlspecialchars(strip_tags($this->spesialis));
  $this->detail = htmlspecialchars(strip_tags($this->detail));

  // Bind data
  $stmt-> bindParam(':spesialis', $this->spesialis);
  $stmt-> bindParam(':detail', $this->detail);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Update Category
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
      spesialis = :spesialis, detail = :detail
      WHERE
      id_spesialis = :id_spesialis';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->spesialis = htmlspecialchars(strip_tags($this->spesialis));
  $this->detail = htmlspecialchars(strip_tags($this->detail));
  $this->id_spesialis = htmlspecialchars(strip_tags($this->id_spesialis));

  // Bind data
  $stmt-> bindParam(':spesialis', $this->spesialis);
  $stmt-> bindParam(':detail', $this->detail);
  $stmt-> bindParam(':id_spesialis', $this->id_spesialis);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Delete Category
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id_spesialis = :id_spesialis';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->id_spesialis = htmlspecialchars(strip_tags($this->id_spesialis));

    // Bind Data
    $stmt-> bindParam(':id_spesialis', $this->id_spesialis);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
  }
