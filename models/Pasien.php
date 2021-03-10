<?php
    class Pasien {
        private $conn;
        private $table = 'pasien';

        public $id_pasien;
        public $nama;
        public $alamat;
        public $jenis_kelamin;
        public $id_kota;
        public $tanggal_lahir;

        public function __construct($db){
            $this->conn = $db;
        }
        public function read(){
            $query = 'SELECT pasien.id_pasien, pasien.nama, pasien.alamat, pasien.jenis_kelamin, kabupaten.nama_kota, tanggal_lahir FROM pasien INNER JOIN kabupaten ON pasien.id_kota = kabupaten.id_kota';

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function readProvinsi(){
            $query = 'SELECT * FROM provisni';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function readKota($id){
            $query = 'SELECT kabupaten.id_kota, kabupaten.nama_kota FROM kabupaten INNER JOIN provisni ON kabupaten.id_provinsi = provisni.id_provisni WHERE id_provinsi = '.$id.' ';

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        public function create(){
             $query = 'INSERT INTO ' . $this->table . ' SET nama = :nama, alamat = :alamat, jenis_kelamin = :jenis_kelamin, id_kota = :id_kota, tanggal_lahir = :tanggal_lahir';

             $stmt = $this->conn->prepare($query);

            $this->nama = htmlspecialchars(strip_tags($this->nama));
            $this->alamat = htmlspecialchars(strip_tags($this->alamat));
            $this->jenis_kelamin = htmlspecialchars(strip_tags($this->jenis_kelamin));
            $this->id_kota = htmlspecialchars(strip_tags($this->id_kota));
            $this->tanggal_lahir = htmlspecialchars(strip_tags($this->tanggal_lahir));

            $stmt->bindParam(':nama', $this->nama);
            $stmt->bindParam(':alamat', $this->alamat);
            $stmt->bindParam(':jenis_kelamin', $this->jenis_kelamin);
            $stmt->bindParam(':id_kota', $this->id_kota);
            $stmt->bindParam(':tanggal_lahir', $this->tanggal_lahir);

            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        public function update(){
            $query = 'UPDATE ' . $this->table . '
                                SET nama = :nama, alamat = :alamat, jenis_kelamin = :jenis_kelamin, id_kota = :id_kota, tanggal_lahir = :tanggal_lahir
                                WHERE id_pasien = :id_pasien';
            $stmt = $this->conn->prepare($query);

            $this->nama = htmlspecialchars(strip_tags($this->nama));
            $this->alamat = htmlspecialchars(strip_tags($this->alamat));
            $this->jenis_kelamin = htmlspecialchars(strip_tags($this->jenis_kelamin));
            $this->id_kota = htmlspecialchars(strip_tags($this->id_kota));
            $this->tanggal_lahir = htmlspecialchars(strip_tags($this->tanggal_lahir));
            $this->id_pasien = htmlspecialchars(strip_tags($this->id_pasien));

            $stmt->bindParam(':nama', $this->nama);
            $stmt->bindParam(':alamat', $this->alamat);
            $stmt->bindParam(':jenis_kelamin', $this->jenis_kelamin);
            $stmt->bindParam(':id_kota', $this->id_kota);
            $stmt->bindParam(':tanggal_lahir', $this->tanggal_lahir);
            $stmt->bindParam(':id_pasien', $this->id_pasien);

            if($stmt->execute()) {
            return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        public function delete(){
            $query = 'DELETE FROM ' . $this->table . ' WHERE id_pasien = :id_pasien';

            $stmt = $this->conn->prepare($query);

            $this->id_pasien = htmlspecialchars(strip_tags($this->id_pasien));

            $stmt->bindParam(':id_pasien', $this->id_pasien);

            if($stmt->execute()) {
            return true;
            }

            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }
?>