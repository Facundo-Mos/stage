<?php
$host = "ramsoft.ddns.net";
$user = "facundo"; 
$pass = "Abc458765Bca!";     
$db   = "a_fisioq"; // 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}