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
    <section>
    <?php
        if(!empty($_GET['enterpriseForDetail']))
        {
        $enterprise = $_GET['enterpriseForDetail'];
        
         echo "Nombre: " . $enterprise->getName() . "<br>";
         echo "Cuit: " . $enterprise->getCuit() . "<br>";
         echo "Teléfono: " . $enterprise->getPhoneNumber() . "<br>";
         echo "Dirección: " . $enterprise->getAddressName() . " " . $enterprise->getAddressNumber() . "<br>";
        
        }
    ?>
    </section>     
  
</main>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>