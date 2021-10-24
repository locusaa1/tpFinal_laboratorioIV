<?php
require_once('title.php');
require_once('nav.php');

use Utility\AdminUtility as AdminUtility;

AdminUtility::checkSessionStatus($_SESSION['user']);
?>
<main class="">
    <section class="ourMision-Bg">
        <div class="ourMision">
            <p>Listado de empresas</p>
        </div>
    </section>
    <?php
    if (isset($_GET['delete'])&&$_GET['delete']==true) {

        echo '<div class="alert alert-success" role="alert">';
        echo '<h4 class="alert-heading">Borrado exitoso!</h4>';
        echo '<p>La empresa fue exitosamente borrada.</p>';
        echo '</div>';
    } elseif (isset($_GET['add'])) {

        if ($_GET['add']) {

            echo '<div class="alert alert-success" role="alert">';
            echo '<h4 class="alert-heading">Agregado exitoso!</h4>';
            echo '<p>La empresa fue agregada con éxito.</p>';
            echo '</div>';
        } else {

            echo '<div class="alert alert-danger" role="alert">';
            echo '<h4 class="alert-heading">Hubo un problema!</h4>';
            echo '<p>El cuit que desea ingresar ya se encuentra cargado.</p>';
            echo '</div>';
        }
    } elseif (isset($_GET['update'])) {

        echo '<div class="alert alert-success" role="alert">';
        echo '<h4 class="alert-heading">Actualización exitosa!</h4>';
        echo '<p>La empresa fue exitosamente actualizada.</p>';
        echo '</div>';
    }
    ?>
    <?php require_once('adminNav.php'); ?>
    <div class="container-lg">
        <form action="<?php echo FRONT_ROOT ?>Enterprise/actionProcess" method="get">
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="action" value="create">Crear Nueva Empresa</button>
            <ul class="list-group">
                <?php
                foreach ($list as $enterprise) {
                    echo '<li class="list-group-item">';
                    echo 'Nombre: ' . $enterprise->getName() . '<br>';
                    echo 'Cuit: ' . $enterprise->getCuit() . '<br>';
                    echo 'Teléfono: ' . $enterprise->getPhoneNumber() . '<br>';
                    echo 'Dirección: ' . $enterprise->getAddressName() . ' ' . $enterprise->getAddressNumber() . '<br>'; ?>
                    <button class="btn btn-outline-success btn-lg btn-block" type="submit" name="action"
                            value="update/<?php echo $enterprise->getCuit() ?>">Actualizar
                    </button>
                    <button class="btn btn-outline-danger btn-lg btn-block" type="submit" name="action"
                            value="delete/<?php echo $enterprise->getCuit() ?>">Borrar
                    </button>
                    <?php echo '</li>'; ?>
                    <br>
                <?php } ?>
            </ul>
        </form>
    </div>
</main>
