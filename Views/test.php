<?php
require_once ('title.php');
require_once ('nav.php');
require_once ('adminNav.php');
?>
<div class="table-responsive">
    <table id="theTable" class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>Name</td>
            <td>Address</td>
            <td>Gender</td>
            <td>Designation</td>
            <td>Age</td>
        </tr>
        </thead>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="application/javascript">
    $(document).ready( function () {
        $('#theTable').DataTable({
        });
    } );
</script>

<ul class="list-group">
    <?php
    foreach ($list as $enterprise) {
        echo '<li class="list-group-item">';
        echo 'Nombre: ' . $enterprise->getName() . '<br>';
        echo 'Cuit: ' . $enterprise->getCuit() . '<br>';
        echo 'Teléfono: ' . $enterprise->getPhoneNumber() . '<br>';
        echo 'Dirección: ' . $enterprise->getAddressName() . ' ' . $enterprise->getAddressNumber() . '<br>'; ?>
        <button class="btn btn-outline-success btn-lg btn-block" style="transform: rotate(0)" type="submit"
                name="action">
            <a class="btn-link stretched-link text-black-50 text-decoration-none"
               href="<?php echo FRONT_ROOT ?>/Enterprise/updateEnterprise?enterpriseCuit=<?php echo $enterprise->getCuit(); ?>">Actualizar</a>
        </button>
        <form action="<?php echo FRONT_ROOT ?>Enterprise/deleteEnterprise" method="post">
            <button class="btn btn-outline-danger btn-lg btn-block" type="submit" name="cuit"
                    value="<?php echo $enterprise->getCuit() ?>">Borrar
            </button>
        </form>
        <?php echo '</li>'; ?>
        <br>
    <?php } ?>
</ul>