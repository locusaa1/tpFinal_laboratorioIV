<?php
require_once('title.php');
require_once('nav.php');

use Controllers\EnterpriseController as EnterpriseController;

?>
<main class="">
    <section class="ourMision-Bg">
        <div class="ourMision">
            <p>Listing the enterprises</p>
        </div>
    </section>
    <p>
        <?php
        if (isset($_GET['delete'])) {
            echo 'The enterprise where successfully removed';
        }
        ?>
    </p>
    <?php require_once('adminAside.php'); ?>
    <section class="">
        <form class="container" action="<?php echo FRONT_ROOT ?>Enterprise/ActionProcess" method="get">
            <button class="enterpriseButton" type="submit" name="action" value="creat">Create New Enterprise</button>
            <section class="list-group">
                <?php
                foreach ($list as $enterprise) {
                    echo '<li class="list-group-item">';
                    echo 'name: ' . $enterprise->getName() . '<br>';
                    echo 'cuit: ' . $enterprise->getCuit() . '<br>';
                    echo 'phone: ' . $enterprise->getPhoneNumber() . '<br>';
                    echo 'address: ' . $enterprise->getAddressName() . ' ' . $enterprise->getAddressNumber() . '<br>'; ?>
                    <input type="hidden" name="enterpriseCuit" value="<?= $enterprise->getCuit() ?>" required>
                    <button class="enterpriseButton" type="submit" name="action" value="update/<?php echo $enterprise->getCuit() ?>">Update</button>
                    <button class="enterpriseButton" type="submit" name="action" value="delete/<?php echo $enterprise->getCuit() ?>">Delete</button>
                    <?php echo '</li>'; ?>
                    <br>
                <?php } ?>
            </section>
        </form>
    </section>
</main>
