<?php
    class Dokter {
        private $conn;
        private $table = 'tbl_dokter';

        public $id_dokter;
        public $nama_dokter;
        public $jenis_kelamin;
        public $telphone;
        public $alamat;
        public $id_spesialis;

        public function __construct($db){
            $this->conn = $db;
        }
        public function read(){
            $query = 'SELECT tbl_dokter.id_dokter, tbl_dokter.nama_dokter, tbl_dokter.jenis_kelamin, tbl_dokter.telphone, tbl_dokter.alamat, spesialis.spesialis, spesialis.detail FROM tbl_dokter INNER JOIN spesialis ON tbl_dokter.id_spesialis = spesialis.id_spesialis';

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function readSpesialis(){
            $query = 'SELECT * FROM spesialis';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function create(){
             $query = 'INSERT INTO ' . $this->table . ' SET nama_dokter = :nama_dokter, jenis_kelamin = :jenis_kelamin, telphone = :telphone, alamat = :alamat, id_spesialis = :id_spesialis';

             $stmt = $this->conn->prepare($query);

            $this->nama_dokter = htmlspecialchars(strip_tags($this->nama_dokter));
            $this->jenis_kelamin = htmlspecialchars(strip_tags($this->jenis_kelamin));
            $this->telphone = htmlspecialchars(strip_tags($this->telphone));
            $this->alamat = htmlspecialchars(strip_tags($this->alamat));
            $this->id_spesialis = htmlspecialchars(strip_tags($this->id_spesialis));

            $stmt->bindParam(':nama_dokter', $this->nama_dokter);
            $stmt->bindParam(':jenis_kelamin', $this->jenis_kelamin);
            $stmt->bindParam(':telphone', $this->telphone);
            $stmt->bindParam(':alamat', $this->alamat);
            $stmt->bindParam(':id_spesialis', $this->id_spesialis);

            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        public function update(){
            $query = 'UPDATE ' . $this->table . '
                                SET nama_dokter = :nama_dokter, jenis_kelamin = :jenis_kelamin, telphone = :telphone, alamat = :alamat, id_spesialis = :id_spesialis
                                WHERE id_dokter = :id_dokter';
            $stmt = $this->conn->prepare($query);

            $this->nama_dokter = htmlspecialchars(strip_tags($this->nama_dokter));
            $this->jenis_kelamin = htmlspecialchars(strip_tags($this->jenis_kelamin));
            $this->telphone = htmlspecialchars(strip_tags($this->telphone));
            $this->alamat = htmlspecialchars(strip_tags($this->alamat));
            $this->id_spesialis = htmlspecialchars(strip_tags($this->id_spesialis));
            $this->id_dokter = htmlspecialchars(strip_tags($this->id_dokter));

            $stmt->bindParam(':nama_dokter', $this->nama_dokter);
            $stmt->bindParam(':jenis_kelamin', $this->jenis_kelamin);
            $stmt->bindParam(':telphone', $this->telphone);
            $stmt->bindParam(':alamat', $this->alamat);
            $stmt->bindParam(':id_spesialis', $this->id_spesialis);
            $stmt->bindParam(':id_dokter', $this->id_dokter);

            if($stmt->execute()) {
            return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        public function delete(){
            $query = 'DELETE FROM ' . $this->table . ' WHERE id_dokter = :id_dokter';

            $stmt = $this->conn->prepare($query);

            $this->id_dokter = htmlspecialchars(strip_tags($this->id_dokter));

            $stmt->bindParam(':id_dokter', $this->id_dokter);

            if($stmt->execute()) {
            return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }
?>