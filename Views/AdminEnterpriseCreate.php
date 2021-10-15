<?php
require_once('title.php');
require_once('nav.php');

use Utility\AdminUtility as AdminUtility;

AdminUtility::checkSessionStatus(isset($_SESSION['admin']));
?>
<main class="">
    <section class="ourMision-Bg">
        <div class="ourMision">
            <p>Creating a new enterprise</p>
        </div>
    </section>
    <?php require_once('adminNav.php'); ?>
    <form action="<?php echo FRONT_ROOT ?>Enterprise/enterpriseForm" method="post">
        <div class="form-group">
            <div class="alert alert-primary">
                <p>Todos los campos son requeridos.</p>
            </div><br>
            <label for="name">Nombre:</label><br>
            <input class="form-control form-control-lg" type="text" id="name" name="name" value="" required
                   placeholder="nombre"><br>
            <label for="cuit">Cuit:</label><br>
            <input class="form-control form-control-lg" type="number" id="cuit" name="cuit" value="" required
                   placeholder="cuit sin guiones"><br>
            <label for="phoneNumber">Teléfono:</label><br>
            <input class="form-control form-control-lg" type="number" id="phoneNumber" name="phoneNumber" value="" required
                   placeholder="teléfono sin guiones"><br>
            <label for="addressName">Dirección:</label><br>
            <input class="form-control form-control-lg" type="text" id="addressName" name="addressName" value="" required
                   placeholder="calle"><br>
            <label for="addressNumber">Altura:</label><br>
            <input class="form-control form-control-lg" type="text" id="addressNumber" name="addressNumber" value="" required
                   placeholder="altura"><br>
            <button class="btn btn-outline-primary btn-lg btn-block" type="submit" name="action" value="create">Crear</button>
            <button class="btn btn-outline-dark btn-lg btn-block" type="reset">Refrescar</button>
        </div>
        </ul>
    </form>
</main>