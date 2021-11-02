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
    <div class="container">
        <div class="row">
            <div class="col w-50">
                <div class="card w-100">
                    <img src="#" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Detalle</h5>
                        <p class="card-text">Datos de la empresa que ofrece el puesto.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php
                        echo '
                        <li class="list-group-item">Empresa: ' . $jobOfferDTO->getEnterpriseName() . '</li>
                        <li class="list-group-item">Puesto: ' . $jobOfferDTO->getJobPositionDescription() . '</li>
                        <li class="list-group-item">Fecha inicial: ' . $jobOfferDTO->getStartDate() . '</li>
                        <li class="list-group-item">Fecha limite: ' . $jobOfferDTO->getLimitDate() . '</li>
                        <li class="list-group-item">Salario: ' . $jobOfferDTO->getSalary() . '</li>'
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
            <div class="col w-50">
                <div class="card mb-3 w-100">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img class="card-img" src="../samples/qwe.PNG" alt="...">

                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Detalle</h5>
                                <p class="card-text">Datos del alumno que se postula.</p>
                                <ul class="list-group list-group-flush">
                                    <?php
                                    echo '
                                    <li class="list-group-item">Email:' . $jobOfferDTO->getUserEmail() . '</li>
                                    <li class="list-group-item">Nombre:' . $jobOfferDTO->getUserName() . '</li>'
                                    ?>
                                </ul>
                                <a class="btn btn-primary">Descargar CV</a>
                            </div>
                        </div>
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

