<?php
require_once('title.php');
require_once('nav.php');
?>
<p>
    <?php
   
    if(!empty($_GET['wrongRepeatedPassword']))
    {   
        ?>
        <div class="rejectionMessaje">
        <?php
        echo "Las contraseñas deben coincidir. Ingrese nuevamente";
        unset($_GET['wrongRepeatedPassword']);
        ?>
        </div>
        <?php
    }

    ?>
</p>
<form action="<?php echo FRONT_ROOT ?>User/NewUser" method="post" class="loginForm">
    <div class="loginContainer">
        <legend>Nuevo Usuario</legend>
        <label for="email">Email</label>
        <input type="text" name="email" class="inputUsername" placeholder="example@asd.com" required>
        <label for="password">Contraseña</label>
        <input type="password" name="password" class="inputUsername" placeholder="****" required>
        <label for="repeatedPassword">Repetir contraseña</label>
        <input type="password" name="repeatedPassword" class="inputUsername" placeholder="****" required>
        
    </div>
    <button class="backButton" type="submit">Registrarme</button>
</form>
<section>
    <a class="backButton" href="<?php echo FRONT_ROOT ?>Home/LoginUser">Volver</a>
</section>
</div>
<?php

require_once ('companies.php');
require_once ('contactForm.php');
?>