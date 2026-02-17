<?php
include 'config.php';

// Consultamos todas las tareas
$sql = "SELECT id, titulo, fecha_inicio, color, completada FROM tareas";
$stmt = $pdo->query($sql);
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Enviamos los datos a JavaScript
header('Content-Type: application/json');
echo json_encode($tareas);
?>