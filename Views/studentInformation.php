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
    <section class="studentInfo">
        <legend>Mis datos</legend>
        <p class="data">Legajo</p> 
        <p class="dataAnswer"><?php echo $loggedUser->getFileNumber()?></p>
        <p class="data">Nombre completo</p> 
        <p class="dataAnswer"><?php echo $loggedUser->getFirstName() . " " . $loggedUser->getLastName()?></p>
        <p class="data">DNI</p> 
        <p class="dataAnswer"><?php echo $loggedUser->getDni()?></p>
        <p class="data">Fecha de nacimiento</p> 
        <p class="dataAnswer"><?php echo $loggedUser->getBirthDate()?></p>
        <p class="data">Email</p> 
        <p class="dataAnswer"><?php echo $loggedUser->getEmail()?></p>
        <p class="data">Teléfono</p> 
        <p class="dataAnswer"><?php echo $loggedUser->getPhoneNumber()?></p>
        <p class="data"><br></p>
    </section>   
    <section>
        <a class="backButton" href="<?php echo FRONT_ROOT ?>Student/StudentView">Volver</a>
    </section>     
  
</main>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>