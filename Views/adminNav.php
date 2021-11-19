<?php
use Utility\AdminUtility as AdminUtility;

AdminUtility::checkSessionStatus($_SESSION['user']);
?>
    <br>
    <div>
        <p class="line"></p> 
    </div>
    <br> 
    <section class="adminNavContainer">  
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo FRONT_ROOT ?>Admin/details?userEmail=<?php echo $_SESSION['user']->getEmail(); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mi cuenta&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo FRONT_ROOT ?>Enterprise/enterpriseList">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Listar empresas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo FRONT_ROOT ?>JobOffer/jobOfferListView">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Listar ofertas laborales&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo FRONT_ROOT?>Admin/newAdminForm">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Generar Administrador&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>
    <br> 
    <div>
        <p class="line"></p> 
    </div> 
    <br>
    <br> 


