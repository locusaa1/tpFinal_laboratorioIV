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
            $_GET['enterpriseForDetail'] = $enterprise;
            ?>
            <a href="<?php echo FRONT_ROOT ?>Enterprise/EnterpriseDetails"><?php echo $enterprise->getName() . '<br>'; ?></a> 
            <?php
        }else{
            $companies = new EnterpriseController();
            $list = $companies->getEnterprisesList();
            foreach ($list as $enterprise) 
            {
                $_GET['enterpriseForDetail'] = $enterprise;
                ?>
                <a href="<?php echo FRONT_ROOT ?>Enterprise/EnterpriseDetails"><?php echo $enterprise->getName() . '<br>'; ?></a> 
                <?php
                
            } 
        }
        
    ?>
    </section>     
  
</main>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>