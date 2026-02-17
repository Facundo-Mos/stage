<?php
require_once 'config.php'; 

// --- LOGICA DI ELABORAZIONE (Resta uguale alla tua, aggiungiamo solo un feedback) ---
$messaggio = "";
$azione = $_POST['azione'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if ($azione === 'inserisci') {
            $sql = "INSERT INTO tabella_utenti (data, codice, nominativo, indirizzo, cap, citta, provincia, nazione, sesso, data_nascita, citta_nascita, codice_fiscale, partita_iva, cellulare1, telefono_casa, email, percentual, utente_collegato, data_modifica, ora_modifica, note, attivo) 
                    VALUES (:data, :codice, :nominativo, :indirizzo, :cap, :citta, :provincia, :nazione, :sesso, :data_nascita, :citta_nascita, :codice_fiscale, :partita_iva, :cellulare1, :telefono_casa, :email, :percentual, :utente_collegato, :data_modifica, :ora_modifica, :note, :attivo)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(mappaDatiPost($_POST));
            $messaggio = "<div class='alert alert-success'>Record inserito con successo!</div>";
        }
        // ... (puoi mantenere qui anche modifica ed elimina come nel tuo codice)
    } catch (Exception $e) {
        $messaggio = "<div class='alert alert-danger'>Errore: " . $e->getMessage() . "</div>";
    }
}

function mappaDatiPost($post) {
    return [
        'data' => $post['data'] ?? date('Y-m-d'),
        'codice' => $post['codice'] ?? null,
        'nominativo' => $post['nominativo'] ?? null,
        'indirizzo' => $post['indirizzo'] ?? null,
        'cap' => $post['cap'] ?? null,
        'citta' => $post['citta'] ?? null,
        'provincia' => $post['provincia'] ?? null,
        'nazione' => $post['nazione'] ?? 'Italia',
        'sesso' => $post['sesso'] ?? null,
        'data_nascita' => $post['data_nascita'] ?? null,
        'citta_nascita' => $post['citta_nascita'] ?? null,
        'codice_fiscale' => $post['codice_fiscale'] ?? null,
        'partita_iva' => $post['partita_iva'] ?? null,
        'cellulare1' => $post['cellulare1'] ?? null,
        'telefono_casa' => $post['telefono_casa'] ?? null,
        'email' => $post['email'] ?? null,
        'percentual' => $post['percentual'] ?? 0,
        'utente_collegato' => $post['utente_collegato'] ?? null,
        'data_modifica' => date('Y-m-d'),
        'ora_modifica' => date('H:i:s'),
        'note' => $post['note'] ?? '',
        'attivo' => $post['attivo'] ?? 1
    ];
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestione Anagrafica Professionisti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="professionisti\style1.css">
</head>
<body>

<div class="container">
    <div class="form-container mx-auto">
        <div class="d-flex align-items-center mb-4">
            <span class="material-symbols-outlined me-2 text-primary" style="font-size: 2rem;">badge</span>
            <h2 class="mb-0">Scheda Anagrafica Professionista</h2>
        </div>

        <?php echo $messaggio; ?>

        <form action="gestione_dati.php" method="POST" class="needs-validation">
            <input type="hidden" name="azione" value="inserisci">
            
            <div class="section-header mt-0">Dati Generali</div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Data Inserimento</label>
                    <input type="date" name="data" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Codice Interno</label>
                    <input type="text" name="codice" class="form-control" placeholder="Es. PRO-2024">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Sesso</label>
                    <select name="sesso" class="form-select">
                        <option value="">Seleziona...</option>
                        <option value="M">Maschio (M)</option>
                        <option value="F">Femmina (F)</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Nominativo Completo</label>
                    <input type="text" name="nominativo" class="form-control" required placeholder="Nome e Cognome o Ragione Sociale">
                </div>

            </div>

            <div class="section-header">Indirizzo e Residenza</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Indirizzo</label>
                    <input type="text" name="indirizzo" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label">CAP</label>
                    <input type="text" name="cap" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Città</label>
                    <input type="text" name="citta" class="form-control">
                </div>
            </div>

            <div class="section-header">Dati Fiscali</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Codice Fiscale</label>
                    <input type="text" name="codice_fiscale" class="form-control text-uppercase">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Partita IVA</label>
                    <input type="text" name="partita_iva" class="form-control">
                </div>
            </div>

            <div class="section-header">Contatti e Note</div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Email Professionale</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Cellulare</label>
                    <input type="tel" name="cellulare1" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Stato Account</label>
                    <select name="attivo" class="form-select">
                        <option value="1">Attivo</option>
                        <option value="0">Disattivo</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Note Aggiuntive</label>
                    <textarea name="note" class="form-control" rows="3"></textarea>
                </div>
            </div>

            <div class="mt-4 d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    Salva Anagrafica
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>