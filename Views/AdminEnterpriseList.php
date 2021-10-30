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
    if (isset($message)) {

        echo '<div class="alert alert-success" role="alert">';
        echo '<h4 class="alert-heading">Proceso completado!</h4>';
        echo '<p>' . $message . '</p>';
        echo '</div>';
    } elseif (isset($errorMessage)) {

        echo '<div class="alert alert-danger" role="alert">';
        echo '<h4 class="alert-heading">Algo inesperado sucedió!</h4>';
        echo '<p>' . $errorMessage . '</p>';
        echo '</div>';
    }
    ?>
    <?php require_once('adminNav.php'); ?>
    <div class="container-lg">
        <button class="btn btn-primary btn-lg btn-block" style="transform: rotate(0)" type="button" name="action">
            <a class="btn-link stretched-link text-black-50 text-decoration-none"
               href="<?php echo FRONT_ROOT ?>Enterprise/addEnterprise"> Crear nueva empresa</a>
        </button>
        <ul class="list-group">
            <?php
            foreach ($list as $enterprise) {
                echo '<li class="list-group-item">';
                echo 'Nombre: ' . $enterprise->getName() . '<br>';
                echo 'Cuit: ' . $enterprise->getCuit() . '<br>';
                echo 'Teléfono: ' . $enterprise->getPhoneNumber() . '<br>';
                echo 'Dirección: ' . $enterprise->getAddressName() . ' ' . $enterprise->getAddressNumber() . '<br>'; ?>
                <button class="btn btn-outline-success btn-lg btn-block" style="transform: rotate(0)" type="submit"
                        name="action">
                    <a class="btn-link stretched-link text-black-50 text-decoration-none"
                       href="<?php echo FRONT_ROOT ?>/Enterprise/updateEnterprise?enterpriseCuit=<?php echo $enterprise->getCuit(); ?>">Actualizar</a>
                </button>
                <form action="<?php echo FRONT_ROOT ?>Enterprise/deleteEnterprise" method="post">
                    <button class="btn btn-outline-danger btn-lg btn-block" type="submit" name="cuit"
                            value="<?php echo $enterprise->getCuit() ?>">Borrar
                    </button>
                </form>
                <?php echo '</li>'; ?>
                <br>
            <?php } ?>
        </ul>
    </div>
</main>
