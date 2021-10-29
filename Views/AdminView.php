<?php
require_once('title.php');
require_once('nav.php');

use Utility\AdminUtility as AdminUtility;

AdminUtility::checkSessionStatus(isset($_SESSION['user']));

?>
    <main class="">
        <section class="ourMision-Bg">
            <div class="ourMision">
                <p>Bienvenido</p>
            </div>
        </section>
        <?php
        require_once('adminNav.php');
        ?>
    </main>
<?php
require_once('companies.php');
require_once('contactForm.php');
?>