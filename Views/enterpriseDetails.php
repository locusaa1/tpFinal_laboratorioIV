<?php
    require_once ('title.php');
    require_once('nav.php');
?>
<main class="">
   <section class="hello-Bg">
        <div class="hello">
            <p>Detalle de empresa</p>
        </div>
    </section> 
    <section class="enterpriseStudentDetailContainer">
    <?php
        if(!empty($_GET['enterpriseForDetail']))
        {
        $enterprise = $_GET['enterpriseForDetail'];
        ?>
        <legend><?php echo $enterprise->getName()?></legend>
        <p class="data">Cuit</p> 
        <p class="dataAnswer"><?php echo $enterprise->getCuit()?></p>
        <p class="data">Teléfono</p> 
        <p class="dataAnswer"><?php echo $enterprise->getPhoneNumber()?></p>
        <p class="data">Dirección</p> 
        <p class="dataAnswer"><?php echo $enterprise->getAddressName() . " " . $enterprise->getAddressNumber()?></p>
         <p class="data"><br></p>
         <?php
        }
    ?>
    </section> 
    <section>
        <a class="backButton" href="<?php echo FRONT_ROOT ?>Student/EnterpriseList">Volver al listado</a>
    </section>    
  
</main>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>