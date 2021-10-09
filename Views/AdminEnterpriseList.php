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
    <form action="#" method="post">
        <button name="action" value="delete">delete</button>
        <button name="action" value="update">update</button>
        <button name="action" value="create">create</button>
        <ul>
            <?php
            $controller = new EnterpriseController();
            $list = $controller->getEnterprisesList();
            foreach ($list as $enterprise) {
                echo '<li>';
                echo 'name: ' . $enterprise->getName() . '<br>';
                echo 'cuit: ' . $enterprise->getCuit() . '<br>';
                echo 'phone: ' . $enterprise->getPhoneNumber() . '<br>';
                echo 'address: ' . $enterprise->getAddress() . '<br>';
                echo '</li>'; ?>
                <input type="radio" name="enterpriseCuit" value="<?= $enterprise->getCuit(); ?>" required>
                <br>
            <?php } ?>
        </ul>
    </form>
</main>
