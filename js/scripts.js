$(document).ready(function() {
    
    // 1. Función para cargar contenido dinámicamente
    function loadContent(page) {
        if (!page) return;

        $("#main-content").fadeOut(100, function() {
            // Cargamos el archivo PHP. 
            // NOTA: Asegúrate de que tus archivos PHP (como gestione-p.php) NO tengan 
            // etiquetas <html>, <head> o <body>, solo el contenido del div principal.
            $(this).load(page + ".php", function(response, status, xhr) {
                if (status == "error") {
                    $(this).html("<div class='alert alert-danger'>Error al cargar: " + page + "</div>");
                }
                $(this).fadeIn(100);
            });
        });
    }

    // 2. Manejar el Hash Change (Cuando cambia la URL o se hace Refresh)
    function checkHash() {
        // Obtenemos el hash (ej: #calendario/index) y quitamos el #
        var hash = window.location.hash.substring(1);
        if (hash) {
            loadContent(hash);
            // Marcamos el link activo en el sidebar
            $('.nav-link').removeClass('active');
            $('.nav-link[data-page="' + hash + '"]').addClass('active');
        } else {
            // Si no hay hash, cargamos dashboard por defecto
            // loadContent('dashboard'); 
        }
    }

    // Ejecutar al cargar la página
    checkHash();

    // Detectar cambios en la URL (Flechas atrás/adelante del navegador)
    $(window).on('hashchange', checkHash);

    // 3. Interceptar clics en el menú
    $('body').on('click', '.nav-link, .accordion-body a', function(e) {
        e.preventDefault();
        var page = $(this).attr('data-page');
        if (page) {
            // Esto cambia la URL y dispara el evento 'hashchange' automáticamente
            window.location.hash = page; 
        }
    });

    // 4. Manejo de Formularios con AJAX (Para Pacientes y Profesionistas)
    // Esto evita que al guardar se recargue toda la página y te saque de la sección
    $('body').on('submit', 'form.ajax-form', function(e) {
        e.preventDefault();
        var $form = $(this);
        var formData = new FormData(this);

        $.ajax({
            url: $form.attr('action') || window.location.href, // Usa la misma URL si no hay action
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Aquí podrías mostrar una alerta bonita o recargar solo la tabla
                alert("Guardado correctamente");
                // Opcional: limpiar formulario
                $form[0].reset();
            },
            error: function() {
                alert("Hubo un error al guardar.");
            }
        });
    });
});