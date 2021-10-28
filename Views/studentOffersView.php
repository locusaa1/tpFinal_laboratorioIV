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
        <form action="<?php echo FRONT_ROOT ?>Enterprise/FilterByName" method="POST" class="filterForm" >
            <div class="filterJobOffersSections">
                <section> 
                    <label for="career">Carrera</label>
                    <select name="career" class="career">
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
                    <label for="enterprise">Empresa</label>
                    <select name="enterprise" class="enterprise">
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
                    <label for="keyWord">Posición o palabra clave</label>
                    <input type="text" name="keyWord" class="keyWord">
                </section>
            </div>
            <a class="offerButton" href="<?php echo FRONT_ROOT ?>Home/NewUser">Buscar ofertas</a>
        </form>
    </section>
    <br><br>
</main>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>