<?php
class RegistroLogger
{
    private $rutaArchivoCSV;

    public function __construct($rutaArchivoCSV)
    {
        $this->rutaArchivoCSV = $rutaArchivoCSV;
        if (!file_exists($this->rutaArchivoCSV)) {
            touch($this->rutaArchivoCSV);
            $encabezado = array('fecha', 'id_usuario', 'contraseña', 'url', 'ip', 'operación', 'observación');
            $this->agregarACSV($encabezado);
        }
    }

    private function agregarACSV($datos)
    {
        $archivo = fopen($this->rutaArchivoCSV, 'a');
        fputcsv($archivo, $datos);
        fclose($archivo);
    }

    private function obtenerFechaActual()
    {
        return date('Y-m-d H:i:s');
    }

    private function obtenerURLActual()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        return $url;
    }

    private function obtenerIPCliente()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    public function inicioSesion($usuario, $contraseña, $comentario)
    {
        $fecha = $this->obtenerFechaActual();
        $ip = $this->obtenerIPCliente();
        $url = $this->obtenerURLActual();
        $datos = array($fecha, $usuario, $contraseña, $url, $ip, 'inicio_sesion', $comentario);
        $this->agregarACSV($datos);
    }

    public function navegacion($idUsuario, $comentario)
    {
        $fecha = $this->obtenerFechaActual();
        $ip = $this->obtenerIPCliente();
        $url = $this->obtenerURLActual();
        $datos = array($fecha, $idUsuario, '', $url, $ip, 'navegacion', $comentario);
        $this->agregarACSV($datos);
    }

    public function cierreSesion($idUsuario, $comentario)
    {
        $fecha = $this->obtenerFechaActual();
        $ip = $this->obtenerIPCliente();
        $url = $this->obtenerURLActual();
        $datos = array($fecha, $idUsuario, 'No necesaria para esta operacion', $url, $ip, 'cierre_sesion', $comentario);
        $this->agregarACSV($datos);
    }

    public function mostrarRegistros()
    {
        try {
            if (!file_exists($this->rutaArchivoCSV)) {
                throw new Exception("El archivo no existe.");
            }

            $archivo = fopen($this->rutaArchivoCSV, 'r');
            if (!$archivo) {
                throw new Exception("No se pudo abrir el archivo.");
            }

            echo '<table class="table table-striped">';
            echo '<thead><tr>';
            $encabezado = fgetcsv($archivo);
            foreach ($encabezado as $columna) {
                echo '<th>' . htmlspecialchars($columna) . '</th>';
            }
            echo '</tr></thead><tbody>';

            while (($datos = fgetcsv($archivo)) !== FALSE) {
                echo '<tr>';
                foreach ($datos as $dato) {
                    echo '<td>' . htmlspecialchars($dato) . '</td>';
                }
                echo '</tr>';
            }

            echo '</tbody></table>';
            fclose($archivo);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
?>
