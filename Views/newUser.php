<?php
require_once('title.php');
require_once('nav.php');
?>
<p>
    <?php
    if(!empty($_GET['userAlreadyRegistered']))
    {   
        ?>
        <div class="rejectionMessaje">
        <?php
        echo "El email ya se encuentra registrado. Inicie sesión";
        unset($_GET['userAlreadyRegistered']);
        ?>
        </div>
        <?php
    }

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
<form action="<?php echo FRONT_ROOT ?>User/LoginUser" method="post" class="loginForm">
    <div class="loginContainer">
        <legend>Ingreso</legend>
        <label for="email">Email</label>
        <input type="text" name="email" class="inputUsername" placeholder="example@asd.com" required>
        <label for="password">Contraseña</label>
        <input type="password" name="password" class="inputUsername" placeholder="****">
        <label for="repeatedPassword">Repetir contraseña</label>
        <input type="password" name="repeatedPassword" class="inputUsername" placeholder="****">
        <button class="loginButton" type="submit">Registrarme</button>
    </div>
</form>
<section>
    <a class="backButton" href="<?php echo FRONT_ROOT ?>Home/LoginUser">Volver</a>
</section>
</div>
<?php

require_once ('companies.php');
require_once ('contactForm.php');
?>