<?php
$host = 'localhost';         
$db   = 'fitness_tracker';   
$user = 'root';            
$pass = '';                  
$port = 3306;                

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
