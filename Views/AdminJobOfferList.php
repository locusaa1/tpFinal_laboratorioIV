<?php
require_once('title.php');
require_once('nav.php');

use Utility\AdminUtility as AdminUtility;

AdminUtility::checkSessionStatus($_SESSION['user']);
?>
<main class="">
    <section class="ourMision-Bg">
        <div class="ourMision">
            <p>Listado de ofertas laborales</p>
        </div>
    </section>
    <?php
    require_once('adminNav.php');
    ?>
    <button class="btn btn-primary btn-lg btn-block" style="transform: rotate(0)" type="button">
        <a href="#" class="btn-link stretched-link">Crear nueva oferta</a>
    </button>
    <div class="container-lg d-xl-inline-flex">
        <div class="container-xl">
            <ul class="list-group">
                <?php
                foreach ($activeList as $jobOfferDTO) {
                    echo '<li class="list-group-item">';
                    echo 'Empresa: ' . $jobOfferDTO->getEnterpriseName() . '<br>';
                    echo 'Descripción de puesto: ' . $jobOfferDTO->getJobPositionDescription() . '<br>';
                    echo 'Estudiante que aplica: ' . $jobOfferDTO->getUserName() . '<br>';
                    echo 'Email de estudiante: ' . $jobOfferDTO->getUserEmail() . '<br>';
                    echo 'Fecha inicial: ' . $jobOfferDTO->getStartDate() . '<br>';
                    echo 'Fecha limite: ' . $jobOfferDTO->getLimitDate() . '<br>';
                    echo 'Descripcion de oferta: ' . $jobOfferDTO->getDescription() . '<br>';
                    echo 'Salario: ' . $jobOfferDTO->getSalary() . '<br></li>';
                }
                ?>
            </ul>
        </div>
        <div class="container-xl">
            <ul class="container-md">
                <?php
                foreach ($appliedList as $jobOfferDTO) {
                    echo '<li class="list-group-item">';
                    echo 'Empresa: ' . $jobOfferDTO->getEnterpriseName() . '<br>';
                    echo 'Descripción de puesto: ' . $jobOfferDTO->getJobPositionDescription() . '<br>';
                    echo 'Estudiante que aplica: ' . $jobOfferDTO->getUserName() . '<br>';
                    echo 'Email de estudiante: ' . $jobOfferDTO->getUserEmail() . '<br>';
                    echo 'Fecha inicial: ' . $jobOfferDTO->getStartDate() . '<br>';
                    echo 'Fecha limite: ' . $jobOfferDTO->getLimitDate() . '<br>';
                    echo 'Descripcion de oferta: ' . $jobOfferDTO->getDescription() . '<br>';
                    echo 'Salario: ' . $jobOfferDTO->getSalary() . '<br></li>';
                }
                ?>
            </ul>
        </div>
        <div class="container-md">
            <ul class="container-md">
                <?php
                foreach ($outOfDateList as $jobOfferDTO) {
                    echo '<li class="list-group-item">';
                    echo 'Empresa: ' . $jobOfferDTO->getEnterpriseName() . '<br>';
                    echo 'Descripción de puesto: ' . $jobOfferDTO->getJobPositionDescription() . '<br>';
                    echo 'Estudiante que aplica: ' . $jobOfferDTO->getUserName() . '<br>';
                    echo 'Email de estudiante: ' . $jobOfferDTO->getUserEmail() . '<br>';
                    echo 'Fecha inicial: ' . $jobOfferDTO->getStartDate() . '<br>';
                    echo 'Fecha limite: ' . $jobOfferDTO->getLimitDate() . '<br>';
                    echo 'Descripcion de oferta: ' . $jobOfferDTO->getDescription() . '<br>';
                    echo 'Salario: ' . $jobOfferDTO->getSalary() . '<br></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</main>
