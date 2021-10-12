<?php
require_once('title.php');
require_once('nav.php');
?>
<main>
    <section class="ourMision-Bg">
        <div class="ourMision">
            <p>Personal Information</p>
        </div>
    </section>
    <?php require_once('adminAside.php') ?>
    <div class="personalInfo">
        <label>First Name: <?php echo $_SESSION['admin']->getFirstName(); ?></label><br>
        <label>Last Name: <?php echo $_SESSION['admin']->getLastName(); ?></label><br>
        <label>DNI: <?php echo $_SESSION['admin']->getDni(); ?></label><br>
        <label>BirthDate: <?php echo $_SESSION['admin']->getBirthDate(); ?></label><br>
        <label>Gender: <?php echo $_SESSION['admin']->getGender(); ?></label><br>
        <label>Email: <?php echo $_SESSION['admin']->getEmail(); ?></label><br>
        <label>Phone Number: <?php echo $_SESSION['admin']->getPhoneNumber(); ?></label><br>
        <label>username: <?php echo $_SESSION['admin']->getUsername(); ?></label><br>
    </div>

</main>
