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
            <p>¡Hola <?php echo " " . $loggedUser->getFirstName() ."!"?></p>
        </div>
    </section> 
    <div class="studentOptions">
        <section class="profileContainer">
            <legend>Mi perfil</legend>
            <p class="profilePicture"></p>
            <a href="<?php echo FRONT_ROOT ?>Student/StudentInfo">Mis datos</a>
            <br>
            <a href="#">Información académica</a>
            <br>
            <a href="#">Mis postulaciones</a>  
            <br>
        </section> 
        <section>
            <a href="#">Empresas</a>  
        </section> 
        <section>
            <a href="#">Búsquedas abiertas</a>
        </section>            


    </div>   
</main>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>