<?php
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
            if (empty($_SESSION['similarArray']))
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
    <?php
        if (!empty($_SESSION['similarArray'])){?>
            <form action="<?php echo FRONT_ROOT?>Enterprise/EnterpriseDetails" method="get" class="enterpriseStudentListContainer">
                <?php
                foreach ($_SESSION['similarArray'] as $enterprise){
                ?>
                <input type="radio" value="<?= $enterprise->getName()?>" name="name" required>
                <label for="name"><?php echo $enterprise->getName()?></label><br>
                    <?php }
                    unset($_SESSION['similarArray']);
                    ?>
                    <button class="detailButton" type="submit">Ver Detalle de empresa</button>
            </form>
            <a class="backButton" href="<?php echo FRONT_ROOT ?>Student/EnterpriseList">Quitar filtro</a>


            <?php
        }else{
            
            ?>
            <form action="<?php echo FRONT_ROOT ?>Enterprise/EnterpriseDetails" method="GET" class="enterpriseStudentListContainer">
            <?php
            foreach ($_SESSION['enterpriseList'] as $enterprise)
            {
                ?>
                    <input type="radio" value="<?= $enterprise->getName()?>" name="name" required>
                    <label for="name"><?php echo $enterprise->getName()?></label>
                    <br>
                <?php

            }
            ?>
            <button class="detailButton" type="submit">Ver detalle de empresa</button>
            </form>
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