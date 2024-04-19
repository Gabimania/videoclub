<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$database = "videoclub";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    echo "Conexión fallida: " . $e->getMessage();
}


?>


