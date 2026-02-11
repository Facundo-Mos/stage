function showPage(pageId, element) {
    // 1. Ocultar todas las secciones
    const sections = document.querySelectorAll('.content-section');
    sections.forEach(section => {
        section.classList.add('d-none');
    });

    // 2. Mostrar la sección seleccionada
    const target = document.getElementById(pageId);
    if (target) {
        target.classList.remove('d-none');
    }

    // 3. Gestionar clase activa en el menú
    const items = document.querySelectorAll('.nav-item');
    items.forEach(item => item.classList.remove('active'));
    element.classList.add('active');
}
