<?php
include_once '../model/dbconnection.php';

class FoodLogModel {

    public static function addFood($foodData) {
        global $conn;

        $stmt = $conn->prepare("INSERT INTO nutration (name, calories, protein, carbs, fat) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param(
            "siddd",
            $foodData['name'],
            $foodData['calories'],
            $foodData['protein'],
            $foodData['carbs'],
            $foodData['fat']
        );

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
        $stmt->close();
    }

    public static function getAll() {
        global $conn;
        $result = $conn->query("SELECT * FROM nutration ORDER BY id DESC");
        if (!$result) {
            die("Query failed: " . $conn->error);
        }
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
}
?>
