<?php
include_once('title.php');
include_once('nav.php');
?>
<main class="">
    <section class="ourMision-Bg">
        <div class="ourMision">
            <p>Detalle de oferta laboral</p>
        </div>
    </section>
    <?php
    include_once('adminNav.php');
    ?>
    <div class="w-100 d-flex justify-content-lg-center">
        <div class="row m-3">
            <div class="col w-100">
                <div class="card bg-info m-3">
                    <img src="../<?php echo $enterprise->getImagePath() ?>" class="card-img-top" width="800"
                         height="600" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Detalle</h5>
                        <p class="card-text">Datos de la empresa que ofrece el puesto.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php
                        echo '
                        <li class="list-group-item bg-info">Empresa: ' . $jobOfferDTO->getEnterpriseName() . '</li>
                        <li class="list-group-item bg-info">Puesto: ' . $jobOfferDTO->getJobPositionDescription() . '</li>
                        <li class="list-group-item bg-info">Fecha inicial: ' . $jobOfferDTO->getStartDate() . '</li>
                        <li class="list-group-item bg-info">Fecha limite: ' . $jobOfferDTO->getLimitDate() . '</li>
                        <li class="list-group-item bg-info">Salario: ' . $jobOfferDTO->getSalary() . '</li>'
                        ?>
                    </ul>
                    <div class="card-body">
                        <?php
                        echo '<h4>Descripción de la oferta</h4>';
                        echo '<p>' . $jobOfferDTO->getDescription() . '</p>';
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
<?php
include_once('companies.php');
include_once('footer.php');
?>

