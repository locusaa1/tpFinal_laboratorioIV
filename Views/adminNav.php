<?php
use Utility\AdminUtility as AdminUtility;

AdminUtility::checkSessionStatus(isset($_SESSION['admin']));
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>Admin/details">Mi cuenta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo FRONT_ROOT ?>Enterprise/enterpriseList">Listar empresas</a>
            </li>
        </ul>
    </div>
</nav>
