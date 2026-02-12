<?php 
include 'config.php'; 

// ===============================
// Recuperare l'elenco dei pazienti
// ===============================
$res_pazienti = $conn->query("SELECT * FROM pazienti");

// ===============================
// Recuperare l'elenco dei dottori
// ===============================
$res_dottore = $conn->query("SELECT * FROM dottore");


include 'config.php'; 


// ===============================
// Salvataggio di un nuovo paziente
// ===============================

if (isset($_POST['btn_guardar'])) {
    // Riceviamo i dati
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $data = $_POST['data_nascita'];
    $luogo = $_POST['luogo'];
    $indirizzo = $_POST['indirizzo'];
    $cap = $_POST['cap'];
    $cell = $_POST['cellulare'];
    $cf = $_POST['codice_fiscale'];
    $email = $_POST['email'];

    // Generazione manuale dell'ID (ultimo ID + 1)
    $sql_id = "SELECT MAX(idpazienti) as ultimo FROM pazienti";
    $res_id = $conn->query($sql_id);
    $row_id = $res_id->fetch_assoc();
    $nuevo_id = ($row_id['ultimo']) ? $row_id['ultimo'] + 1 : 1;

    // Query di inserimento nel database
    $query = "INSERT INTO pazienti (idpazienti, nome, cognome, data_di_nascita, luogo_di_nascita, indirizzo_di_residenza, cap, cellulare, codice_fiscale, email) 
                VALUES ($nuevo_id, '$nome', '$cognome', '$data', '$luogo', '$indirizzo', '$cap', '$cell', '$cf', '$email')";

    // Esecuzione della quer
    if ($conn->query($query)) {
        echo "<script>alert('¡Paciente guardado!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// ===============================
// Aggiornare le liste dopo l'inserimento
// ===============================
$res_pazienti = $conn->query("SELECT * FROM pazienti");
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
                
                <h1 class="display-5 fw-bold text-primary mb-4">Gestión de Pacientes</h1>
                
                <div class="card mb-5 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Añadir Nuevo Paciente</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Nome</label>
                                <input type="text" name="nome" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Cognome</label>
                                <input type="text" name="cognome" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Data di Nascita</label>
                                <input type="date" name="data_nascita" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Codice Fiscale</label>
                                <input type="text" name="codice_fiscale" class="form-control" maxlength="16" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Luogo di Nascita</label>
                                <input type="text" name="luogo" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Indirizzo</label>
                                <input type="text" name="indirizzo" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">CAP</label>
                                <input type="text" name="cap" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Cellulare</label>
                                <input type="text" name="cellulare" class="form-control" required>
                            </div>
                            
                            <div class="col-12 text-end">
                                <button type="submit" name="btn_guardar" class="btn btn-success">Guardar Paciente</button>
                            </div>
                        </form>
                    </div>
                </div>

                <hr class="my-5">

                <h2 class="h4 fw-bold mb-3"> Pazienti Registrati</h2>
                <div class="table-responsive">
                    <table class="table table-hover mt-4">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Cognome</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $res_pazienti->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['idpazienti']; ?></td>
                                <td><?php echo $row['nome']; ?></td>
                                <td><?php echo $row['cognome']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
        </div>

            <a href="javascript:void(0)" class="nav-link" onclick="showPage('pazienti', this)">Pazienti</a>`


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