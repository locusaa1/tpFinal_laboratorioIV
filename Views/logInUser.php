<?php
require_once('title.php');
require_once('nav.php');
?>

    <p>
<?php

if (!empty($_GET['userNotFounded'])) {
    ?>
    <div class="rejectionMessaje">
        <?php
        echo "Email no registrado. Intente nuevamente o pulse el botón Registrarme";
        unset($_GET['userNotFounded']);
        ?>
    </div>
    <?php
}

if (!empty($_GET['adminLog'])) {
    ?>
    <div class="rejectionMessaje">
        <?php
        echo "Primero tiene que iniciar sesión";
        ?>
    </div>
    <?php
}

if (!empty($_GET['userAlreadyRegistered'])) {
    ?>
    <div class="rejectionMessaje">
        <?php
        echo "El email ya se encuentra registrado. Inicie sesión";
        unset($_GET['userAlreadyRegistered']);
        ?>
    </div>
    <?php
}

if (!empty($_GET['wrongPassword'])) {
    ?>
    <div class="rejectionMessaje">
        <?php
        echo "Contraseña incorrecta. Intente nuevamente";
        unset($_GET['wrongPassword']);
        ?>
    </div>
    <?php
}
if (!empty($_GET['emailInvalidStudent'])) {
    ?>
    <div class="rejectionMessaje">
        <?php
        echo "Email no encontrado en la UTN. Intente nuevamente o comuniquesé con la universidad";
        unset($_GET['emailInvalidStudent']);
        ?>
    </div>
    <?php
}

if (!empty($_GET['notActiveEnterprise'])) {
    ?>
    <div class="rejectionMessaje">
        <?php
        echo "Empresa no registrada en la UTN. Intente nuevamente o comuniquesé con la universidad";
        unset($_GET['notActiveEnterprise']);
        ?>
    </div>
    <?php
}

if (!empty($_GET['notActiveStudent'])) {
    ?>
    <div class="rejectionMessaje">
        <?php
        echo "Ingreso denegado. Usted no se encuentra activo en la UTN";
        unset($_GET['notActiveStudent']);
        ?>
    </div>
    <?php
}
?>
    </p>
    <div >
        <form action="<?php echo FRONT_ROOT ?>User/LoginUser" method="post" class="loginForm">
            <div class="loginContainer">
                <legend>Iniciar Sesión</legend>
                <label for="email">Email</label>
                <input type="email" name="email" class="inputUsername" placeholder="example@asd.com" required>
                <label for="password">Contraseña</label>
                <input type="password" name="password" class="inputUsername" placeholder="****">
            </div>
            <button class="offerButton" type="submit">Iniciar sesión</button>
        </form>
        <section>
            <a class="backButton" href="<?php echo FRONT_ROOT ?>Home/UserTypeQuestion">Registrarme</a>
        </section>
    </div>
<?php

require_once('companies.php');
require_once('contactForm.php');
?>