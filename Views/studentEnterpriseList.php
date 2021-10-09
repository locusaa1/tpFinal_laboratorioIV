<?php
    require_once ('title.php');
    require_once('nav.php');
    use Controllers\EnterpriseController as EnterpriseController;
?>
<main class="">
    <p>
        <?php
        if(!empty($_GET['enterpriseNotFounded']))
        {
            ?>
            <div class="rejectionMessaje">
            <?php
            echo "No se han encontrado resultados";
            ?>
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
    <section>
        <form action="<?php echo FRONT_ROOT ?>Enterprise/FilterByName" method="POST" class="loginForm">
            <label for="name">Filtrar empresas por nombre</label>
            <input type="text" name="name" class="inputUsername">
            <button class="loginButton" type="submit">Filtrar</button>
        </form>
    </section>
    <section>
    <?php
        if(!empty($_GET['enterpriseFounded'])){
            $enterprise = $_GET['enterpriseFounded'];
            ?>
            <form action="<?php echo FRONT_ROOT ?>Enterprise/EnterpriseDetails" method="GET">
                <input type="radio" value="<?= $enterprise->getName()?>" name="name" required>
                <label for="name"><?php echo $enterprise->getName()?></label>
                <button class="loginButton" type="submit">Ver detalle</button>
            </form>
            
            
            <?php
        }else{
            $companies = new EnterpriseController();
            $list = $companies->getEnterprisesList();
            ?>
            <form action="<?php echo FRONT_ROOT ?>Enterprise/EnterpriseDetails" method="GET">
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