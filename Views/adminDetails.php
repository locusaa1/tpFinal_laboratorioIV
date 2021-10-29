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
    <?php
    require_once('adminNav.php');
    ?>
    <div class="container-lg">
    <ul class="list-group ">
        <li class="list-group-item list-group-item-primary">Nombre: <?php echo $admin->getFirstName(); ?></li><br>
        <li class="list-group-item list-group-item-primary">Apellido: <?php echo $admin->getLastName(); ?></li><br>
        <li class="list-group-item list-group-item-primary">DNI: <?php echo $admin->getDni(); ?></li><br>
        <li class="list-group-item list-group-item-primary">Fecha de nacimiento: <?php echo $admin->getBirthDate(); ?></li><br>
        <li class="list-group-item list-group-item-primary">Género: <?php echo $admin->getGender(); ?></li><br>
        <li class="list-group-item list-group-item-primary">email: <?php echo $admin->getEmail(); ?></li><br>
        <li class="list-group-item list-group-item-primary">Télefono: <?php echo $admin->getPhoneNumber(); ?></li><br>
    </ul>
    </div>

</main>
