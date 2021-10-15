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
    <form class="enterpriseForm" action="<?php echo FRONT_ROOT ?>Enterprise/enterpriseForm" method="post">
        <label>
            <?php
                echo 'The actual info into the fields are the actual data into the file';
            ?>
        </label><br>
        <label for="name">Name:</label><br>
        <input type="text" name="name" value=""
               placeholder="<?php echo $_GET['update']->getName()?>"><br>
        <label for="phoneNumber">Phone number:</label><br>
        <input type="number" name="phoneNumber" value=""
               placeholder="<?php echo $_GET['update']->getPhoneNumber()?>"><br>
        <input type="hidden" name="cuit" value="<?php echo $_GET['update']->getCuit() ?>" required
               placeholder="1111">
        <label for="addressName">AddressName</label><br>
        <input type="text" name="addressName" value=""
               placeholder="<?php echo $_GET['update']->getAddressName() ?>"><br>
        <label for="addressNumber">AddressNumber</label><br>
        <input type="text" name="addressNumber" value=""
               placeholder="<?php echo $_GET['update']->getAddressNumber()?>"><br>
        <button class="enterpriseButton" type="submit" name="action" value="update">Update</button>
        <button class="enterpriseButton" type="reset">Reset</button>
        </ul>
    </form>
</main>