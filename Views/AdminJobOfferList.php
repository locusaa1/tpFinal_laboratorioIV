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
    <div class="container float-none">
        <div class="row sticky-top">
            <nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="navbar-text mr-2">
                            <p>Filtros de busqueda</p>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle mr-3" type="button"
                                        id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-expanded="false">
                                    Empresas
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle mr-3" type="button"
                                        id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-expanded="false">
                                    Puesto
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <button class="btn btn-primary btn-lg btn-block" style="transform: rotate(0)" type="button">
                <a href="<?php echo FRONT_ROOT ?>JobOffer/jobOfferForm"
                   class="btn-link stretched-link text-black-50">Crear
                    nueva oferta</a>
            </button>
        </div>
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
        <div class="row h-100">
            <div class="col float-left">
                <div class="row">
                    <div class="col-4">
                        <label class="card-subtitle w-100 text-center bg-success">Ofertas disponibles</label>
                        <ul class="list-group">
                            <?php
                            foreach ($availableList as $jobOfferDTO) {
                                echo '<li class="list-group-item">';
                                echo 'Empresa: ' . $jobOfferDTO->getEnterpriseName() . '<br>';
                                echo 'Descripción de puesto: ' . $jobOfferDTO->getJobPositionDescription() . '<br>';
                                echo 'Estudiante que aplica: ' . $jobOfferDTO->getUserName() . '<br>';
                                echo 'Email de estudiante: ' . $jobOfferDTO->getUserEmail() . '<br>';
                                echo 'Fecha inicial: ' . $jobOfferDTO->getStartDate() . '<br>';
                                echo 'Fecha limite: ' . $jobOfferDTO->getLimitDate() . '<br>';
                                echo 'Descripcion de oferta: ' . $jobOfferDTO->getDescription() . '<br>';
                                echo 'Salario: ' . $jobOfferDTO->getSalary() . '<br>'; ?>
                                <button class="btn btn-outline-success btn-lg btn-block">
                                    <a href="<?php echo FRONT_ROOT ?>JobOffer/jobOfferForm?update=<?php echo $jobOfferDTO->getIdJobOffer() ?>"
                                       class="btn-block btn-link text-black-50 text-decoration-none">Actualizar</a>
                                </button>
                                <form action="<?php echo FRONT_ROOT ?>JobOffer/deleteJobOffer">
                                    <button class="btn btn-outline-danger btn-lg btn-block" type="submit" name="idJobOffer" value="<?php echo $jobOfferDTO->getIdJobOffer() ?>">
                                        Eliminar
                                    </button>
                                </form></li><br>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="col-4">
                        <label class="card-subtitle w-100 text-center bg-info">Ofertas ocupadas</label>
                        <ul class="list-group">
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
                                echo 'Salario: ' . $jobOfferDTO->getSalary() . '<br></li>'; ?>
                                <button class="btn btn-outline-info btn-lg btn-block">
                                    <a href="" class="btn-link text-black-50 text-decoration-none">Ver Detalles</a>
                                </button>
                                <form action="<?php echo FRONT_ROOT ?>JobOffer/deleteJobOffer">
                                    <button class="btn btn-outline-danger btn-lg btn-block" type="submit" name="idJobOffer" value="<?php echo $jobOfferDTO->getIdJobOffer() ?>">
                                        Eliminar
                                    </button>
                                </form></li><br>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="col-4">
                        <label class="card-subtitle w-100 text-center bg-danger">Ofertas Caducadas</label>
                        <ul class="list-group">
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
                                echo 'Salario: ' . $jobOfferDTO->getSalary() . '<br></li>'; ?>
                                <button class="btn btn-outline-success btn-lg btn-block">
                                    <a href="<?php echo FRONT_ROOT ?>JobOffer/jobOfferForm?update=<?php echo $jobOfferDTO->getIdJobOffer() ?>"
                                       class="btn-block btn-link text-black-50 text-decoration-none">Actualizar</a>
                                </button>
                                <form action="<?php echo FRONT_ROOT ?>JobOffer/deleteJobOffer">
                                    <button class="btn btn-outline-danger btn-lg btn-block" type="submit" name="idJobOffer" value="<?php echo $jobOfferDTO->getIdJobOffer() ?>">
                                        Eliminar
                                    </button>
                                </form>
                                </li><br>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>