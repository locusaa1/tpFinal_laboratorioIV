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
        <?php require_once('adminAside.php'); ?>
        <form class="enterpriseForm" action="<?php echo FRONT_ROOT ?>Enterprise/Add" method="post">
            <label>
                <?php
                if (isset($_GET['update'])) {
                    echo 'The actual info into the fields are the actual data into the file';

                } else {
                    echo 'All the fields are required';
                }
                ?>
            </label><br>
            <label for="name">Name:</label><br>
            <input type="text" name="name" value="" required
                   placeholder="<?php echo $message = (isset($_GET['update'])) ? $_GET['update']->getName() : 'example' ?>"><br>
            <label for="cuit">Cuit:</label><br>
            <input type="number" name="cuit" value="" required <?php if(isset($_GET['update'])){echo 'disabled';} ?>
                   placeholder="<?php echo $message = (isset($_GET['update'])) ? $_GET['update']->getCuit() : '1111' ?>"><br>
            <label for="phoneNumber">Phone number:</label><br>
            <input type="number" name="phoneNumber" value="" required
                   placeholder="<?php echo $message = (isset($_GET['update'])) ? $_GET['update']->getPhoneNumber() : '223-example' ?>"><br>
            <label for="addressName">AddressName</label><br>
            <input type="text" name="addressName" value="" required
                   placeholder="<?php echo $message = (isset($_GET['update'])) ? $_GET['update']->getAddressName() : 'example' ?>"><br>
            <label for="addressNumber">AddressNumber</label><br>
            <input type="text" name="addressNumber" value="" required
                   placeholder="<?php echo $message = (isset($_GET['update'])) ? $_GET['update']->getAddressNumber() : '123' ?>"><br>
            <button class="enterpriseButton" type="submit"><?php echo $message = ($_GET['update']) ? 'Update' : 'Create'; ?></button>
            <button class="enterpriseButton" type="reset">Reset</button>
            </ul>
        </form>
    </main>