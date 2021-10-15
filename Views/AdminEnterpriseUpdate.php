<?php
require_once('title.php');
require_once('nav.php');
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
            <div class="alert alert-success">
                <p>La información dentro de los campos es la actual!</p>
                <hr>
                <p class="mb-0">Es posible rellenar un único campo para actualizar.</p>
            </div><br>
            <label for="name">Name:</label><br>
            <input class="form-control form-control-lg" type="text" id="name" name="name" value=""
                   placeholder="<?php echo $_GET['update']->getName() ?>"><br>
            <label for="phoneNumber">Phone number:</label><br>
            <input class="form-control form-control-lg" type="number" id="phoneNumber" name="phoneNumber" value=""
                   placeholder="<?php echo $_GET['update']->getPhoneNumber() ?>"><br>
            <input class="form-control form-control-lg" type="hidden" id="cuit" name="cuit" value="<?php echo $_GET['update']->getCuit() ?>" required
                   placeholder="1111">
            <label for="addressName">AddressName</label><br>
            <input class="form-control form-control-lg" type="text" id="addressName" name="addressName" value=""
                   placeholder="<?php echo $_GET['update']->getAddressName() ?>"><br>
            <label for="addressNumber">AddressNumber</label><br>
            <input class="form-control form-control-lg" type="text" id="addressNumber" name="addressNumber" value=""
                   placeholder="<?php echo $_GET['update']->getAddressNumber() ?>"><br>
            <button class="btn btn-outline-success btn-lg btn-block" type="submit" name="action" value="update">Actualizar</button>
            <button class="btn btn-outline-dark btn-lg btn-block" type="reset">Refrescar</button>
            </ul>
        </div>
    </form>
</main>