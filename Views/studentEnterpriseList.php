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
            <p>Empresas</p>
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
    <section class="filterByNameContainer">
        <form action="<?php echo FRONT_ROOT ?>Enterprise/FilterByName" method="POST" class="filterForm" >
            <label for="name">Filtrar empresas por nombre</label>
            <input type="text" name="name" class="inputFilter" required>
            <button class="filterButton" type="submit">Filtrar</button>
        </form>
    </section>
    <section>
        <form action="<?php echo FRONT_ROOT?>Enterprise/EnterpriseDetails" method="get" class="enterpriseStudentListContainer">
            <?php    
            if(!empty($filterEnterpriseList)){
               
               foreach ($filterEnterpriseList as $enterprise)
               {
                ?>
                <input type="radio" value="<?= $enterprise->getName()?>" name="name" required>
                <label for="name"><?php echo $enterprise->getName()?></label><br>
                <?php 
                }
               
            }else{
                
                foreach ($list as $enterprise)
                {
                ?>
                    <input type="radio" value="<?= $enterprise->getName()?>" name="name" required>
                    <label for="name"><?php echo $enterprise->getName()?></label>
                    <br>
                <?php
                }
        
            }
            ?>
            <button class="detailButton" type="submit">Ver Detalle de empresa</button>
        </form> 
        <?php
        if(!empty($filterEnterpriseList)){
            ?>
            <a class="backButton" href="<?php echo FRONT_ROOT ?>Enterprise/EnterpriseListStudent">Quitar filtro</a>
            <?php
        }   
        ?>
    </section>
    <br>
    <section>
        <a class="backButton" href="<?php echo FRONT_ROOT ?>Student/StudentView">Volver</a>
    </section>   
</main>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>