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
        if (isset($_SESSION['delete'])) {
            echo 'The enterprise where successfully removed';
            unset($_SESSION['delete']);
        }
        ?>
    </p>
    <form action="<?php echo FRONT_ROOT ?>Enterprise/AddProcess" method="post">
        <button type="submit">create</button>
    </form>
    <form action="<?php echo FRONT_ROOT ?>Enterprise/ActionProcess" method="post">
        <button name="action" value="delete">delete</button>
        <button name="action" value="update">update</button>
        <ul>
            <?php
            $controller = new EnterpriseController();
            $list = $controller->getEnterprisesList();
            foreach ($list as $enterprise) {
                echo '<li>';
                echo 'name: ' . $enterprise->getName() . '<br>';
                echo 'cuit: ' . $enterprise->getCuit() . '<br>';
                echo 'phone: ' . $enterprise->getPhoneNumber() . '<br>';
                echo 'address: ' . $enterprise->getAddressName() . ' ' . $enterprise->getAddressNumber() . '<br>';
                echo '</li>'; ?>
                <input type="radio" name="enterpriseCuit" value="<?= $enterprise->getCuit(); ?>" required>
                <br>
            <?php } ?>
        </ul>
    </form>
</main>
