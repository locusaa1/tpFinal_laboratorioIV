<?php
require_once('title.php');
require_once('nav.php');
?>

<form action="<?php echo FRONT_ROOT ?>Admin/LogIn" method="post" class="loginForm">
    <div class="loginContainer">
        <label>Administration login</label>
        <label for="email">Email</label>
        <input type="email" class="inputUsername" placeholder="example@asd.com" required>
        <label for="password">Password</label>
        <input type="password" class="inputUsername" placeholder="****">
    </div>
</form>
<?php
require_once ('companies.php');
require_once ('contactForm.php');
?>