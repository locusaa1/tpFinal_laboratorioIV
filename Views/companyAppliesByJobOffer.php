<?php
    if(!isset($_SESSION['user'])){
          
        require_once(VIEWS_PATH."index.php");
        }
    
    if(isset($_SESSION['user'])){
    
        if($_SESSION['user']->getUserType()!="company")
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
            <p>Detalle de las postulaciones</p>
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
        if(!empty($jobOfferAppliesDTO)){
            ?>
                <div class="studentOffersListContainer">
                    <br>
                    <p class="offerData">Posición</p> 
                    <p class="offerDataAnswer"><?php echo $jobOfferAppliesDTO->getJobPositionDescription()?></p>
                    <p class="offerData">Carrera</p> 
                    <p class="offerDataAnswer"><?php echo $jobOfferAppliesDTO->getCareerName()?></p>
                    <p class="offerData">Descripción</p> 
                    <p class="offerDataAnswerDescription"><?php echo $jobOfferAppliesDTO->getDescription()?></p>
                    <p class="offerData">Salario</p> 
                    <p class="offerDataAnswer"><?php echo $jobOfferAppliesDTO->getSalary()?></p>
                    <p class="offerData">Fecha de publicación</p> 
                    <p class="offerDataAnswerDate"><?php echo $jobOfferAppliesDTO->getStartDate()?></p>
                    <p class="offerData">Fecha de cierre</p> 
                    <p class="offerDataAnswerDate"><?php echo $jobOfferAppliesDTO->getLimitDate()?></p>
                    <p class="offerData">Total de postulados</p> 
                    <p class="offerDataAnswerDate"><?php echo $jobOfferAppliesDTO->getTotalApplications()?></p>
                    <p class="offerData">Postulados activos</p> 
                    <p class="offerDataAnswerDate"><?php echo $jobOfferAppliesDTO->getActiveApplications()?></p>
                    <br> 
                </div>
                    <br><br> 

                <?php
                if(!empty($activeAppliesList)){
                    foreach ($activeAppliesList as $studentAppliedDTO)
                    {
                    ?>
                    <h2 class="titleMessaje">Postulaciones Activas</h2>
                    <br><br> 
                    <div class="companyAppliesListContainer">
                        <br>
                        <p class="offerData">Nombre</p> 
                        <p class="offerDataAnswer"><?php echo $studentAppliedDTO->getStudentName()?></p>
                        <p class="offerData">Email</p> 
                        <p class="offerDataAnswer"><?php echo $studentAppliedDTO->getStudentEmail()?></p>
                        <p class="offerData">Teléfono</p> 
                        <p class="offerDataAnswer"><?php echo $studentAppliedDTO->getStudentPhone()?></p>
                        <p class="offerData">Carta de presentación</p> 
                        <p class="offerDataAnswerDescription"><?php echo $studentAppliedDTO->getCoverLetter()?></p>
                        <p class="offerData">Currículum Vitae</p> 
                        <a href="../<?php echo $studentAppliedDTO->getResume()?> ?>" class="downloadButton" download="">Descargar CV</a>
                        <br>
                        <a class="applyButton" href="<?php echo FRONT_ROOT ?>Apply/dismissApplicationByCompany?idApply=<?php echo $studentAppliedDTO->getIdApply()?>&idJobOffer=<?php echo $studentAppliedDTO->getIdJobOffer()?>">Desestimar aplicación</a>
                        <br>
                    </div>    
                    <?php
                    }
                }

                if(!empty($notActiveAppliesList)){
                    foreach ($notActiveAppliesList as $studentAppliedDTO)
                    {
                    ?>
                    <h2 class="titleMessaje">Postulaciones Inactivas</h2>
                    <br><br> 
                    <div class="companyAppliesListContainer">
                        <br>
                        <p class="offerData">Nombre</p> 
                        <p class="offerDataAnswer"><?php echo $studentAppliedDTO->getStudentName()?></p>
                        <p class="offerData">Email</p> 
                        <p class="offerDataAnswer"><?php echo $studentAppliedDTO->getStudentEmail()?></p>
                        <p class="offerData">Teléfono</p> 
                        <p class="offerDataAnswer"><?php echo $studentAppliedDTO->getStudentPhone()?></p>
                        <p class="offerData">Carta de presentación</p> 
                        <p class="offerDataAnswerDescription"><?php echo $studentAppliedDTO->getCoverLetter()?></p>
                        <p class="offerData">Currículum Vitae</p> 
                        <a href="../<?php echo $studentAppliedDTO->getResume()?> ?>" class="downloadButton" download="">Descargar CV</a>
                        <br>
                    </div>    
                    <?php
                    }
                }
                
        }
        ?>  
    </section>
    <section>
        <br><br>
        <a class="backButton" href="<?php echo FRONT_ROOT ?>Apply/jobOfferWithAppliesCompanyView">Volver</a>
    </section>   
</main>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>