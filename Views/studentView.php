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
    <div class="studentOptions">
        <section class="profileContainer">
            <legend>Mi perfil</legend>
            <p class="profilePicture"></p>
            <a href="<?php echo FRONT_ROOT ?>Student/StudentInfo">Mis datos</a>
            <br>
            <a href="<?php echo FRONT_ROOT ?>Student/StudentAcademicInformation">Información académica</a>
            <br>
            <a href="<?php echo FRONT_ROOT ?>Student/StudentApplyView">Mis postulaciones</a>  
            <br>
        </section> 
        <section class="enterpriseStudentContainer">
            <p class="enterprisePicture"></p>
            <a href="<?php echo FRONT_ROOT ?>Enterprise/EnterpriseListStudent">Empresas</a>  
        </section> 
        <section class="searchStudentContainer">
         <p class="searchPicture"></p>
            <a href="<?php echo FRONT_ROOT ?>JobOffer/jobOfferStudentView">Búsquedas abiertas</a>
        </section>            
    </div>   
</main>
<?php
    require_once ('companies.php');
    require_once ('contactForm.php');
?>