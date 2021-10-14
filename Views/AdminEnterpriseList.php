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
        } elseif (isset($_GET['add'])) {

            if ($_GET['add'] == true) {

                echo 'The enterprise was successfully added';
            } else {

                echo 'The cuit already exists';
            }
        } elseif(isset($_GET['delete'])) {

            echo 'The enterprise was successfully updated';
        }
        ?>
    </p>
    <?php require_once('adminAside.php'); ?>
    <section class="">
        <form class="container" action="<?php echo FRONT_ROOT ?>Enterprise/actionProcess" method="get">
            <button class="enterpriseButton" type="submit" name="action" value="create">Create New Enterprise</button>
            <section class="list-group">
                <?php
                foreach ($list as $enterprise) {
                    echo '<li class="list-group-item">';
                    echo 'name: ' . $enterprise->getName() . '<br>';
                    echo 'cuit: ' . $enterprise->getCuit() . '<br>';
                    echo 'phone: ' . $enterprise->getPhoneNumber() . '<br>';
                    echo 'address: ' . $enterprise->getAddressName() . ' ' . $enterprise->getAddressNumber() . '<br>'; ?>
                    <button class="enterpriseButton" type="submit" name="action"
                            value="update/<?php echo $enterprise->getCuit() ?>">Update
                    </button>
                    <button class="enterpriseButton" type="submit" name="action"
                            value="delete/<?php echo $enterprise->getCuit() ?>">Delete
                    </button>
                    <?php echo '</li>'; ?>
                    <br>
                <?php } ?>
            </section>
        </form>
    </section>
</main>
