<?php
    require_once ('title.php');
    require_once('nav.php');
?>
<form action="" method="POST" class="loginForm">
    <div class="loginContainer">
        <legend>Ingrese su correo electrónico</legend>
        <label for="username">Email</label>
        <input type="email" name="username" class="inputUsername" placeholder="Ej: nombre@gmail.com" required>
    </div>
    <button class="loginButton" type="submit">Iniciar Sesión</button>
</form>
<?php
require_once ('companies.php');
require_once ('contactForm.php')
?>
          