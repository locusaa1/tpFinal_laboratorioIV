<?php
   if(!isset($_SESSION['user'])){
          
    require_once(VIEWS_PATH."index.php");
    }

    if(isset($_SESSION['user'])){

      if($_SESSION['user']->getUserType()!="student")
      {
        require_once(VIEWS_PATH."index.php");
      }    
        
    }

    require_once ('title.php');
    require_once('nav.php');
?>
<main class="">
<section class="hello-Bg">
        <div class="hello">
            <p>Mis postulaciones</p>
        </div>
</section>
<section class="">
    <?php
    if(!empty(($activeApplications)))
    {
        foreach ($activeApplications as $jobOffer){
        ?>
        <br>
        <h2 class="titleMessaje">Postulaciones Activas</h2>
        <br>
        <div class="companyAppliesListContainer">
            <p class="offerData">Empresa</p> 
            <p class="offerDataAnswer"><?php echo $jobOffer->getEnterpriseName()?></p>
            <p class="offerData">Posición</p> 
            <p class="offerDataAnswer"><?php echo $jobOffer->getJobPositionDescription()?></p>
            <p class="offerData">Descripción</p> 
            <p class="offerDataAnswerDescription"><?php echo $jobOffer->getDescription()?></p>
            <p class="offerData">Salario</p> 
            <p class="offerDataAnswer"><?php echo $jobOffer->getSalary()?></p>
            <br>
            <a class="applyButton" href="<?php echo FRONT_ROOT ?>Apply/dismissApplicationByStudent?idJobOffer=<?php echo $jobOffer->getIdJobOffer()?>">Desestimar aplicación</a>
        <br>
        </div>
        <?php
        }
    }
    
    if(!empty(($notActiveApplications)))
    {
        foreach ($notActiveApplications as $jobOffer){
        ?>
        <br>
        <h2 class="titleMessaje">Postulaciones Inactivas</h2>
        <br> 
        <div class="companyAppliesListContainer">
            <p class="offerData">Empresa</p> 
            <p class="offerDataAnswer"><?php echo $jobOffer->getEnterpriseName()?></p>
            <p class="offerData">Posición</p> 
            <p class="offerDataAnswer"><?php echo $jobOffer->getJobPositionDescription()?></p>
            <p class="offerData">Descripción</p> 
            <p class="offerDataAnswerDescription"><?php echo $jobOffer->getDescription()?></p>
            <p class="offerData">Salario</p> 
            <p class="offerDataAnswer"><?php echo $jobOffer->getSalary()?></p>
        <br>
        </div>
        <?php
        }
    }

    if(empty($notActiveApplications) && empty($activeApplications)){
        ?>
        <div class="rejectionMessaje">
            <?php echo 'Usted no realizó aplicaciones hasta el momento'?>
        </div>
        <?php
    }
    ?>
</section>   
<section>
<br><br>
    <a class="backButton" href="<?php echo FRONT_ROOT ?>Student/StudentView">Volver</a>
</section>     
  
</main>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>