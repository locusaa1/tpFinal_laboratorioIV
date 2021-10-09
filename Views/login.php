<?php
    require_once ('title.php');
    require_once('nav.php');
?>
<p>
    <?php
    if(!empty($_GET['emailInvalid']))
    {   
        ?>
        <div class="rejectionMessaje">
        <?php
        echo "Email no encontrado. Intente nuevamente";
        ?>
        </div>
        <?php
    }
    if(!empty($_GET['notActive']))
    {
        ?>
        <div class="rejectionMessaje">
        <?php
        echo "Ingreso denegado. Usted no se encuentra activo";
        ?>
        </div>
        <?php
    }
        ?>
</p>

<form action="<?php echo FRONT_ROOT ?>Student/CheckEmail" method="POST" class="loginForm">
    <div class="loginContainer">
        <legend>Ingrese su correo electrónico</legend>
        <label for="email">Email</label>
        <input type="email" name="email" class="inputUsername" placeholder="Ej: nombre@gmail.com" required>
    </div>
    <button class="loginButton" type="submit">Iniciar Sesión</button>
</form>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>
          