<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Conexión a la base de datos
    $servername = '10.35.50.118:3306';
    $username = 'root';
    $password = '12mariadb';
    $dbname = 'aferesis';

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Abrir el archivo CSV
    $archivo = fopen("calendario.csv", "r");

    // Omitir la primera fila (encabezados de columna)
    fgetcsv($archivo);

    // Leer el resto del archivo CSV e insertar los datos en la base de datos
    while (($datos = fgetcsv($archivo, 1000, ",")) !== FALSE) {
        // Preparar la consulta SQL de inserción
        $sql = "INSERT INTO calendario (id_dia, descripcion_dia, id_horario, fecha, hora_inicio, hora_fin)
    VALUES ('{$datos[0]}', '{$datos[1]}', '{$datos[2]}', '{$datos[3]}', '{$datos[4]}', '{$datos[5]}')";

        // Ejecutar la consulta SQL
        if ($conn->query($sql) === TRUE) {
            echo "Datos insertados correctamente.";
        } else {
            echo "Error al insertar datos: " . $conn->error;
        }
    }

    // Cerrar el archivo CSV
    fclose($archivo);

    // Cerrar la conexión a la base de datos
    $conn->close();

    ?>

</body>

</html>