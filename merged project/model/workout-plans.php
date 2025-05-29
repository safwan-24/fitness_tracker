<?php
require_once "dbconnection.php";

class WorkoutPlan {
    public static function add($data) {
        global $conn;

        $stmt = $conn->prepare("INSERT INTO workplann (program_duration, goal, start_date) VALUES (?, ?, ?)");
        if (!$stmt) {
            error_log("Prepare failed: " . $conn->error);
            return false;
        }

        $stmt->bind_param("iss", $data['program'], $data['goal'], $data['start_date']);

        if (!$stmt->execute()) {
            error_log("Execute failed: " . $stmt->error);
            return false;
        }

        $stmt->close();
        return true;
    }
}
?>
