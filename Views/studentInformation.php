<?php
    require_once ('title.php');
    require_once('nav.php');
?>
<main class="">
   <section class="hello-Bg">
        <div class="hello">
            <?php
                if(isset($_SESSION['student'])){
                    $loggedUser = $_SESSION['student'];
                }
            ?>
            <p>¡Hola <?php echo " " . $loggedUser->getFirstName() . "!"?></p>
        </div>
    </section> 
    <section>
        <?php
        echo "Legajo N°: " . $loggedUser->getFileNumber() . "<br>";
        echo "Nombre completo: " . $loggedUser->getFirstName() . " " . $loggedUser->getLastName() . "<br>";
        echo "DNI N°: " . $loggedUser->getDni() . "<br>";
        echo "Fecha de nacimiento: " . $loggedUser->getBirthDate() . "<br>";
        echo "Email: " . $loggedUser->getEmail() . "<br>";
        echo "Teléfono: " . $loggedUser->getPhoneNumber() . "<br>";
        ?>
    </section>     
  
</main>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>