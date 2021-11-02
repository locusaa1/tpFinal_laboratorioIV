<?php
   if(!isset($_SESSION['user'])){
          
    require_once(VIEWS_PATH."index.php");
    }

    if(isset($_SESSION['user'])){

      if($_SESSION['user']->getUserType()!="student")
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
        <?php
                if(isset($_SESSION['user'])){
                    $loggedUser = $_SESSION['user'];
                }
            ?>
            <p>¡Hola <?php echo " " . $loggedUser->getName() ."!"?></p>
        </div>
    </section> 
    <section class="studentInfo">
        <legend>Mis datos</legend>
        <p class="data">Legajo</p> 
        <p class="dataAnswer"><?php echo $student->getFileNumber()?></p>
        <p class="data">Nombre completo</p> 
        <p class="dataAnswer"><?php echo $student->getFirstName() . " " . $student->getLastName()?></p>
        <p class="data">DNI</p> 
        <p class="dataAnswer"><?php echo $student->getDni()?></p>
        <p class="data">Fecha de nacimiento</p> 
        <p class="dataAnswer"><?php echo date('d-m-Y', strtotime($student->getBirthDate()))?></p>
        <p class="data">Email</p> 
        <p class="dataAnswer"><?php echo $student->getEmail()?></p>
        <p class="data">Teléfono</p> 
        <p class="dataAnswer"><?php echo $student->getPhoneNumber()?></p>
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