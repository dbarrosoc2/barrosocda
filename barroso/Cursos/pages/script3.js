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


// Función para generar el listado de empleados para el registro de asistencia y generar certificados
function generarListado() {
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

// Función para generar certificados
function generarCertificados() {
    // Aquí puedes implementar la lógica para generar certificados
    console.log('Generando certificados...');
}

// Manejo del click en el botón para generar certificados
document.getElementById('generarCertificados').addEventListener('click', generarCertificados);

// Llamada a la función para generar el listado al cargar la página
window.onload = generarListado;
