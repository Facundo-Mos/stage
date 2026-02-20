<div class="bg-dark border-right text-white" id="sidebar-wrapper" style="min-width: 250px; min-height: 100vh;">
    <div class="sidebar-heading p-3 fs-4 text-center">Admin Panel</div>
    <div class="list-group list-group-flush px-3">
        
        <a href="#" class="list-group-item list-group-item-action bg-dark text-white nav-link" data-page="dashboard">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        
        <div class="accordion accordion-flush bg-dark" id="accordionSidebar">
            
            <div class="accordion-item bg-dark border-0">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed bg-dark text-white shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePacientes">
                        <i class="bi bi-person-heart me-2"></i> Pacientes
                    </button>
                </h2>
                <div id="collapsePacientes" class="accordion-collapse collapse" data-bs-parent="#accordionSidebar">
                    <div class="accordion-body p-0 ps-4">
                        <a href="#" class="nav-link text-white-50 py-2" data-page="gestione-pazienti\gestione-p">Gestione Pazienti</a>
                        <a href="#" class="nav-link text-white-50 py-2" data-page="gestione-pazienti\index_pazienti">Lista dei Pazienti</a>
                    </div>
                </div>
            </div>

            <div class="accordion-item bg-dark border-0">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed bg-dark text-white shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProfesionales">
                        <i class="bi bi-person-badge me-2"></i> Professionisti
                    </button>
                </h2>
                <div id="collapseProfesionales" class="accordion-collapse collapse" data-bs-parent="#accordionSidebar">
                    <div class="accordion-body p-0 ps-4">
                        <a href="#" class="nav-link text-white-50 py-2" data-page="professionisti\gestione-p">Gestione Professinisti</a>
                        <a href="#" class="nav-link text-white-50 py-2" data-page="lista_profesionales">Lista dei Professionisti</a>
                    </div>
                </div>
            </div>

        </div> <a href="#" class="list-group-item list-group-item-action bg-dark text-white nav-link" data-page="calendario\index">
            <i class="bi bi-calendar3 me-2"></i> Calendario
        </a>
    </div>
</div>