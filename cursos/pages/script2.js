// Simulación de datos obtenidos de la API
const empleados = [
    { nombre: "Juan Pérez", codigo: "001" },
    { nombre: "Ana Gómez", codigo: "002" },
    { nombre: "María Rodríguez", codigo: "003" },
    { nombre: "Carlos Martínez", codigo: "004" },
    { nombre: "Laura Sánchez", codigo: "005" },
    { nombre: "Pedro López", codigo: "006" },
    { nombre: "Sofía Hernández", codigo: "007" },
    { nombre: "Diego García", codigo: "008" },
    { nombre: "Lucía Fernández", codigo: "009" },
    { nombre: "Pablo Díaz", codigo: "010" },
    { nombre: "Carmen Ruiz", codigo: "011" },
    { nombre: "Javier Jiménez", codigo: "012" },
    { nombre: "Isabel Pérez", codigo: "013" },
    { nombre: "Miguel González", codigo: "014" },
    { nombre: "Elena Álvarez", codigo: "015" },
    { nombre: "Rubén Castro", codigo: "016" },
    { nombre: "Lorena Morales", codigo: "017" },
    { nombre: "Alejandro Navarro", codigo: "018" },
    { nombre: "Natalia Ortega", codigo: "019" },
    { nombre: "Adrián Reyes", codigo: "020" }
];


// Función para generar el listado de empleados para el registro de asistencia
function generarListadoAsistencia() {
    const contenedor = document.getElementById('listadoEmpleados');
    empleados.forEach((empleado, indice) => {
        const div = document.createElement('div');
        div.innerHTML = `
            <label>
                <input type="checkbox" name="empleado${indice}" value="${empleado.codigo}" class="checkboxEmpleado">
                ${empleado.nombre} - ${empleado.codigo}
            </label>
        `;
        contenedor.appendChild(div);
    });
}

// Función para obtener la asistencia seleccionada
function obtenerAsistencia() {
    const asistencia = [];
    document.querySelectorAll('.checkboxEmpleado').forEach((checkbox, indice) => {
        if (checkbox.checked) {
            asistencia.push(empleados[indice]);
        }
    });
    return asistencia;
}

// Manejo del envío del formulario para registrar la asistencia
document.getElementById('formularioAsistencia').addEventListener('submit', (event) => {
    event.preventDefault();
    const asistencia = obtenerAsistencia();
    console.log('Asistencia registrada:', asistencia);
    // Aquí puedes enviar la información de la asistencia a través de una llamada AJAX o realizar alguna otra acción necesaria
});

// Llamada a la función para generar el listado al cargar la página
window.onload = generarListadoAsistencia;
