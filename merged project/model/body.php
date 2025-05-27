<?php
function getDBConnection() {
    $host = 'localhost';
    $dbname = 'fitnesstracker';
    $username = 'root';             
    $password = '';   

    try {
        return new PDO("mysql:host=$host;dbname=$dbname", $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (PDOException $e) {
        error_log("DB Connection Error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => 'DB connection failed: ' . $e->getMessage()]);
        exit;
    }
}

function saveBodyMeasurement($email, $weight, $waist, $chest) {
    $db = getDBConnection();
    if (!$db) return false;

    try {
        $stmt = $db->prepare("INSERT INTO body (email, weight, waist, chest) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$email, $weight, $waist, $chest]);
    } catch (PDOException $e) {
        error_log("Insert Error: " . $e->getMessage());
        return false;
    }
}
