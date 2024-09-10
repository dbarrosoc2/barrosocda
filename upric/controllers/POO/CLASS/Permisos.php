<?php

class Permisos {
    public function verificarPermisosSuper($idUsuario) {
        if($idUsuario != 4){
            echo "<div class='alert alert-danger' role='alert'>No tienes los permisos para visualizar este contenido</div>";
            die();
        }
    }

    public function verificarPermisosBioquimico($idUsuario) {
        if($idUsuario == 1 || $idUsuario == 2){
            echo "<div class='alert alert-danger' role='alert'>No tienes los permisos para visualizar este contenido</div>";
            die();
        }
    }

    public function verificarPermisosAsistente($idUsuario) {
        if($idUsuario == 1){
            echo "<div class='alert alert-danger' role='alert'>No tienes los permisos para visualizar este contenido</div>";
            die();
        }
    }

    public function verificarPermisosAdministrativo($idUsuario) {
        if(!isset($idUsuario)){
            echo "<div class='alert alert-danger' role='alert'>No tienes los permisos para visualizar este contenido</div>";
            die();
        }
    }
}
?>