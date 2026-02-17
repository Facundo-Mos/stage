<?php
include 'config.php';

// Verificamos que los datos lleguen por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'] ?? '';
    $fecha = $_POST['fecha'];
    $color = $_POST['color'];

    // Preparamos la consulta SQL para evitar inyecciones
    $sql = "INSERT INTO tareas (titulo, descripcion, fecha_inicio, color) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$titulo, $descripcion, $fecha, $color])) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
}
?>