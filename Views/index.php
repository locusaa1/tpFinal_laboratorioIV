<?php
require_once('title.php');
require_once('nav.php');
/*
use Utility\UpdateDbUtility as UpdateDbUtility;

if(empty($_GET['alreadyUpdated']))
{
    $_GET['alreadyUpdated'] = false;
    UpdateDbUtility::DailyUpdate($_GET['alreadyUpdated']);
}

$actualTime = strtotime(date(('d M Y H:i:s')));
$updateTime = strtotime(date('d M Y' . ' 06:59:59'));

if(($_GET['alreadyUpdated']==true) && ($actualTime <= $updateTime))
{
    unset($_GET['alreadyUpdated']);
}
*/
if (!empty($_GET['adminError'])) {
    ?>
    <div class="rejectionMessaje">
        <?php
        echo "Usted no tiene permiso para la vista solicitada";
        ?>
    </div>
    <?php
}
?>
    <main class="">
        <section class="ourMision-Bg">
            <div class="ourMision">
                <p>Bienvenidos al portal de empleo de la Universidad Tecnológica Nacional.
                    <br>Este portal tiene como objetivo conectar a nuestros alumnos y egresados<br>
                    con una gran cantidad de empresas.
                </p>
            </div>
        </section>
    </main>
<?php
require_once('companies.php');
require_once('contactForm.php');
?>