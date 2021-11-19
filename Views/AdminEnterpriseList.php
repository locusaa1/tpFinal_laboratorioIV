<?php
require_once('title.php');
require_once('nav.php');

use Utility\AdminUtility as AdminUtility;

AdminUtility::checkSessionStatus($_SESSION['user']);
?>
<main class="">
    <section class="hello-Bg">
        <div class="hello">
            <p>Listado de empresas</p>
        </div>
    </section>
    <?php require_once('adminNav.php'); ?>
    <div class="container float-none">
        <div class="row w-100">
            <?php
            if (isset($message)) {

                echo '<div class="alert alert-success w-100" role="alert">';
                echo '<h4 class="alert-heading">Proceso completado!</h4>';
                echo '<p>' . $message . '</p>';
                echo '</div>';
            } elseif (isset($errorMessage)) {

                echo '<div class="alert alert-danger w-100" role="alert">';
                echo '<h4 class="alert-heading">Algo inesperado sucedió!</h4>';
                echo '<p>' . $errorMessage . '</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="row sticky-top w-100">
            <button class="btn btn-primary btn-lg btn-block" style="transform: rotate(0)" type="button" name="action">
                <a class="btn-link stretched-link text-black-50 text-decoration-none"
                   href="<?php echo FRONT_ROOT ?>Enterprise/addEnterprise"> Crear nueva empresa</a>
            </button>
        </div>
        <div class="table-responsive">
            <table id="theTable" class="table table-striped table-bordered table-sm">
                <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Cuit</td>
                    <td>Teléfono</td>
                    <td>Dirección</td>
                    <td>Actualizar</td>
                    <td>Eliminar</td>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($list as $enterprise) {
                echo '
                    <tr>
                    <td>' . $enterprise->getName() . '</td>
                    <td>' . $enterprise->getCuit() . '</td>
                    <td>' . $enterprise->getPhoneNumber() . '</td>
                    <td>' . $enterprise->getAddressName() . ' ' . $enterprise->getAddressNumber() . '</td>'; ?>
                <td class="text-center">
                    <button class="btn btn-outline-success btn-lg" style="transform: rotate(0)"
                            name="action">
                        <a class="btn-link text-black-50 text-decoration-none stretched-link"
                           href="<?php echo FRONT_ROOT ?>/Enterprise/updateEnterprise?enterpriseCuit=<?php echo $enterprise->getCuit(); ?>">Actualizar</a>
                    </button>
                </td>
                <td class="text-center">
                    <form action="<?php echo FRONT_ROOT ?>Enterprise/deleteEnterprise" method="post">
                        <button class=" btn btn-outline-danger btn-lg stretched-link" type="submit" name="cuit" style="transform: rotate(0)"
                                value="<?php echo $enterprise->getCuit() ?>">Borrar
                        </button>
                    </form>
                </td>
                </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script type="application/javascript">
            $(document).ready(function () {
                $('#theTable').DataTable({});
            });
        </script>
    </div>
</main>
<?php
require_once('companies.php');
require_once('contactForm.php');
?>