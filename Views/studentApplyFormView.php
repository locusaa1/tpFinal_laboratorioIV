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
            <p>Aplicación</p>
        </div>
    </section>
    <p>
        <?php
        if(!empty($_GET['noCareerCoincidence']))
        {
        ?>
            <div class="rejectionMessaje">
                <?php echo 'Su carrera no está autorizada para aplicar a la oferta'?>
            </div>
            <?php
            unset($_GET['noCareerCoincidence']);
        } 

        if(!empty($_GET['alreadyApplied']))
        {
        ?>
            <div class="rejectionMessaje">
                <?php echo 'Usted ya aplicó a esta oferta laboral.'?>
            </div>
            <?php
            unset($_GET['alreadyApplied']);
        } 

        if(!empty($_GET['successfulApplication']))
        {
        ?>
            <div class="rejectionMessaje">
                <?php echo 'Su aplicación ha sido exitosa'?>
            </div>
            <?php
            unset($_GET['successfulApplication']);
        } 
        
        ?>
    </p>
    <section class="">
        <?php    
        if(!empty($jobOfferDTO)){
            ?>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/JobOfferApplying" method="POST" enctype="multipart/form-data" class="ApplyForm" >
                <div class="studentApplyContainer">
                    <br>
                    <p class="offerData">Empresa</p> 
                    <p class="offerDataAnswer"><?php echo $jobOfferDTO->getEnterpriseName()?></p>
                    <p class="offerData">Posición</p> 
                    <p class="offerDataAnswer"><?php echo $jobOfferDTO->getJobPositionDescription()?></p>
                    <br>
                    <input type="hidden" name="userId" value="<?= $_SESSION['user']->getIdUser()?>">
                    <input type="hidden" name="email" value="<?= $_SESSION['user']->getEmail()?>">
                    <input type="hidden" name="jobOfferId" value="<?= $jobOfferDTO->getIdJobOffer()?>">
                    <label for="coverLetter" class="offerData">Escribí una breve presentación</label>
                    <textarea name="coverLetter" class="inputApply" required></textarea>
                    <br>
                    <label for="resume" class="offerData">Subí tu CV</label>
                    <input type="file" name="resume" class="inputUsername" required>
                </div> 
                <button class="offerButton" type="submit">Aplicar</button>
            </form> 
            
            <?php
                
        }
        ?>  
    </section>
    <section>
        <a class="backButton" href="<?php echo FRONT_ROOT ?>JobOffer/jobOfferStudentView">Volver</a>
    </section>   
</main>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>