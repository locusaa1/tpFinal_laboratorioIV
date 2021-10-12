<?php
    require_once ('title.php');
    require_once('nav.php');

    use Controllers\HomeController as HomeController;

    session_destroy();

    $controller = new HomeController();
    $controller->Index();


    require_once ('companies.php');
    require_once ('contactForm.php');
?>