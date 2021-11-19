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
            <p>Postulaciones</p>
        </div>
    </section>
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
                    <h2 class="titleMessaje">Postulaciones Activas</h2>
                <?php
                if(!empty($activeAppliesList)){
                    foreach ($activeAppliesList as $studentAppliedDTO)
                    {
                    ?>
                    
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

                        <a class="applyButton" href="<?php echo FRONT_ROOT ?>Apply/dismissApplicationByCompany?idApply=<?php echo $studentAppliedDTO->getIdApply()?>&idJobOffer=<?php echo $studentAppliedDTO->getIdJobOffer()?>&userType=<?php echo $_SESSION['user']->getUserType() ?>">Desestimar aplicación</a>
                        <br>
                    </div>    
                    <?php
                    }
                }else{
                    ?>
                    <div class="backButton">
                    <?php echo 'No hay postulaciones activas en esta oferta'?>
                    </div>
                    <?php
                }
                ?>
                <br><br>
                <h2 class="titleMessaje">Postulaciones Desestimadas</h2>
                <?php
                if($flag==false){
                    ?>
                     <a class="backButton" href="<?php echo FRONT_ROOT ?>Apply/companyJobOfferAppliesDetails?idJobOffer=<?php echo $jobOfferAppliesDTO->getIdJobOffer()?>&flag=<?php echo true?>">Ver</a>
                    <?php
                    }
                if($flag){
                if(!empty($notActiveAppliesList)){
                    foreach ($notActiveAppliesList as $studentAppliedDTO)
                    {
                    ?>
                    
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
                }else{
                    ?>
                    <div class="backButton">
                    <?php echo 'No hay postulaciones desestimadas en esta oferta'?>
                    </div>
                    <?php
                }
                
        
            }
        }
        
        ?>  
    </section>
    <section>
        <br><br><br>
        <a class="backButton" href="<?php echo FRONT_ROOT ?>Apply/jobOfferWithAppliesCompanyView">Volver</a>
    </section>   
</main>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>