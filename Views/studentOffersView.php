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
            <p>Ofertas Laborales</p>
        </div>
    </section>
   
    <section class="filterJobOffersContainer">
        <form action="<?php echo FRONT_ROOT ?>JobOffer/studentJobOffersFilterList" method="POST" class="filterForm" >
            <div class="filterJobOffersSections">
                <section> 
                    <label for="careerFilter">Carrera</label>
                    <select name="careerFilter" class="career">
                    <?php
                    foreach($careerList as $career)
                    {
                        ?>
                        <option></option>
                        <option value="<?=$career->getDescription()?>"><?php echo $career->getDescription()?></option>
                        <?php
                    }
                    ?>
                    </select>
                </section> 
                <section> 
                    <label for="enterpriseFilter">Empresa</label>
                    <select name="enterpriseFilter" class="enterprise">
                        <?php
                        foreach($enterpriseList as $enterprise)
                        {
                            ?>
                            <option></option>
                            <option value="<?=$enterprise->getName()?>"><?php echo $enterprise->getName()?></option>
                            <?php
                        }
                        ?>
                    </select>
                </section>
                <section> 
                    <label for="keyWordFilter">Posición o palabra clave</label>
                    <input type="text" name="keyWordFilter" class="keyWord">
                </section>
            </div>
            <button class="offerButton" type="submit">Buscar ofertas</button>
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
        if(!empty($jobOfferDTOList)){
            ?>
             
                <?php      
                foreach ($jobOfferDTOList as $jobOffer)
                {
                ?>
                <br>
                <div class="studentOffersListContainer">
                    <br>
                    <img src="../<?php echo $jobOffer->getFlyer() ?>" class="img-thumbnail" alt="...">
                    <br>
                    <p class="offerData">Empresa</p> 
                    <p class="offerDataAnswer"><?php echo $jobOffer->getEnterpriseName()?></p>
                    <p class="offerData">Posición</p> 
                    <p class="offerDataAnswer"><?php echo $jobOffer->getJobPositionDescription()?></p>
                    <p class="offerData">Carrera</p> 
                    <p class="offerDataAnswer"><?php echo $jobOffer->getCareerName()?></p>
                    <p class="offerData">Descripción</p> 
                    <p class="offerDataAnswerDescription"><?php echo $jobOffer->getDescription()?></p>
                    <p class="offerData">Salario</p> 
                    <p class="offerDataAnswer"><?php echo $jobOffer->getSalary()?></p>
                    <p class="offerData">Fecha Inicio  /  Fecha Cierre</p> 
                    <p class="offerDataAnswerDate"><?php echo $jobOffer->getStartDate()?>  /  <?php echo $jobOffer->getLimitDate()?></p>
                    <p class="offerData"></p>
                    <a class="applyButton" href="<?php echo FRONT_ROOT ?>JobOffer/JobOfferApplyForm?id=<?php echo $jobOffer->getIdJobOffer()?>">Aplicar</a>
                    <br>
                </div> 
               <?php 
                }
                unset($jobOfferDTOList);
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