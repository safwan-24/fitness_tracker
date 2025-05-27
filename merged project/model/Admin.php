<?php
require_once(__DIR__ . '/db.php'); // this path is now reliable

class Admin {
    private $conn;

    public function __construct() {
        $db = new Database(); // This must match the class name in db.php
        $this->conn = $db->getConnection();
    }

    public function login($email, $password) {
    $query = "SELECT * FROM admins WHERE email = ? AND password = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ss", $email, $password); // use hashed password ideally
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->num_rows > 0;
}
}
