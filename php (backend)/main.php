<?php 
class Database {
    private $host = "localhost";
    private $username = "user1";
    private $password = "pass1";
    private $database = "crypto_dbs1";
    private $conn;


    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);


        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }


    public function closeConnection() {
        $this->conn->close();
    }
}


class User {
    private $db;


    public function __construct(Database $db) {
        $this->db = $db;
    }


    public function registerUser($username, $password) {
        // Implement user registration logic here
    }


    public function loginUser($username, $password) {
        // Implement user login logic here
    }
}

