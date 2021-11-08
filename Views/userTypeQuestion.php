<?php
require_once('title.php');
require_once('nav.php');
?>
<section class="questionContainer">
    <a class="IamButton" href="<?php echo FRONT_ROOT ?>Home/NewUserStudent">Soy estudiante</a>
    <a class="IamButton" href="<?php echo FRONT_ROOT ?>Home/NewUserCompany">Soy empresa</a>
</section>
<section>
    <br>
    <a class="backButton" href="<?php echo FRONT_ROOT ?>Home/LoginUser">Volver</a>
</section>
</div>
<?php

require_once ('companies.php');
require_once ('contactForm.php');
?>