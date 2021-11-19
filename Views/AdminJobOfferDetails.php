<?php
include_once('title.php');
include_once('nav.php');
?>
<main class="">
    <section class="hello-Bg">
        <div class="hello">
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
                    <div class="card-body">
                        <?php
                        echo 'Genere el pdf con los alumnos postulados:';
                        ?>
                        <button class="btn btn-dark btn-lg btn-block" type="reset">
                            <a target="_blank" rel="noopener noreferrer" href="<?php echo FRONT_ROOT ?>/JobOffer/generatePDFView?idJobOffer=<?php echo $jobOfferDTO->getIdJobOffer() ?>">Generar</a>
                        </button>
                    </div>
                </div>
                <div class="card bg-light m-3">
                    <div class="card-header ">
                        <h3 class="card-title d-flex justify-content-lg-center">Listado de los alumnos activos que se postulan:</h3><br>
                        <div class="row">
                            <div class="table-responsive m-3">
                                <table id="theTable" class="table table-striped table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <td>Nombre</td>
                                        <td>Email</td>
                                        <td>Número de teléfono</td>
                                        <td>Declinar de la oferta</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($studentList as $studentApply) {
                                        echo '<tr>';
                                        echo '<td>' . $studentApply->getStudentName() . '</td>';
                                        echo '<td>' . $studentApply->getStudentEmail() . '</td>';
                                        echo '<td>' . $studentApply->getStudentPhone() . '</td>';
                                        ?>
                                        <td>
                                            <button class="btn btn-danger btn-lg d-flex justify-content-lg-center" style="transform: rotate(0)">
                                                <a href="<?php echo FRONT_ROOT ?>Apply/dismissApplicationByCompany?idApply=<?php echo $studentApply->getIdApply()?>&idJobOffer=<?php echo $studentApply->getIdJobOffer()?>&userType=<?php echo $_SESSION['user']->getUserType() ?>"
                                                   class=" stretched-link btn-block btn-link text-black-50 text-decoration-none">Declinar Alumno</a>
                                            </button>
                                        </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                                        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                                <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
                                <script type="application/javascript">
                                    $(document).ready(function () {
                                        $('#theTable').DataTable({});
                                    });
                                </script>
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

