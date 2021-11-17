<?php
require_once('title.php');
require_once('nav.php');
use Utility\AdminUtility as AdminUtility;

AdminUtility::checkSessionStatus($_SESSION['user']);
?>
<main class="">
    <section class="ourMision-Bg">
        <div class="ourMision">
            <p>Creando una nueva empresa</p>
        </div>
    </section>
    <?php require_once('adminNav.php'); ?>
    <div class="row m-3">
        <div class="col w-100">
            <div class="card bg-info">
                <div class="card-body">
                    <form action="<?php echo FRONT_ROOT ?>Enterprise/enterpriseForm" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <div class="alert alert-primary">
                                <p>Todos los campos son requeridos.</p>
                            </div><br>
                            <label>Suba una imagen de la empresa:</label>
                            <input type="file" name="enterpriseImage"><br>
                            <label for="name">Nombre:</label><br>
                            <input class="form-control form-control-lg" type="text" id="name" name="name" value="" required
                                   placeholder="nombre"><br><br>
                            <label>Email:</label><br>
                            <input type="text" class="form-control form-control-lg" name="email" required><br>
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
                            <button class="btn btn-success btn-lg btn-block" type="submit" name="action" value="create">Crear</button>
                            <button class="btn btn-dark btn-lg btn-block" type="reset">Refrescar</button>
                        </div>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include_once('companies.php');
include_once('footer.php');
?>