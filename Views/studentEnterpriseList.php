<?php
    require_once ('title.php');
    require_once('nav.php');
    use Controllers\EnterpriseController as EnterpriseController;
?>
<main class="">
    <p>
        <?php
        if (empty($_SESSION['similarArray']))
        {?>
         <div class="rejectionMessaje">
             <?php echo 'No match results'?>
         </div>
        <?php
        }
        ?>
    </p>
   <section class="hello-Bg">
        <div class="hello">
            <p>Empresas</p>
        </div>
    </section>
    <section class="filterByNameContainer">
        <form action="<?php echo FRONT_ROOT ?>Enterprise/FilterByName" method="POST" class="filterForm">
            <label for="name">Filtrar empresas por nombre</label>
            <input type="text" name="name" class="inputFilter">
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
                    <?php }?>
                    <button class="loginButton" type="submit">Details</button>
            </form>


            <?php
        }else{
            $companies = new EnterpriseController();
            $list = $companies->getEnterprisesList();
            ?>
            <form action="<?php echo FRONT_ROOT ?>Enterprise/EnterpriseDetails" method="GET" class="enterpriseStudentListContainer">
            <?php
            foreach ($list as $enterprise)
            {
                ?>
                    <input type="radio" value="<?= $enterprise->getName()?>" name="name" required>
                    <label for="name"><?php echo $enterprise->getName()?></label>
                    <br>
                <?php

            }
            ?>
            <button class="loginButton" type="submit">Ver detalle</button>
            </form>
            <?php
        }

    ?>
    </section>

</main>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>