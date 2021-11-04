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
    include_once ('adminNav.php');
    ?>
    <div class="w-100">
        <div class="row mr-3 ml-3">
            <div class="col w-25">
                <div class="card">
                    <img src="../<?php echo $enterprise->getImagePath() ?>" class="card-img-top" width="100" height="400" alt="..." >
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
            <div class="col w-75">
                <div class="card mb-3 w-100">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img class="card-img img-thumbnail" src="../<?php echo $jobOffer->getResume()?>" width="100" height="400" alt="...">

                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Detalle</h5>
                                <p class="card-text">Datos del alumno que se postula.</p>
                                <?php
                                if (isset($student)){
                                ?>
                                <ul class="list-group list-group-flush">
                                    <?php
                                    echo '
                                    <li class="list-group-item">Email: ' . $jobOfferDTO->getUserEmail() . '</li>
                                    <li class="list-group-item">Nombre: ' . $student->getFirstName() . '</li>
                                    <li class="list-group-item">Apellido: ' . $student->getLastName() . '</li>
                                    <li class="list-group-item">Carrera: ' . $jobOfferDTO->getCareerName() . '</li>
                                    <li class="list-group-item">DNI: ' . $student->getDni() . '</li>
                                    <li class="list-group-item">Fecha de nacimiento: ' . $student->getBirthDate() . '</li>
                                    <li class="list-group-item">Género: ' . $student->getGender() . '</li>
                                    <li class="list-group-item">Teléfono: ' . $student->getPhoneNumber() . '</li>';
                                    ?>
                                </ul>
                                <div class="card-body">
                                    <?php
                                    echo '<h4>Carta de presentación</h4>
                                    <p>' . $jobOfferDTO->getCoverLetter() . '</p>';
                                    ?>
                                </div>
                                    <a href="../<?php echo $jobOffer->getResume()?> ?>" class="btn btn-primary" download="">Descargar CV</a>
                                <?php
                                }else{
                                    echo '
                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item">No aplica ningún alumno todavía</li>
                                    </ul>';
                                }
                                ?>
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

