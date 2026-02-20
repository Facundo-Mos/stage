<?php
require_once 'config.php'; // Usa la tua connessione $conn (mysqli)

$search = $_GET['query'] ?? '';
$searchTerm = "%" . $search . "%";

// CAMBIATO: Ora puntiamo alla tabella reale 'anagrafica_pazienti'
$sql = "SELECT * FROM anagrafica_pazienti WHERE nominativo LIKE ? OR codice_fiscale LIKE ? LIMIT 20";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['codice_fiscale'] ?? '') . "</td>
                    <td>" . htmlspecialchars($row['nominativo'] ?? '') . "</td>
                    <td>" . htmlspecialchars($row['email'] ?? '') . "</td>
                    <td>" . htmlspecialchars($row['cellulare1'] ?? '') . "</td>
                    <td>
                        <div class='btn-group'>
                            <button class='btn btn-sm btn-outline-primary' title='Modifica'>
                                <span class='material-symbols-outlined' style='font-size: 18px;'>edit</span>
                            </button>
                            <button class='btn btn-sm btn-outline-danger' title='Elimina'>
                                <span class='material-symbols-outlined' style='font-size: 18px;'>delete</span>
                            </button>
                        </div>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5' class='text-center text-muted'>Nessun paziente trovato per: <strong>" . htmlspecialchars($search) . "</strong></td></tr>";
    }
    $stmt->close();
} else {
    // Questo ti aiuterà se ci sono colonne scritte male
    echo "<tr><td colspan='5' class='text-center text-danger'>Errore nella query: " . $conn->error . "</td></tr>";
}
?>