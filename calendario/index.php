<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Calendario Personalizado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="calendario\style.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h2 id="currentDateTitle">Febrero 2026</h2>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary" onclick="changeView('month')">Mes</button>
                    <button type="button" class="btn btn-outline-primary" onclick="changeView('week')">Semana</button>
                    <button type="button" class="btn btn-outline-primary" onclick="changeView('day')">Día</button>
                </div>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#taskModal">+ Nueva Tarea</button>
            </div>
        </div>
        <div class="card-body">
            <div id="calendarContainer" class="calendar-grid"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="taskModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Agregar Actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="taskForm">
                    <div class="mb-3">
                        <label class="form-label">Título de la actividad</label>
                        <input type="text" class="form-control" id="taskTitle" placeholder="Ej: Ir al gimnasio" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="taskDate" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Color de etiqueta</label>
                        <input type="color" class="form-control form-control-color" id="taskColor" value="#3788d8">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Guardar Tarea</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="calendario\script.js"></script>
</body>
</html>