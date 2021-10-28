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
    <section class="enterpriseStudentListContainer">
        <?php    
        if(!empty($filterEnterpriseList)){
            ?>
            <div class="columnList"> 
                <?php      
                foreach ($filterEnterpriseList as $enterprise)
                {
                ?>
                    <a class="backButton" href="<?php echo FRONT_ROOT ?>Enterprise/EnterpriseDetails?name=<?php echo $enterprise->getName()?>"><?php echo $enterprise->getName()?></a>
                <?php 
                }
                ?>
            </div> 
            <?php
                
        }else{
             ?>
             <div class="columnList">  
                <?php      
                foreach ($list as $enterprise)
                {
                ?>
                    <a class="" href="<?php echo FRONT_ROOT ?>Enterprise/EnterpriseDetails?name=<?php echo $enterprise->getName()?>"><?php echo $enterprise->getName()?></a>
                    <br>
                <?php
                }
                ?>
            </div> 
            <?php
        }     
        
        if(!empty($filterEnterpriseList)){
        ?>
            <br><br>
            <a class="takeOffFilterButton" href="<?php echo FRONT_ROOT ?>Enterprise/EnterpriseListStudent">Quitar filtro</a>
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