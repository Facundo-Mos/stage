<?php
require_once 'config.php'; 

// --- LOGICA DI ELABORAZIONE ---
$messaggio = "";
$azione = $_POST['azione'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if ($azione === 'inserisci') {
            // Prepariamo i dati usando la tua funzione
            $dati = mappaDatiPost($_POST);

            // Query alla tabella reale: anagrafica_pazienti
            $sql = "INSERT INTO anagrafica_pazienti (data, codice, nominativo, indirizzo, cap, citta, provincia, nazione, sesso, data_nascita, citta_nascita, codice_fiscale, partita_iva, cellulare1, telefono_casa, email, percentual, utente_collegato, data_modifica, ora_modifica, note, attivo) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $conn->prepare($sql);
            
            if (!$stmt) {
                // Se la tabella o le colonne sono sbagliate, lo vedrai qui
                die("<div class='alert alert-danger'>Errore preparazione query: " . $conn->error . "</div>");
            }

            // "ssssssssssssssssdsssssi" -> 22 caratteri per 22 variabili
            // s=stringa, d=decimale, i=intero
            $stmt->bind_param("ssssssssssssssssdssssi", 
                $dati['data'], $dati['codice'], $dati['nominativo'], $dati['indirizzo'], 
                $dati['cap'], $dati['citta'], $dati['provincia'], $dati['nazione'], 
                $dati['sesso'], $dati['data_nascita'], $dati['citta_nascita'], 
                $dati['codice_fiscale'], $dati['partita_iva'], $dati['cellulare1'], 
                $dati['telefono_casa'], $dati['email'], $dati['percentual'], 
                $dati['utente_collegato'], $dati['data_modifica'], $dati['ora_modifica'], 
                $dati['note'], $dati['attivo']
            );

            // --- BLOCCO DI DEBUG ATTIVO ---
            if ($stmt->execute()) {
                $messaggio = "<div class='alert alert-success'>Paziente inserito con successo!</div>";
            } else {
                // Questo stamperà l'errore specifico (es. Colonna mancante o valore troppo lungo)
                $messaggio = "<div class='alert alert-danger'>ERRORE SQL: " . $stmt->error . "</div>";
                
                // Opzionale: decommenta la riga sotto per vedere tutti i dati che provi a inviare
                // die(print_r($dati)); 
            }
            $stmt->close();
            // ------------------------------
        }
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
        'attivo' => (isset($post['attivo'])) ? intval($post['attivo']) : 1
    ];
}
?>

<div class="container mt-4">
    <div class="form-container mx-auto">
        <div class="d-flex align-items-center mb-4">
            <span class="material-symbols-outlined me-2 text-primary" style="font-size: 2rem;"></span>
            <h2 class="mb-0">Scheda Anagrafica Paziente</h2>
        </div>

        <?php echo $messaggio; ?>

        <form action="" method="POST" class="needs-validation">
            <input type="hidden" name="azione" value="inserisci">
            
            <div class="section-header mt-0">Dati Generali</div>
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Data Inserimento</label>
                    <input type="date" name="data" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Codice Paziente</label>
                    <input type="text" name="codice" class="form-control" placeholder="Es. PAZ-001">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nominativo Completo</label>
                    <input type="text" name="nominativo" class="form-control" required placeholder="Nome e Cognome">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sesso</label>
                    <select name="sesso" class="form-select">
                        <option value="">Seleziona...</option>
                        <option value="M">Maschio</option>
                        <option value="F">Femmina</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Data di Nascita</label>
                    <input type="date" name="data_nascita" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Città di Nascita</label>
                    <input type="text" name="citta_nascita" class="form-control">
                </div>
            </div>

            <div class="section-header">Indirizzo e Residenza</div>
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="form-label">Indirizzo</label>
                    <input type="text" name="indirizzo" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label">CAP</label>
                    <input type="text" name="cap" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Città</label>
                    <input type="text" name="citta" class="form-control">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Prov.</label>
                    <input type="text" name="provincia" class="form-control" maxlength="2">
                </div>
            </div>

            <div class="section-header">Dati Fiscali</div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Codice Fiscale</label>
                    <input type="text" name="codice_fiscale" class="form-control text-uppercase">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Partita IVA (opzionale)</label>
                    <input type="text" name="partita_iva" class="form-control">
                </div>
            </div>

            <div class="section-header">Contatti e Stato</div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Cellulare</label>
                    <input type="tel" name="cellulare1" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Stato Paziente</label>
                    <select name="attivo" class="form-select">
                        <option value="1">Attivo</option>
                        <option value="0">Non Attivo</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Note Cliniche / Osservazioni</label>
                    <textarea name="note" class="form-control" rows="3"></textarea>
                </div>
            </div>

            <div class="mt-4 d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    <span class="material-symbols-outlined align-middle"></span> Salva Scheda Paziente
                </button>
            </div>
        </form>
    </div>
</div>