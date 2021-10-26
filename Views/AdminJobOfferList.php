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
    <div class="container-lg">
        <div class="container-md">
            <button class="btn btn-primary btn-lg btn-block" style="transform: rotate(0)" type="button">
                <a href="#" class="btn-link stretched-link">Crear nueva oferta</a>
            </button>
            <ul class="list-group">
                <?php
                foreach ($activeList as $jobOffer) {
                    echo '<li class="list-group-item">';
                    echo 'Empresa: ' . $jobOffer->getEnterpriseName() . '<br>';
                    echo 'Descripción de puesto: ' . $jobOffer->getJobPositionDescription() . '<br>';
                    echo 'Estudiante que aplica: ' . $jobOffer->getUserName() . '<br>';
                    echo 'Email de estudiante: ' . $jobOffer->getUserEmail() . '<br>';
                    echo 'Fecha inicial: ' . $jobOffer->getStartDate() . '<br>';
                    echo 'Fecha limite: ' . $jobOffer->getLimitDate() . '<br>';
                    echo 'Descripcion de oferta: ' . $jobOffer->getDescription() . '<br>';
                    echo 'Salario: ' . $jobOffer->getSalary() . '<br>';
                    echo 'Presentacion de alumno: ' . $jobOffer->getCoverLetter() . '<br></li>';
                }
                ?>
            </ul>
        </div>
        <div class="container-md">

        </div>
        <div class="container-md">

        </div>
    </div>
</main>
