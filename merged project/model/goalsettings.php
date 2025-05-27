<?php
require_once 'dbconnection.php';

class GoalModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createGoal($email, $title, $type, $value, $unit, $date) {
        $stmt = $this->conn->prepare("INSERT INTO goals (user_email, title, type, target_value, unit, target_date) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) return false;
        $stmt->bind_param("sssiss", $email, $title, $type, $value, $unit, $date);
        return $stmt->execute();
    }
}
