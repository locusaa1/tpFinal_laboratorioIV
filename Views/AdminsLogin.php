<?php
require_once('title.php');
require_once('nav.php');

use Controllers\AdminController as AdminController;

?>
<p><?php if (isset($_GET['log'])){echo "The username or password are incorrect";} ?></p>
<?php
if (isset($_SESSION['admin'])){
    $controller = new AdminController();
    $controller->AdminView();
}else{
?>
<form action="<?php echo FRONT_ROOT ?>Admin/Login" method="post" class="loginForm">
    <div class="loginContainer">
        <legend>Administration login</legend>
        <label for="username">Email</label>
        <input type="text" name="username" class="inputUsername" placeholder="example@asd.com" required>
        <label for="password">Password</label>
        <input type="password" name="password" class="inputUsername" placeholder="****">
        <button class="loginButton" type="submit">Login</button>
    </div>
</form>
<?php
}
require_once ('companies.php');
require_once ('contactForm.php');
?>