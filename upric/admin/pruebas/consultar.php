<?php
    include '../../common/session-checker.php';
    require_once '../../controllers/POO/CLASS//Prueba.php';
    require_once "../../controllers/POO/CLASS/funciones.php";
    require_once "../../controllers/POO/CLASS/Permisos.php";
    $permisos = new Permisos();
    $numPermiso = $_SESSION['permiso'];
    $title = "Listar pruebas";
    $description = "Listado de todas las pruebas registradas en UPRIC";
    $panelAdmin = true;
?>
<!DOCTYPE html>
<html lang="es">
<?php include '../../common/head.php'; ?>

<body>
    <?php 
        include '../../common/header.php';
        include '../../common/sidebar.php';
    ?>

    <main id="main" class="main">
        <?php include '../../common/page-title.php'; ?>
        <?php
                if ($permisos->verificarPermisosBioquimico($numPermiso)) {
                        echo "Contenido visible para el usuario con id " . $_SESSION['id_usuario'] . ".";
                    }
                ?>

        <div class="card table-fixed-wrapper">
            <div class="card-body">
                <?php 
                    $pruebaInstance = new Prueba();
                    $pruebasData = $pruebaInstance->mostrarPruebas();

                    $modalPreguntaTitle = "Eliminar prueba";
                    $modalPreguntaDescription = '¿Estás de acuerdo con eliminar la prueba <strong class="deleteName">Test</strong>? Esta operación no puede revertirse.';
                    include '../../common/modal-pregunta.php'; 
                ?>
                <table class="table table-result">
                    <thead >
                        <tr>
                            <th>#ID</th>
                            <th>Nombre</th>
                            <th>Valor Ref. (Min/Max)</th>
                            <th>Unidades</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pruebasData as $prueba){ ?>
                            <tr data-delete-row-id="<?=$prueba['id_prueba']?>">
                                <td><?= $prueba['id_prueba'] ?></td>
                                <td><?= $prueba['nombre_prueba']?></td>
                                <td><?= $prueba['valor_ref_min']. " / ".$prueba['valor_ref_max']?></td>
                                <td><?= $prueba['unidades']?></td>
                                <td class="row-buttons">
                                    <div class="d-flex">
                                        <a href="modificar.php?id_prueba=<?= $prueba['id_prueba'] ?>" class="btn btn-outline-primary me-3">
                                            <i class="bi bi-eye-fill"></i>
                                            <span class="d-md-none ">Editar</span>
                                        </a>

                                        <button 
                                        class="btn btn-outline-primary btnDelete" 
                                        data-delete-id="<?=$prueba['id_prueba']?>" 
                                        data-delete-name="<?=$prueba['nombre_prueba']?>"
                                        data-delete-url="../../controllers/POO/borrar-prueba-funcion.php"
                                        data-delete-type="prueba"
                                        >
                                            <i 
                                            class="bi bi-trash-fill" 
                                            data-delete-id="<?=$prueba['id_prueba']?>"
                                            data-delete-name="<?=$prueba['nombre_prueba']?>"
                                            data-delete-url="../../controllers/POO/borrar-prueba-funcion.php"
                                            data-delete-type="prueba"
                                            ></i>
                                            <span class="d-md-none"
                                            data-delete-id="<?=$prueba['id_prueba']?>"
                                            data-delete-name="<?=$prueba['nombre_prueba']?>"
                                            data-delete-url="../../controllers/POO/borrar-prueba-funcion.php"
                                            data-delete-type="prueba"
                                            
                                            >Eliminar</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php
        if (isset($_SESSION['mensaje'])) {
            $modalTitle = "¡Prueba actualizada!";
            $modalDescription = "Los datos de la prueba <strong>{$_SESSION['mensaje']}</strong> fueron actualizados correctamente.";
            include '../../common/modal-success.php';
        } elseif (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
        }
        unset($_SESSION['error']);
        unset($_SESSION['mensaje']);
    ?>
    <?php 
        require_once __DIR__ . '/../../common/footer.php'; 
    ?>
</body>

</html>