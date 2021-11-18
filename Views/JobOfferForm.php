<?php
if (!isset($_SESSION['user'])) {

    require_once(VIEWS_PATH . "index.php");
}

if (isset($_SESSION['user'])) {

    if ($_SESSION['user']->getUserType() == "student") {
        require_once(VIEWS_PATH . "index.php");
    }

}

require_once('title.php');
require_once('nav.php');


?>
<main class="">
    <section class="ourMision-Bg">
        <div class="ourMision">
            <p>Ofertas laborales</p>
        </div>
    </section>
    <?php if ($_SESSION['user']->getUserType()=='admin') {
        require_once('adminNav.php');
    }?>
    <div class="row ml-3 mr-3">
        <div class="col w-100">
            <div class="card bg-info">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="../<?php if(isset($jobOffer)){echo $jobOffer->getFlyer();} ?>" class="img-thumbnail" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <form action="<?php echo FRONT_ROOT ?>JobOffer/jobOfferFormAction" enctype="multipart/form-data" method="post">
                                <div class="form-group">
                                    <?php
                                    if (isset($jobOfferDTO)){
                                        ?>
                                        <div class="alert alert-success">
                                            <p>La información dentro de los campos es la actual!</p>
                                            <hr>
                                            <p class="mb-0">Es posible rellenar un único campo para actualizar.</p>
                                        </div><br>
                                        <?php
                                    }else{
                                        ?>
                                        <div class="alert alert-primary">
                                            <p>Todos los campos son requeridos.</p>
                                        </div><br>
                                        <?php
                                    }
                                    ?>
                                    <br>
                                    <label>Cargue un flyer para que la oferta se muestre en el feed</label><br>
                                    <input type="file" name="flyer" <?php if(!isset($jobOfferDTO)){echo 'required';} ?>><br><br>
                                    <label for="name">Nombre de la empresa: </label><br>
                                    <select class="form-control form-control-lg" <?php if(!isset($jobOfferDTO)){echo 'required';} ?> name="idEnterprise">
                                        <option value="<?php echo $idEnterprise = (isset($jobOffer))? $jobOffer->getIdEnterprise() : ''; ?>" readonly="readonly" selected><?php echo $message = (isset($jobOfferDTO))? $jobOfferDTO->getEnterpriseName() : 'nombre'; ?></option>
                                        <?php
                                        foreach ($enterpriseList as $enterprise){
                                            ?>
                                            <option value="<?php echo $enterprise->getIdEnterprise()?>"><?php echo $enterprise->getName() ;?></option>
                                            <?php
                                        }
                                        ?>
                                    </select><br>
                                    <label for="jobPositionDescription">Descripción del puesto: </label><br>
                                    <select class="form-control form-control-lg" <?php if(!isset($jobOfferDTO)){echo 'required';} ?> name="idJobPosition">
                                        <option value="<?php echo $idEnterprise = (isset($jobOffer))? $jobOffer->getIdJobPosition() : ''; ?>" readonly="readonly" selected><?php echo $message = (isset($jobOfferDTO))? $jobOfferDTO->getJobPositionDescription() : 'descripción' ?></option><br>
                                        <?php
                                        foreach ($jobPositionList as $jobPosition){
                                            ?>
                                            <option value="<?php echo $jobPosition->getJobPositionId() ?>"><?php echo $jobPosition->getDescription() ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select><br>
                                    <label for="startDate">Start date: </label><br>
                                    <input class="form-control form-control-lg" value="<?php echo $date = (isset($jobOfferDTO))? $jobOfferDTO->getStartDate(): date('d-m-Y')?>" readonly="readonly" name="startDate" type="text" placeholder="<?php echo $message = (isset($jobOfferDTO))? $jobOfferDTO->getStartDate(): date('Y-m-d')?>"><br>
                                    <label for="limitDate">Limit date: </label><br>
                                    <input class="form-control form-control-lg" <?php if(!isset($jobOfferDTO)){echo 'required';} ?> name="limitDate" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="<?php echo $message = (isset($jobOfferDTO))? $jobOfferDTO->getLimitDate():''?>"><br>
                                    <label for="description">Descripción de la oferta laboral: </label><br>
                                    <input class="form-control form-control-lg" <?php if(!isset($jobOfferDTO)){echo 'required';} ?> name="description" type="text" placeholder="<?php echo $message = (isset($jobOfferDTO))? $jobOfferDTO->getDescription():''?>"><br>
                                    <label for="salary">Salario: $</label><br>
                                    <input class="form-control form-control-lg" <?php if(!isset($jobOfferDTO)){echo 'required';} ?> name="salary" type="number" placeholder="<?php echo $message = (isset($jobOfferDTO))? $jobOfferDTO->getSalary():''?>"><br>
                                    <input type="hidden" name="idJobOffer" value="<?php echo $idJobOffer = (isset($jobOfferDTO))? $jobOfferDTO->getIdJobOffer():''?>">
                                    <input type="hidden" name="userType" value="<?php echo $_SESSION['user']->getUserType() ?>">
                                    <button class="btn btn-success btn-lg btn-block" type="submit" name="action" value="<?php echo $message = (isset($jobOfferDTO))? 'update':'create'?>"><?php echo $message = (isset($jobOfferDTO))? 'Actualizar':'Crear'?></button>
                                    <button class="btn btn-dark btn-lg btn-block" type="reset">Refrescar</button>
                                </div>
                                </ul>
                            </form>
                        </div>
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