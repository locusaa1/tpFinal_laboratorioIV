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
            echo 'All the fields are required';
            ?>
        </label><br>
        <label for="name">Name:</label><br>
        <input type="text" name="name" value="" required
               placeholder="example"><br>
        <label for="cuit">Cuit:</label><br>
        <input type="number" name="cuit" value="" required
               placeholder="1111"><br>
        <label for="phoneNumber">Phone number:</label><br>
        <input type="number" name="phoneNumber" value="" required
               placeholder="223-example"><br>
        <label for="addressName">AddressName</label><br>
        <input type="text" name="addressName" value="" required
               placeholder="example"><br>
        <label for="addressNumber">AddressNumber</label><br>
        <input type="text" name="addressNumber" value="" required
               placeholder="123"><br>
        <button class="enterpriseButton" type="submit" name="action" value="create">Create</button>
        <button class="enterpriseButton" type="reset">Reset</button>
        </ul>
    </form>
</main>