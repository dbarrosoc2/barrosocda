<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmacion</title>
    <!-- Enlaces a Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 3rem;
        }

        .bg-white {
            background-color: #fff;
        }

        .p-4 {
            padding: 1rem;
        }

        .rounded {
            border-radius: 5px;
        }

        .text-center {
            text-align: center;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .card {
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        .forma {
            color: #0098d4;
            font-weight: bold;
        }


        input[type="radio"] {
            margin-right: 0.5rem;
        }

        /* Modificaciones para el h2 */
        .card-title {
            color: blue;
            /* Color azul */
            font-weight: bold;
            /* Negrita */
            background-color: transparent !important;
            /* Elimina el fondo azul */
            border: none;
            /* Elimina cualquier borde */
            padding: 0;
            /* Elimina el relleno */
            margin-bottom: 0.5rem;
            /* Añade un pequeño espacio inferior */
        }
    </style>
</head>
<?php
// require_once 'conexion.php';
// require_once './Logs.php';
// session_start();
// $logs = new Logger();
// $title = "Confirmacion";
// require '../common/head.php';


$agradecimiento = '';
if (isset($_GET['id'])) {
    $id = trim($_GET['id']);
    $_SESSION['id'] = $id;
    error_reporting(0);
    //echo "*********************************************************************Solicitud par id: " . $id . "*********************************************************************";
    $site = "192.168.177.15";
    $port = 14664;
    set_time_limit(0);
    $fp = fsockopen($site, $port, $errno, $errstr, 10);
    if (!$fp) {
        echo '<div class="alert alert-danger" role="alert">
                    Error al tratar de confirmar la visualizacion. Intentelo mas tarde. <br> Si el error persiste escriba un correo a <a href="mailto:alvar.blanco@salud.madrid.org">alvar.blanco@salud.madrid.org</a>
                </div>';
    } else {
        $myObj = new stdClass();
        $myObj->id = $_SESSION['id'];
        $myObj->visualiza = "SI";
        $myJSON = json_encode($myObj);
        $a = fwrite($fp, $myJSON);
        /*echo '<div class="alert alert-success" role="alert">
        Registrado de visualizacion.
        </div>';*/
    }


    // try {
//     $host = '10.35.50.118:3306';
//     $dbname = 'formacion';
//     $username = 'root';
//     $password = '12mariadb';


    //     try {
//         // Conexión a la base de datos utilizando PDO
//         $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
//         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     } catch (PDOException $e) {
//         // Manejo de errores en caso de fallo en la conexión o consulta
//         echo "Error: en la conexion a la base de datos " . $e->getMessage();
//     }

    //     $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //     // Preparar la consulta SQL
//     $query = "SELECT sc.nombre, sc.apellido1, sc.apellido2, sc.id_curso
//     FROM solicitud_curso sc WHERE sc.id_solicitud = :id_solicitud";

    //     $statement = $pdo->prepare($query);

    //     // Asignar valor a los parámetros
//     $statement->bindParam(':id_solicitud', $id, PDO::PARAM_INT);

    //     // Ejecutar la consulta
//     $statement->execute();

    //     // Obtener el resultado (único registro)
//     $result = $statement->fetch(PDO::FETCH_ASSOC);

    //     // Verificar si se encontró un resultado
//     if ($result) {
//         $nombre = $result['nombre'];
//         $apellido1 = $result['apellido1'];
//         $apellido2 = $result['apellido2'];
//         $idCurso = $result['id_curso'];
//     } else {
//         echo "No se encontraron registros para la ID de solicitud proporcionada.";
//     }
// } catch (PDOException $e) {
//     // Manejo de errores en caso de fallo en la conexión o consulta
//     echo "Error: en la conexion a la base de datos " . $e->getMessage();
// }
// $query2 = "SELECT descripcion_curso, horarios
//          FROM curso
//          WHERE id_curso = $idCurso";
// $result2 = $pdo->query($query2);

    // Verificar si se encontró un resultado
//     if ($result2) {
//         $row = $result2->fetch(PDO::FETCH_ASSOC);
//         if ($row) {
//             $desCurso = $row['descripcion_curso'];
//             $horario = $row['horarios'];
//         } else {
//             echo "No se encontraron registros para el ID de curso proporcionado.";
//         }
//     }
// } else {
//     $id = "desconocido";
}

$asistira = isset($_POST['asistira']) ? $_POST['asistira'] : ''; // Obtener el valor de 'asistira' o establecerlo como cadena vacía si no está presente
$respuesta = trim(htmlspecialchars(stripslashes($asistira)));
if (!empty($respuesta)) {
    error_reporting(0);

    $site = "192.168.177.15";
    $port = 14664;

    set_time_limit(0);
    $fp = fsockopen($site, $port, $errno, $errstr, 10);
    if (!$fp) {
        echo '<div class="alert alert-danger" role="alert">
                Error al tratar de confirmar la asistencia. Intentelo mas tarde. <br> Si el error persiste escriba un correo a <a href="mailto:alvar.blanco@salud.madrid.org">alvar.blanco@salud.madrid.org</a>
            </div>';
    } else {
        $myObj = new stdClass();
        $myObj->id = $_SESSION['id'];
        $myObj->respuesta = $respuesta;
        $myJSON = json_encode($myObj);
        $a = fwrite($fp, $myJSON);
        $agradecimiento = '<div class="alert alert-success" role="alert">Gracias por su respuesta.<br></div>';
        $ocultarOpciones = 'style="display: none;"';
    }

}

?>

<body>
    <div class="container">
        <div class="container-fluid h-100">
            <div class="row align-items-center justify-content-center h-100">
                <div class="col-md-6 text-center bg-white p-4 rounded">
                    <div class="d-flex justify-content-center align-items-center mb-4">
                        <img src="./logo.jpg" alt="logo" class="img-fluid">
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <!-- Título de la tarjeta -->
                            <h2 class="forma">Formación Continuada</h2>
                            <?php echo $agradecimiento; ?>
                            <div class="opciones" <?php echo $ocultarOpciones; ?>>
                                <h4>Confirme si puede asistir o no al curso</h4>
                                <div class="card-body">
                                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="mt-4">
                                        <!-- Opciones de confirmación -->
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="si" name="asistira"
                                                value="si" checked>
                                            <label class="form-check-label" for="si">Si</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="no" name="asistira"
                                                value="no">
                                            <label class="form-check-label" for="no">No</label>
                                        </div>
                                        <!-- Botón de enviar -->
                                        <button type="submit" class="btn btn-primary mt-3">Enviar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>