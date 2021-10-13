<?php
require_once('title.php');
require_once('nav.php');

if (!isset($_SESSION['admin'])) {
    $_GET['log'] = 'null';
    require_once (VIEWS_PATH.'AdminsLogin.php');
}
?>
<main>
    <section class="ourMision-Bg">
        <div class="ourMision">
            <p>Personal Information</p>
        </div>
    </section>
    <?php require_once('adminAside.php') ?>
    <ul class="list-group personalInfo">
        <li class="list-group-item">First Name: <?php echo $_SESSION['admin']->getFirstName(); ?></li><br>
        <li class="list-group-item">Last Name: <?php echo $_SESSION['admin']->getLastName(); ?></li><br>
        <li class="list-group-item">DNI: <?php echo $_SESSION['admin']->getDni(); ?></li><br>
        <li class="list-group-item">BirthDate: <?php echo $_SESSION['admin']->getBirthDate(); ?></li><br>
        <li class="list-group-item">Gender: <?php echo $_SESSION['admin']->getGender(); ?></li><br>
        <li class="list-group-item">Email: <?php echo $_SESSION['admin']->getEmail(); ?></li><br>
        <li class="list-group-item">Phone Number: <?php echo $_SESSION['admin']->getPhoneNumber(); ?></li><br>
        <li class="list-group-item">username: <?php echo $_SESSION['admin']->getUsername(); ?></li><br>
    </ul>

</main>
