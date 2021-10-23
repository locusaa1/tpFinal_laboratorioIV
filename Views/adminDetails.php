<?php
require_once('title.php');
require_once('nav.php');

use Utility\AdminUtility as AdminUtility;

AdminUtility::checkSessionStatus($_SESSION['user']);
?>
<main>
    <section class="ourMision-Bg">
        <div class="ourMision">
            <p>Información Personal</p>
        </div>
    </section>
    <div class="container-lg">
    <?php require_once('adminNav.php') ?>
    <ul class="list-group ">
        <li class="list-group-item list-group-item-primary">Nombre: <?php echo $_SESSION['admin']->getFirstName(); ?></li><br>
        <li class="list-group-item list-group-item-primary">Apellido: <?php echo $_SESSION['admin']->getLastName(); ?></li><br>
        <li class="list-group-item list-group-item-primary">DNI: <?php echo $_SESSION['admin']->getDni(); ?></li><br>
        <li class="list-group-item list-group-item-primary">Fecha de nacimiento: <?php echo $_SESSION['admin']->getBirthDate(); ?></li><br>
        <li class="list-group-item list-group-item-primary">Género: <?php echo $_SESSION['admin']->getGender(); ?></li><br>
        <li class="list-group-item list-group-item-primary">email: <?php echo $_SESSION['admin']->getEmail(); ?></li><br>
        <li class="list-group-item list-group-item-primary">Télefono: <?php echo $_SESSION['admin']->getPhoneNumber(); ?></li><br>
        <li class="list-group-item list-group-item-primary">Usuario: <?php echo $_SESSION['admin']->getUsername(); ?></li><br>
    </ul>
    </div>

</main>
