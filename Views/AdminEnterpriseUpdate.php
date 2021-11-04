<?php
require_once('title.php');
require_once('nav.php');

use Utility\AdminUtility as AdminUtility;

AdminUtility::checkSessionStatus($_SESSION['user']);
?>
<main class="">
    <section class="ourMision-Bg">
        <div class="ourMision">
            <p>Creating a new enterprise</p>
        </div>
    </section>
    <?php require_once('adminNav.php'); ?>
    <div class="alert alert-success">
        <p>La información dentro de los campos es la actual!</p>
        <hr>
        <p class="mb-0">Es posible rellenar un único campo para actualizar.</p>
    </div>
    <div class="row ml-3 mr-3">
        <div class="col w-100">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="../<?php echo $enterprise->getImagePath() ?>" class="img-thumbnail" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Campos solicitados</h5>
                            <form action="<?php echo FRONT_ROOT ?>Enterprise/enterpriseForm" enctype="multipart/form-data" method="post">
                                <div class="form-group">
                                    <label for="name">Name:</label><br>
                                    <input class="form-control form-control-lg" type="text" id="name" name="name"
                                           value=""
                                           placeholder="<?php echo $enterprise->getName() ?>"><br>
                                    <label for="phoneNumber">Phone number:</label><br>
                                    <input class="form-control form-control-lg" type="number" id="phoneNumber"
                                           name="phoneNumber" value=""
                                           placeholder="<?php echo $enterprise->getPhoneNumber() ?>"><br>
                                    <input class="form-control form-control-lg" type="hidden" id="cuit" name="cuit"
                                           value="<?php echo $enterprise->getCuit() ?>" required
                                           placeholder="1111">
                                    <label for="addressName">AddressName</label><br>
                                    <input class="form-control form-control-lg" type="text" id="addressName"
                                           name="addressName" value=""
                                           placeholder="<?php echo $enterprise->getAddressName() ?>"><br>
                                    <label for="addressNumber">AddressNumber</label><br>
                                    <input class="form-control form-control-lg" type="text" id="addressNumber"
                                           name="addressNumber" value=""
                                           placeholder="<?php echo $enterprise->getAddressNumber() ?>"><br>
                                    <label for="image">Actualizar la imágen</label><br>
                                    <input type="file" id="image" name="enterpriseImage"><br>
                                    <button class="btn btn-outline-success btn-lg btn-block" type="submit" name="action"
                                            value="update">Actualizar
                                    </button>
                                    <button class="btn btn-outline-dark btn-lg btn-block" type="reset">Refrescar
                                    </button>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include_once('companies.php');
include_once('footer.php');
?>