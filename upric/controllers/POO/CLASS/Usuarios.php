<?php

class Usuario
{
    private $conn;
    private $table_name = 'usuario';

    // Propiedades del paciente
    private $id_usuario;
    private $nombre;
    private $apellidos;
    private $dni;
    private $usuario;
    private $permiso;
    private $num_colegiado;


    public function __construct()
    {
        $this->conn = require "../../controllers/database-connection.php";
    }

    public function listarUsuarios()
    {
        $query = "SELECT id_usuario, dni, nombre, apellidos, usuario FROM usuario";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function mostrarUsuarios()
    {
        // Usar el método leerPruebas para obtener todas los usuarios
        $stmt = $this->leerUsuarios();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // Método para leer las pruebas
    public function leerUsuarios()
    {
        $query = "SELECT id_usuario, nombre, apellidos, dni, usuario, permiso, num_colegiado FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    
    public function verificarPermisos($idUsuario, $tipoContenido) {
        switch ($idUsuario) {
            case 4:
                // Superusuario tiene acceso a todo
                return true;
            case 3:
                // Bioquímico tiene acceso a contenido específico
                return in_array($tipoContenido, ['1', '2', '3']);
            case 2:
                // Asistente tiene acceso a contenido limitado
                return in_array($tipoContenido, ['1', '2']);
            case 1:
                // Administrativo tiene acceso restringido
                return $tipoContenido == '1';
            default:
                $this->mostrarError();
                return false;
        }
    
    }

    public function obtenerUsuarioPorId($idUsuario)
    {
        try {
            $query = "SELECT id_usuario, nombre, apellidos, dni, permiso, num_colegiado, usuario FROM " . $this->table_name . " WHERE id_usuario = :idUsuario";
            $stmt = $this->conn->prepare($query);

            // Vinculación del parámetro
            $stmt->bindParam(":idUsuario", $idUsuario);

            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage() . "<br>");
        }
    }

    public function listarUsuarioParaSelect()
    {
        try {
            $queryPac = "SELECT id_usuario, dni, nombre, apellidos, usuario FROM usuario";
            $stmtPac = $this->conn->prepare($queryPac);
            $stmtPac->execute();

            $opcionesPacHTML = "<option value=''>Seleccionar paciente</option>"; // Agregar opción por defecto en blanco

            while ($filaPac = $stmtPac->fetch(PDO::FETCH_ASSOC)) {
                // Crear la opción para el select con los datos de cada paciente
                $opcionesPacHTML .= "<option value='" . $filaPac['dni'] . "'>" . $filaPac['usuario'] . " " . $filaPac['apellidos'] . " " . $filaPac['nombre'] . "</option>";
            }

            return $opcionesPacHTML;
        } catch (PDOException $e) {
            // Manejo de excepciones en caso de error de base de datos
            echo "Error al listar pacientes: " . $e->getMessage();
            return ""; // Devolver cadena vacía en caso de error
        }
    }


    // Método para borrar un paciente
    public function borrarUsuario($id_usuario)
    {
        if (!empty($id_usuario)) {
            $id_usuario = limpiar($id_usuario);
            try {
                session_start();
                $queryInfo = "SELECT id_usuario, nombre, apellidos FROM {$this->table_name} WHERE id_usuario = :id";
                $stmtInfo = $this->conn->prepare($queryInfo);
                $stmtInfo->bindParam(':id', $id_usuario);
                $stmtInfo->execute();
                $datos = $stmtInfo->fetch(PDO::FETCH_ASSOC);

                if (!$datos) {
                    $_SESSION['error1'] = "No se encontró la prueba con el ID especificado.";
                } else {
                    $query = "DELETE FROM {$this->table_name} WHERE id_usuario = :id_usuario";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(":id_usuario", $id_usuario);
                    $resultado = $stmt->execute();
                    if ($resultado) {

                        echo "deleted";
                        exit();
                    } else {
                        // Mensaje de error
                        $_SESSION['error'] = "<div class='alert alert-danger' role='alert'>Error al eliminar el registro.</div>";
                        header("Location: ../../admin/usuarios/consultars.php");
                    }
                }
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage() . "<br>");
            }
        }
    }

    public function consultar($busqueda)
    {
        try {
            $query = "SELECT id_usuario, dni, nombre, apellidos, usuario, permiso, num_colegiado
                  FROM $this->table_name 
                  WHERE id_usuario = :busqueda 
                  OR dni = :busqueda 
                  OR nombre LIKE CONCAT('%', :busqueda, '%')
                  OR apellidos LIKE CONCAT('%', :busqueda, '%')
                  OR usuario = :busqueda";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':busqueda', $busqueda);
            $stmt->execute();

            echo "<div class='container'>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='alert alert-success mensaje' role='alert'>  
        Usuario encontrado con los siguientes datos:<br>
        ID: " . $row['id_usuario'] . "<br>
        DNI: " . $row['dni'] . "<br>
        Nombre: " . $row['nombre'] . "<br>
        Apellido: " . $row['apellidos'] . " <br>
        Usuario: " . $row['usuario'] . "<br>
        Permiso: " . $row['Permiso'] . "<br>
        Numero Colegiado: " . $row['num_colegiado'] . "<br>
        

        <form method='POST' action='modificar.php'>
            <input type='hidden' name='id_paciente' value='" . $row['id_usuario'] . "'>
            <button type='submit' name='accion' value='editar' class='btn btn-primary'>Editar Paciente</button>
        </form>
        <form method='POST' action='../../controllers/POO/borrar-paciente-funcion.php'>
            <input type='hidden' name='id_paciente' value='" . $row['id_usuario'] . "'>
            <button type='submit' name='accion' value='borrar' class='btn btn-danger'>Borrar Paciente</button>
        </form>
    </div>";
            }
            echo "</div>";
        } catch (PDOException $e) {
            die("Error al procesar la solicitud: " . $e->getMessage());
        }
    }


