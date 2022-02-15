<?php
if (!isset($_SESSION['user'])) {

    require_once(VIEWS_PATH . "index.php");
}

if (isset($_SESSION['user'])) {

    if ($_SESSION['user']->getUserType() != "company") {
        require_once(VIEWS_PATH . "index.php");
    }

}
require_once('title.php');
require_once('nav.php');
?>

    <main class="">
        <section class="hello-Bg">
            <div class="hello">
                <p>Listado de ofertas laborales</p>
            </div>
        </section>
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
        <br><br>
        <div class="row">
            <div class="row sticky-top w-100">
                <button class="btn btn-primary btn-lg btn-block" style="transform: rotate(0)" type="button">
                    <a href="<?php echo FRONT_ROOT ?>JobOffer/jobOfferForm?name=<?php echo $_SESSION['user']->getName()?>"
                       class="btn-link stretched-link text-black-50">Crear
                        nueva oferta</a>
                </button>
            </div>
            <div class="table-responsive">
                <table id="theTable" class="table table-striped table-bordered table-sm">
                    <thead>
                    <tr>
                        <td>Empresa</td>
                        <td>Carrera</td>
                        <td>Puesto</td>
                        <td>Fecha inicial</td>
                        <td>Fecha límite</td>
                        <td>Salario</td>
                        <td>Modificar</td>
                        <td>Eliminar</td>
                        <td>Ver detalle</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($jobOfferDTOList as $jobOfferDTO) {
                        echo '<tr>';
                        echo '<td>' . $jobOfferDTO->getEnterpriseName() . '</td>';
                        echo '<td>' . $jobOfferDTO->getCareerName() . '</td>';
                        echo '<td>' . $jobOfferDTO->getJobPositionDescription() . '</td>';
                        echo '<td>' . $jobOfferDTO->getStartDate() . '</td>';
                        echo '<td>' . $jobOfferDTO->getLimitDate() . '</td>';
                        echo '<td>' . $jobOfferDTO->getSalary() . '</td>'; ?>
                        <td>
                            <button class="btn btn-outline-success btn-lg" style="transform: rotate(0)">
                                <a href="<?php echo FRONT_ROOT ?>JobOffer/jobOfferForm?update=<?php echo $jobOfferDTO->getIdJobOffer() ?>"
                                   class="stretched-link btn-block btn-link text-black-50 text-decoration-none">Actualizar</a>
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-outline-danger btn-lg" style="transform: rotate(0)">
                                <a class="stretched-link btn-block btn-link text-black-50 text-decoration-none"
                                   href="<?php echo FRONT_ROOT ?>JobOffer/deleteJobOffer?idJobOffer=<?php echo $jobOfferDTO->getIdJobOffer() ?>&userType=<?php echo $_SESSION['user']->getUserType() ?>">Eliminar</a>
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-outline-primary btn-lg" style="transform: rotate(0)">
                                <a href="<?php echo FRONT_ROOT ?>JobOffer/jobOfferDetails?idJobOffer=<?php echo $jobOfferDTO->getIdJobOffer() ?>&userType=<?php echo $_SESSION['user']->getUserType() ?>"
                                   class="stretched-link btn-block btn-link text-black-50 text-decoration-none">Ver
                                    Detalle</a>
                            </button>
                        </td></tr>
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