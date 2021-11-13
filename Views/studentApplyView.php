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
<section class="studentInfo">
    <?php
    if(!empty(($applications)))
    {
        foreach ($applications as $jobOffer){
        ?>
        <legend>Postulación</legend>
        <p class="offerData">Empresa</p> 
        <p class="offerDataAnswer"><?php echo $jobOffer->getEnterpriseName()?></p>
        <p class="offerData">Posición</p> 
        <p class="offerDataAnswer"><?php echo $jobOffer->getJobPositionDescription()?></p>
        <p class="offerData">Descripción</p> 
        <p class="offerDataAnswer"><?php echo $jobOffer->getDescription()?></p>
        <p class="offerData">Salario</p> 
        <p class="offerDataAnswer"><?php echo $jobOffer->getSalary()?></p>
        <br>
        <?php
        }
    }else{
        ?>
        <div class="rejectionMessaje">
            <?php echo 'Usted no tiene aplicaciones por el momento'?>
        </div>
        <?php
    } 
    ?>
</section>   
<section>
    <a class="backButton" href="<?php echo FRONT_ROOT ?>Student/StudentView">Volver</a>
</section>     
  
</main>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>