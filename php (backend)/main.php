<?php 
session_start();
class Database {
    private $host = "localhost";
    private $username = "user1";
    private $password = "pass1";
    private $database = "crypto_dbs1";
    private $conn;
    
    public function query($sql) {
        $result = $this->conn->query($sql);
        return $result;
    }

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
        // Validate input
        if (empty($username) || empty($password)) {
            return false; // Input is not valid
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check if the username is already taken
        $checkQuery = "SELECT id FROM users WHERE username = '$username'";
        $checkResult = $this->db->query($checkQuery);

        if ($checkResult && $checkResult->num_rows > 0) {
            return false; // Username already taken
        }

        // Insert the new user into the database
        $insertQuery = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
        $insertResult = $this->db->query($insertQuery);

        return $insertResult; // Returns true on success, false on failure
    }

    public function loginUser($username, $password) {
        // Validate input
        if (empty($username) || empty($password)) {
            return false; // Input is not valid
        }
    
        // Query the database
        $query = "SELECT id, username, password FROM users WHERE username = '$username'";
        $result = $this->db->query($query);
    
        if (!$result || $result->num_rows == 0) {
            return false; // User not found
        }
    
        // Verify password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Passwords match, login successful
    
            // Set user session 
            $_SESSION['username'] = $user['username'];
    
            return true;
        }
    
        return false; // Passwords do not match
    }
    
}

