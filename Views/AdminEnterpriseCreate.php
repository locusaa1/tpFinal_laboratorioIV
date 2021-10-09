<?php
require_once('title.php');
require_once('nav.php');

use Controllers\EnterpriseController as EnterpriseController;

?>
<main class="">
    <section class="ourMision-Bg">
        <div class="ourMision">
            <p>Creating a new enterprise</p>
        </div>
    </section>
    <form action="<?php echo FRONT_ROOT ?>Enterprise/Add" method="post">
        <label>All the fields are required</label><br>
        <label for="name">Name:</label><br>
        <input type="text" name="name" value="" required placeholder="example"><br>
        <label for="cuit">Cuit:</label><br>
        <input type="number" name="cuit" value="" required placeholder="111111"><br>
        <label for="phoneNumber">Phone number:</label><br>
        <input type="number" name="phoneNumber" value="" required placeholder="223-example"><br>
        <label for="addres"></label>
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
                <input type="radio" name="enterprise" value="<?= $enterprise; ?>" required>
                <br>
            <?php } ?>
        </ul>
    </form>
</main>