    // Método para insertar un paciente
    public function crearUsuario($nombre, $apellidos, $dni, $usuario, $clave, $num_colegiado, $permiso)
    {
        $query = "INSERT INTO " . $this->table_name . " (nombre, apellidos, dni, usuario, clave, permiso, num_colegiado) 
        VALUES (:nombre, :apellidos, :dni, :usuario, :clave, :permiso, :num_colegiado)";

        $stmt = $this->conn->prepare($query);

        // Vinculación de valores usando propiedades de clase
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":apellidos", $apellidos); // Corregido
        $stmt->bindParam(":dni", $dni);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->bindParam(":clave", $clave); // Corregido
        $stmt->bindParam(":permiso", $permiso);
        $stmt->bindParam(":num_colegiado", $num_colegiado);

        if ($stmt->execute()) {
            return $ultimoIdInsertado = $this->conn->lastInsertId();
        }
    }




    public function editarUsuario($id_usuario, $dni, $nombre, $apellidos, $usuario, $num_colegiado, $permiso)
    {
        try {
            $query = "UPDATE " . $this->table_name . " 
                  SET dni=:dni, nombre=:nombre, apellidos=:apellidos, usuario=:usuario, num_colegiado=:num_colegiado, permiso=:permiso
                  WHERE id_usuario = :id_usuario";

            $stmt = $this->conn->prepare($query);

            // Vinculación de valores
            $stmt->bindParam(":dni", $dni);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":apellidos", $apellidos);
            $stmt->bindParam(":usuario", $usuario);
            $stmt->bindParam(":num_colegiado", $num_colegiado);
            $stmt->bindParam(":permiso", $permiso);
            $stmt->bindParam(":id_usuario", $id_usuario);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die("Error al procesar la solicitud: " . $e->getMessage());
        }
    }
    public function cambiarClavePrimera($id_usuario, $nueva_clave, $confirmar_clave)
    {
        try {
            // Verificar si las nuevas contraseñas coinciden
            if ($nueva_clave !== $confirmar_clave) {
                // Las contraseñas no coinciden, devolver un mensaje de error
                return "Las nuevas contraseñas no coinciden.";
            }

            // Actualizar la contraseña en la base de datos con la nueva contraseña hasheada
            $query_actualizacion = "UPDATE " . $this->table_name . " SET clave = :nueva_clave WHERE id_usuario = :id_usuario";
            $stmt_actualizacion = $this->conn->prepare($query_actualizacion);
            $stmt_actualizacion->bindParam(':nueva_clave', md5($confirmar_clave));
            $stmt_actualizacion->bindParam(':id_usuario', $id_usuario);
            $stmt_actualizacion->execute();
            // Verificar si la actualización fue exitosa
            if ($stmt_actualizacion->rowCount() > 0) {
                // La contraseña se actualizó correctamente
                return "La contraseña se ha actualizado correctamente.";
            } else {
                // No se pudo actualizar la contraseña
                return "Error al actualizar la contraseña. Inténtalo de nuevo más tarde.";
            }
        } catch (PDOException $e) {
            // Manejo de excepciones en caso de error de base de datos
            return "Error al procesar la solicitud: " . $e->getMessage();
        }
    }

    public function cambiarClave($id_usuario, $clave_actual, $nueva_clave, $confirmar_clave)
    {
        try {
            // Verificar si las nuevas contraseñas coinciden
            if ($nueva_clave !== $confirmar_clave) {
                // Las contraseñas no coinciden, devolver un mensaje de error
                return "Las nuevas contraseñas no coinciden.";
            }

            // Verificar si el usuario actual y la contraseña actual coinciden
            $query_verificacion = "SELECT clave FROM " . $this->table_name . " WHERE id_usuario = :id_usuario AND clave = :clave";
            $stmt_verificacion = $this->conn->prepare($query_verificacion);
            $stmt_verificacion->bindParam(':id_usuario', $id_usuario);
            $stmt_verificacion->bindParam(':clave', $clave_actual);
            $stmt_verificacion->execute();
            $usuario = $stmt_verificacion->fetch(PDO::FETCH_ASSOC);

            if (!$usuario) {
                // El usuario actual no existe o la contraseña no coincide
                return "Usuario o contraseña actual incorrectos.";
            }

            // Actualizar la contraseña en la base de datos con la nueva contraseña hasheada
            $query_actualizacion = "UPDATE " . $this->table_name . " SET clave = :nueva_clave WHERE id_usuario = :id_usuario";
            $stmt_actualizacion = $this->conn->prepare($query_actualizacion);
            $stmt_actualizacion->bindParam(':nueva_clave', $nueva_clave);
            $stmt_actualizacion->bindParam(':id_usuario', $id_usuario);
            $stmt_actualizacion->execute();

            // Verificar si la actualización fue exitosa
            if ($stmt_actualizacion->rowCount() > 0) {
                // La contraseña se actualizó correctamente
                return "La contraseña se ha actualizado correctamente.";
            } else {
                // No se pudo actualizar la contraseña
                return "Error al actualizar la contraseña. Inténtalo de nuevo más tarde.";
            }
        } catch (PDOException $e) {
            // Manejo de excepciones en caso de error de base de datos
            return "Error al procesar la solicitud: " . $e->getMessage();
        }
    }
}
