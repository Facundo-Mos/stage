$(document).ready(function() {
    // Escuchamos el click tanto en links principales como en los del submenú
    $('.nav-link, .accordion-body a').on('click', function(e) {
        e.preventDefault(); // Evita que la página recargue o salte
        
        // Obtenemos el valor de data-page (ej: "gestione-pazietni/gestione")
        var page = $(this).attr('data-page');
        
        if (page) {
            // Mostramos un efecto de carga simple (opcional)
            $("#main-content").fadeOut(100, function() {
                // Cargamos el archivo PHP sumándole la extensión
                $(this).load(page + ".php", function(response, status, xhr) {
                    if (status == "error") {
                        $(this).html("<div class='alert alert-danger'>No se pudo cargar: " + page + ".php</div>");
                    }
                    $(this).fadeIn(100);
                });
            });
        }
    });
});