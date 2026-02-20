<div class="container mt-4">
    <div class="form-container">
        <div class="d-flex align-items-center mb-4">
            <span class="material-symbols-outlined me-2 text-primary">person_search</span>
            <h2 class="mb-0">Ricerca Pazienti</h2>
        </div>

        <div class="row mb-4">
            <div class="col-md-8">
                <input type="text" id="inputRicerca" class="form-control" placeholder="Cerca per nome o Codice Fiscale...">
            </div>
            <div class="col-md-4">
                <button onclick="eseguiRicerca()" class="btn btn-primary w-100">Cerca</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Codice Fiscale</th>
                        <th>Nominativo</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody id="tabellaRisultati">
                    </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function eseguiRicerca() {
    let query = document.getElementById('inputRicerca').value;
    
    // Chiamata AJAX per cercare i pazienti
    fetch('gestione-pazienti/cerca_pazienti.php?query=' + query)
        .then(response => response.text())
        .then(data => {
            document.getElementById('tabellaRisultati').innerHTML = data;
        })
        .catch(error => console.error('Errore:', error));
}

// Carica tutti i pazienti all'apertura
eseguiRicerca();
</script>