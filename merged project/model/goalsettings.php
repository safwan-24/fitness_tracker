<?php
require_once "dbconnection.php";

class GoalModel {
    public static function addGoal($goalData) {
        global $conn;

        $stmt = $conn->prepare("INSERT INTO goals (title, type, targetValue, unit, targetDate) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param(
            "ssiss",
            $goalData['title'],
            $goalData['type'],
            $goalData['targetValue'],
            $goalData['unit'],
            $goalData['targetDate']
        );

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $stmt->close();
    }
}
?>
