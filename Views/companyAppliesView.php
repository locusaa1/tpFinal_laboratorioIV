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
            <p>Aplicaciones</p>
        </div>
    </section>
   
    <section class="filterJobOffersContainer">
        <form action="<?php echo FRONT_ROOT ?>Apply/companyJobOffersWithAppliesFilterList" method="POST" class="filterForm" >
            <div class="filterJobOffersSections">
                <section> 
                    <label for="careerFilter">Carrera</label>
                    <select name="careerFilter" class="career">
                    <?php
                    foreach($careerList as $career)
                    {
                        ?>
                        <option value=''></option>
                        <option value="<?=$career->getDescription()?>"><?php echo $career->getDescription()?></option>
                        <?php
                    }
                    ?>
                    </select>
                </section> 
                <section> 
                    <label for="positionFilter">Posiciones</label>
                    <select name="positionFilter" class="enterprise">
                        <?php
                        foreach($jobPositionFilterByCompanyList as $jobPosition)
                        {
                            ?>
                            <option value=''></option>
                            <option value="<?=$jobPosition->getDescription()?>"><?php echo $jobPosition->getDescription()?></option>
                            <?php
                        }
                        ?>
                    </select>
                </section>
                <section> 
                    <label for="keyWordFilter">Palabra clave / Posición</label>
                    <input type="text" name="keyWordFilter" class="keyWord">
                </section>
            </div>
            <button class="offerButton" type="submit">Ver aplicaciones</button>
        </form>
    </section>
    <p>
        <?php
        if(!empty($_GET['noMatchesFounded']))
        {
        ?>
            <div class="OffersMessajes">
            <?php echo 'No se encontraron resultados'?>
            </div>
            <?php
            unset($_GET['noMatchesFounded']);
        } 
        
        if(!empty($_GET['searchResults']))
        {
        ?>
            <div class="OffersMessajes">
            <?php echo $_GET['searchResults']?>
            </div>
            <?php
            unset($_GET['searchResults']);
        } 
        ?>
    </p>
    <section class="">
        <?php    
        if(!empty($jobOfferAppliesDTOList)){
            ?>
             
                <?php      
                foreach ($jobOfferAppliesDTOList as $jobOfferApplies)
                {
                ?>
                <br>
                <div class="studentOffersListContainer">
                    <br>
                    <p class="offerData">Posición</p> 
                    <p class="offerDataAnswer"><?php echo $jobOfferApplies->getJobPositionDescription()?></p>
                    <p class="offerData">Carrera</p> 
                    <p class="offerDataAnswer"><?php echo $jobOfferApplies->getCareerName()?></p>
                    <p class="offerData">Descripción</p> 
                    <p class="offerDataAnswerDescription"><?php echo $jobOfferApplies->getDescription()?></p>
                    <p class="offerData">Salario</p> 
                    <p class="offerDataAnswer"><?php echo $jobOfferApplies->getSalary()?></p>
                    <p class="offerData">Fecha de publicación</p> 
                    <p class="offerDataAnswerDate"><?php echo $jobOfferApplies->getStartDate()?></p>
                    <p class="offerData">Fecha de cierre</p> 
                    <p class="offerDataAnswerDate"><?php echo$jobOfferApplies->getLimitDate()?></p>
                    <p class="offerData">Total de postulados</p> 
                    <p class="offerDataAnswerDate"><?php echo$jobOfferApplies->getTotalApplications()?></p>
                    <p class="offerData">Postulados activos</p> 
                    <p class="offerDataAnswerDate"><?php echo$jobOfferApplies->getActiveApplications()?></p>
                    <p class="offerData"></p>
                    <a class="applyButton" href="#">Ver detalle</a>
                    <br>
                </div> 
               <?php 
                }
                unset($jobOfferAppliesDTOList);
                ?>
            
            <?php
                
        }
        ?>  
    <br><br>
    </section>
</main>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>