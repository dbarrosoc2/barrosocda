<?php
session_start();
$title = "ValidacionUser";
require '../common/head.php';
require '../common/headerIniciado.php';
require 'conexion.php';
?>

<body>
    <?php
    /*Bloque para verificar si el usuario esta o no en la base de datos, segun los datos que 
    vienen de la api, si el usuario no esta en la base de datos pero sus datos si que existian 
    en la api de consulta el usuario debera completar los campos faltantes para darse de alta 
    en este registro.*/
    try {
        // Consulta SQL preparada para buscar el DNI en la base de datos
        $consulta = $pdo->prepare("SELECT dni, cod_empleado, nombre, apellidos, email, telefono, password, ultima_conexion 
                              FROM personal 
                              WHERE dni = :dni");
        // DNI a buscar
        $dni = $_SESSION['usuario'];


        $consulta->bindParam(':dni', $dni);

        // Ejecutar la consulta
        $consulta->execute();

        // Obtener el resultado de la consulta
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró alguna fila que coincida con el DNI
        if ($consulta->rowCount() > 0) {
            // Redirige a loginOk por que todo va OK...!
            header("location: inicio.php");
        } else {

            //var_dump($_SESSION["a"]);
            require 'conexion.php';
            try {
                //Preparar los datos de la sesión
                $dni = $_SESSION['usuario'];
                $nombre = $_SESSION['nombre'];
                $apellidos = $_SESSION['apellidos'];
                $email = $_SESSION['email'];
                $telefono = $_SESSION['telefono'];
                $password = $_SESSION['pass']; // Asegúrate de que estás utilizando algún método seguro para almacenar las contraseñas, como el hash con sal.
                $codigo_empleado = $_SESSION['idempleado'];

                // Preparar la consulta SQL
                $consulta = $pdo->prepare("INSERT INTO personal (dni, nombre, apellidos, email, telefono, cod_empleado, ultima_conexion) 
                                    VALUES (?, ?, ?, ?, ?, ?, NOW())");


                // Ejecutar la consulta con los parámetros adecuados
                $consulta->execute([$dni, $nombre, $apellidos, $email, $telefono, $codigo_empleado]);

                // Éxito: redireccionar o mostrar un mensaje de éxito
                header("Location: inicio.php");
                exit();
            } catch (PDOException $e) {
                // Error: manejar la excepción de alguna manera (mostrar un mensaje de error, registrar el error, etc.)
                echo "Error al insertar datos en la base de datos: " . $e->getMessage();
            }

        }

    } catch (PDOException $e) {
        // Manejo de errores en caso de fallo en la conexión o consulta
        echo "Error: " . $e->getMessage();
    }