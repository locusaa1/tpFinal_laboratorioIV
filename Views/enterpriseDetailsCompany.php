<?php
    if(!isset($_SESSION['user'])){
          
    require_once(VIEWS_PATH."index.php");
    }
    
    if(isset($_SESSION['user'])){
    
        if($_SESSION['user']->getUserType()!="company")
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
            <p>Detalle de empresa</p>
        </div>
    </section> 
    <section class="enterpriseStudentDetailContainer">
    <?php
        if($enterprise)
        {
        ?>
        <legend><?php echo $enterprise->getName()?></legend>
        <br>
        <img src="../<?php echo $enterprise->getImagePath() ?>" class="img-thumbnail" alt="...">
        <br>
        <br>
        <p class="dataDetail">Cuit</p> 
        <p class="dataAnswerDetail"><?php echo $enterprise->getCuit()?></p>
        <p class="dataDetail">Teléfono</p> 
        <p class="dataAnswerDetail"><?php echo $enterprise->getPhoneNumber()?></p>
        <p class="dataDetail">Dirección</p> 
        <p class="dataAnswerDetail"><?php echo $enterprise->getAddressName() . " " . $enterprise->getAddressNumber()?></p>
         <p class="dataDetail"><br></p>
         <?php
        }
    ?>
    </section> 
    <section>
        <a class="backButton" href="<?php echo FRONT_ROOT ?>Enterprise/companyView">Volver</a>
    </section>    
  
</main>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>