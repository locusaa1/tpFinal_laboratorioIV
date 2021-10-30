<?php
require_once('title.php');
require_once('nav.php');

use Utility\AdminUtility as AdminUtility;

AdminUtility::checkSessionStatus($_SESSION['user']);
?>
<main class="">
    <section class="ourMision-Bg">
        <div class="ourMision">
            <p>Creating a new enterprise</p>
        </div>
    </section>
    <?php require_once('adminNav.php'); ?>
    <form action="<?php echo FRONT_ROOT ?>JobOffer/jobOfferFormAction" method="post">
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
            <label for="name">Nombre de la empresa: </label>
            <select <?php if(!isset($jobOfferDTO)){echo 'required';} ?> name="idEnterprise">
                <option value="<?php echo $idEnterprise = (isset($jobOffer))? $jobOffer->getIdEnterprise() : ''; ?>" readonly="readonly" selected><?php echo $message = (isset($jobOfferDTO))? $jobOfferDTO->getEnterpriseName() : 'nombre'; ?></option>
                <?php
                foreach ($enterpriseList as $enterprise){
                    ?>
                    <option value="<?php echo $enterprise->getIdEnterprise()?>"><?php echo $enterprise->getName() ;?></option>
                    <?php
                }
                ?>
            </select><br><br>
            <label for="jobPositionDescription">Descripción del puesto: </label><br>
            <select <?php if(!isset($jobOfferDTO)){echo 'required';} ?> name="idJobPosition">
                <option value="<?php echo $idEnterprise = (isset($jobOffer))? $jobOffer->getIdJobPosition() : ''; ?>" readonly="readonly" selected><?php echo $message = (isset($jobOfferDTO))? $jobOfferDTO->getJobPositionDescription() : 'descripción' ?></option>
                <?php
                foreach ($jobPositionList as $jobPosition){
                    ?>
                    <option value="<?php echo $jobPosition->getJobPositionId() ?>"><?php echo $jobPosition->getDescription() ?></option>
                    <?php
                }
                ?>
            </select><br><br>
            <label for="startDate">Start date: </label>
            <input value="<?php echo $date = (isset($jobOfferDTO))? $jobOfferDTO->getStartDate(): date('d-m-Y')?>" readonly="readonly" name="startDate" type="text" placeholder="<?php echo $message = (isset($jobOfferDTO))? $jobOfferDTO->getStartDate(): date('Y-m-d')?>">
            <label for="limitDate">Limit date: </label>
            <input <?php if(!isset($jobOfferDTO)){echo 'required';} ?> name="limitDate" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="<?php echo $message = (isset($jobOfferDTO))? $jobOfferDTO->getLimitDate():''?>">
            <br>
            <br>
            <label for="description">Descripción de la oferta laboral: </label>
            <input <?php if(!isset($jobOfferDTO)){echo 'required';} ?> name="description" type="text" placeholder="<?php echo $message = (isset($jobOfferDTO))? $jobOfferDTO->getDescription():''?>">
            <br>
            <br>
            <label for="salary">Salario: $</label>
            <input <?php if(!isset($jobOfferDTO)){echo 'required';} ?> name="salary" type="number" placeholder="<?php echo $message = (isset($jobOfferDTO))? $jobOfferDTO->getSalary():''?>">
            <input type="hidden" name="idJobOffer" value="<?php echo $idJobOffer = (isset($jobOfferDTO))? $jobOfferDTO->getIdJobOffer():''?>">
            <button class="btn btn-outline-success btn-lg btn-block" type="submit" name="action" value="<?php echo $message = (isset($jobOfferDTO))? 'update':'create'?>"><?php echo $message = (isset($jobOfferDTO))? 'Actualizar':'Crear'?></button>
            <button class="btn btn-outline-dark btn-lg btn-block" type="reset">Refrescar</button>
        </div>
        </ul>
    </form>
</main>