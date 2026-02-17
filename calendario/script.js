// Variables globales para controlar la fecha actual y la vista
let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
let currentView = 'month'; // Puede ser 'month', 'week', o 'day'

// Nombres de los meses para el título
const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

// Función principal para renderizar el calendario
function renderCalendar() {
    const container = document.getElementById('calendarContainer');
    const title = document.getElementById('currentDateTitle');
    
    // Limpiamos el contenedor antes de dibujar
    container.innerHTML = '';
    title.innerText = `${monthNames[currentMonth]} ${currentYear}`;

    if (currentView === 'month') {
        renderMonthView(container);
    }
}

function renderMonthView(container) {
    // 1. Calcular el primer día del mes (0 es Domingo, 1 es Lunes...)
    const firstDay = new Date(currentYear, currentMonth, 1).getDay();
    // Ajuste para que la semana empiece en Lunes (opcional)
    const startingPoint = firstDay === 0 ? 6 : firstDay - 1;

    // 2. Calcular cuántos días tiene el mes
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

    // 3. Crear espacios vacíos para los días del mes anterior
    for (let i = 0; i < startingPoint; i++) {
        const emptyDiv = document.createElement('div');
        emptyDiv.classList.add('calendar-day', 'bg-light');
        container.appendChild(emptyDiv);
    }

    // 4. Crear los días del mes actual
    for (let day = 1; day <= daysInMonth; day++) {
        const dayDiv = document.createElement('div');
        dayDiv.classList.add('calendar-day', 'border');
        dayDiv.innerHTML = `<span class="fw-bold">${day}</span><div class="tasks-container" id="tasks-${day}"></div>`;
        
        // Ejemplo de cómo se vería una tarea con su recuadro y cruz
        // Esto luego lo traeremos de la base de datos con PHP
        if(day === 15) { 
            dayDiv.innerHTML += createStaticTask("Estudiar PHP", "#ff5733");
        }

        container.appendChild(dayDiv);
    }
}

// Función auxiliar para crear el HTML de una tarea (con tu requerimiento del recuadro)
function createStaticTask(title, color) {
    return `
        <div class="task-item" style="background-color: ${color}" onclick="toggleTask(this)">
            <div class="task-check"></div>
            <span>${title}</span>
        </div>
    `;
}

// Función para marcar/desmarcar tarea (la cruz)
function toggleTask(element) {
    element.classList.toggle('task-completed');
}

// Función para cambiar la vista (se llama desde los botones del HTML)
function changeView(view) {
    currentView = view;
    renderCalendar();
}

// Ejecutar al cargar la página
document.addEventListener('DOMContentLoaded', renderCalendar);


// Escuchar el envío del formulario
document.getElementById('taskForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Evita que la página se recargue

    const formData = new FormData();
    formData.append('titulo', document.getElementById('taskTitle').value);
    formData.append('fecha', `${currentYear}-${currentMonth + 1}-01`); // Por ahora lo fijamos al día 1 del mes actual
    formData.append('color', document.getElementById('taskColor').value);

    fetch('guardar_tarea.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            alert("¡Tarea guardada!");
            location.reload(); // Recargamos para ver los cambios
        }
    });
});


// Variable para almacenar las tareas que vienen de la DB
let allTasks = [];

async function loadTasks() {
    const response = await fetch('obtener_tareas.php');
    allTasks = await response.json();
    renderCalendar(); // Renderizamos una vez tengamos los datos
}

function renderMonthView(container) {
    const firstDay = new Date(currentYear, currentMonth, 1).getDay();
    const startingPoint = firstDay === 0 ? 6 : firstDay - 1;
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

    // Espacios vacíos
    for (let i = 0; i < startingPoint; i++) {
        container.innerHTML += `<div class="calendar-day bg-light"></div>`;
    }

    // Días del mes
    for (let day = 1; day <= daysInMonth; day++) {
        // Formateamos la fecha actual del bucle para comparar (YYYY-MM-DD)
        const dateString = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        
        let htmlTareas = '';
        
        // Filtramos las tareas que coinciden con este día
        const tasksToday = allTasks.filter(t => t.fecha_inicio.startsWith(dateString));
        
        tasksToday.forEach(task => {
            const isDone = task.completada == 1 ? 'task-completed' : '';
            htmlTareas += `
                <div class="task-item ${isDone}" style="background-color: ${task.color}" onclick="toggleTask(${task.id}, this)">
                    <div class="task-check"></div>
                    <span>${task.titulo}</span>
                </div>`;
        });

        container.innerHTML += `
            <div class="calendar-day border">
                <span class="fw-bold">${day}</span>
                <div class="tasks-list">${htmlTareas}</div>
            </div>`;
    }
}

// Actualizar al inicio
document.addEventListener('DOMContentLoaded', loadTasks);

function toggleTask(id, element) {
    // 1. Detectamos el estado actual basándonos en si tiene la clase CSS
    const estaCompletada = element.classList.contains('task-completed') ? 0 : 1;

    // 2. Preparamos los datos para PHP
    const formData = new FormData();
    formData.append('id', id);
    formData.append('completada', estaCompletada);

    // 3. Enviamos la actualización al servidor
    fetch('actualizar_tarea.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === 'success') {
            // 4. Si el servidor respondió bien, cambiamos el aspecto visual
            element.classList.toggle('task-completed');
        } else {
            alert("Error al actualizar la tarea");
        }
    })
    .catch(error => console.error('Error:', error));
}