<?php
require_once('title.php');
require_once('nav.php');
?>
<main class="">
    <section class="ourMision-Bg">
        <div class="ourMision">
            <p>Listado de empresas</p>
        </div>
    </section>
    <?php
    if (isset($_GET['delete'])) {

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
        <button class="btn btn-primary btn-lg btn-block" type="submit" name="action" value="create">Create New Enterprise</button>
        <form class="container" action="<?php echo FRONT_ROOT ?>Enterprise/actionProcess" method="get">
            <section class="list-group">
                <?php
                foreach ($list as $enterprise) {
                    echo '<li class="list-group-item">';
                    echo 'name: ' . $enterprise->getName() . '<br>';
                    echo 'cuit: ' . $enterprise->getCuit() . '<br>';
                    echo 'phone: ' . $enterprise->getPhoneNumber() . '<br>';
                    echo 'address: ' . $enterprise->getAddressName() . ' ' . $enterprise->getAddressNumber() . '<br>'; ?>
                    <button class="enterpriseButton" type="submit" name="action"
                            value="update/<?php echo $enterprise->getCuit() ?>">Update
                    </button>
                    <button class="enterpriseButton" type="submit" name="action"
                            value="delete/<?php echo $enterprise->getCuit() ?>">Delete
                    </button>
                    <?php echo '</li>'; ?>
                    <br>
                <?php } ?>
            </section>
        </form>
    </div>
</main>
