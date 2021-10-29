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
    <p>
        <?php
        if(!empty($_GET['getIn']))
        {
            if (empty($filterEnterpriseList))
            {?>
             <div class="rejectionMessaje">
                 <?php echo 'No se encontraron resultados'?>
             </div>
            <?php
            }
            unset($_GET['getIn']);
        }     
        ?>
    </p>
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
    <section class="enterpriseStudentListContainer">
        <?php    
        if(!empty($filterList)){
            ?>
            <div class="columnList"> 
                <?php      
                foreach ($filterList as $jobOffer)
                {
                ?>
                    <a class="backButton" href="<?php echo FRONT_ROOT ?>Enterprise/EnterpriseDetails?name=<?php echo $enterprise->getName()?>"><?php echo $jobOffer->getIdJobOffer()?></a>
                <?php 
                }
                unset($filterList);
                ?>
            </div> 
            <?php
                
        }
        ?>  
    <br><br>
</main>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>