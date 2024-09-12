<?php

// Datos de conexión a la base de datos
$host = 'db5015530601.hosting-data.io';
$dbname = 'dbs12981714';
$username = 'dbu5255480';
$password = 'umYNiq_3h8bi:VN';


try {
    // Conexión a la base de datos utilizando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Manejo de errores en caso de fallo en la conexión o consulta
    echo "Error: en la conexion a la base de datos " . $e->getMessage();
}