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
            <br>
            <img src="../<?php echo $enterprise->getImagePath() ?>" class="img-thumbnail" alt="...">
            <br>
            <a href="<?php echo FRONT_ROOT ?>Enterprise/EnterpriseDetailsCompany?name=<?php echo  $loggedUser->getName()?>">Mis datos</a>
            <br>
        </section> 
        <section class="enterpriseStudentContainer">
            <p class="postulatesPicture"></p>
            <a href="<?php echo FRONT_ROOT ?>Apply/jobOfferWithAppliesCompanyView">Postulaciones</a>  
        </section> 
        <section class="searchStudentContainer">
         <p class="searchPicture"></p>
            <a href="<?php echo FRONT_ROOT ?>jobOffer/jobOfferListCompanyView?enterpriseName=<?php echo $loggedUser->getName()?>">Ofertas Laborales</a>
        </section>            
    </div>
    <section>
        <?php
        if($expiredOffers>0){
            ?>
            
            <a class="expiredOffers" href="<?php echo FRONT_ROOT ?>jobOffer/jobOfferListCompanyView?enterpriseName=<?php echo $loggedUser->getName()?>">Usted tiene<?php echo " " . $expiredOffers . " "?> oferta/as vencida/as. Debe actualizar o eliminar la misma.</a>
           
           <?php
        }
       ?>
    </section>   
</main>
<?php
    require_once ('companies.php');
    require_once ('contactForm.php');
?>