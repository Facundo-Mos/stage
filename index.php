<?php 
include 'config.php'; 

// Consultar pacientes
$res_pazienti = $conn->query("SELECT * FROM pazienti");

// Consultar doctores
$res_dottore = $conn->query("SELECT * FROM dottore");
?>
<!DOCTYPE html>
<html lang="es">
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Médico Pro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

    <nav class="sidebar shadow">
        <div class="logo-section text-center">
            <span class="material-symbols-outlined logo-icon text-info">clinical_notes</span>
        </div>

        <div class="nav-menu">
            <div class="nav-item active" onclick="showPage('dashboard', this)">
                <span class="material-symbols-outlined">dashboard</span> Dashboard
            </div>
            <div class="nav-item" onclick="showPage('pazienti', this)">
                <span class="material-symbols-outlined">group</span> Pazienti
            </div>
            <div class="nav-item" onclick="showPage('professionisti', this)">
                <span class="material-symbols-outlined">badge</span> Professionisti
            </div>
            <div class="nav-item" onclick="showPage('calendario', this)">
                <span class="material-symbols-outlined">calendar_month</span> Calendario
            </div>
        </div>
    </nav>

    <main class="main-content">
        
        <div id="dashboard" class="content-section">
            <div class="container bg-white p-5 shadow-sm rounded-4 text-center">
                <h1 class="display-5 fw-bold text-dark">Dashboard</h1>
                <p class="lead text-muted">Bienvenido al panel de control.</p>
            </div>
        </div>

        <div id="pazienti" class="content-section d-none">
            <div class="container bg-white p-5 shadow-sm rounded-4">
                <h1 class="display-5 fw-bold text-primary">Lista de Pazienti</h1>
                <table class="table table-hover mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $res_pazienti->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['idtable1']; ?></td>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['cognome']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="professionisti" class="content-section d-none">
            <div class="container bg-white p-5 shadow-sm rounded-4">
                <h1 class="display-5 fw-bold text-dark">Professionisti</h1>
                <table class="table table-hover mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Dr. Nome</th>
                            <th>Email</th>
                            <th>Partita IVA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($doc = $res_dottore->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $doc['iddottore']; ?></td>
                            <td><?php echo $doc['nome'] . " " . $doc['cognome']; ?></td>
                            <td><?php echo $doc['email']; ?></td>
                            <td><?php echo $doc['partita_iva']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="calendario" class="content-section d-none">
            <div class="container bg-white p-5 shadow-sm rounded-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="display-5 fw-bold text-dark">Calendario</h1>
                    <h3 class="text-primary">Febrero 2026</h3>
                </div>
                
                <div class="calendar-grid">
                    <div class="day-name">Lun</div><div class="day-name">Mar</div><div class="day-name">Mie</div>
                    <div class="day-name">Jue</div><div class="day-name">Vie</div><div class="day-name">Sab</div><div class="day-name">Dom</div>
                    
                    <div class="day empty"></div><div class="day empty"></div><div class="day empty"></div>
                    <div class="day empty"></div><div class="day empty"></div>
                    <div class="day">1</div><div class="day">2</div>
                    <div class="day">3</div><div class="day">4</div><div class="day">5</div>
                    <div class="day">6</div><div class="day">7</div><div class="day">8</div><div class="day">9</div>
                    <div class="day today">10 <small class="d-block text-primary">• Hoy</small></div>
                    <div class="day">11 <small class="d-block text-danger">• Cita</small></div>
                    <div class="day">12</div><div class="day">13</div><div class="day">14</div><div class="day">15</div>
                </div>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="button.js"></script>
</body>
</html>