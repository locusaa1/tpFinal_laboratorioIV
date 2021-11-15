<?php
include_once('title.php');
include_once('nav.php');
include_once('adminNav.php');
?>
<main>
    <div class="w-100">
        <?php
        if (isset($message)) {
            if (strcmp($message, 'El registro se almacenó con éxito en la base de datos') == 0) {

                echo '<div class="alert-success w-100" role="alert">
                      <h5 class="alert-heading">Completado</h5>
                      <p>' . $message . '</p>
                      </div>';
            } else {

                echo '<div class="alert-danger w-100" role="alert">
                      <h5 class="alert-heading">Error</h5>
                      <p>' . $message . '</p><br>
                      <p>Posiblemente el dni, email o teléfono están repetidos.</p>
                      </div>';
            }
        }
        ?>
        <div class="row mr-3 ml-3 mt-3">
            <div class="col w-100">
                <div class="card bg-info">
                    <div class="card-body">
                        <h3 class="card-title text-center">Complete todos los datos del formulario</h3><br>
                        <div class="card-body">
                            <form class="text-center" action="<?php echo FRONT_ROOT ?>Admin/newAdminFormAction"
                                  method="post">
                                <label>Nombre</label><br>
                                <input type="text" name="firstName" placeholder="Nombre del administrador" class="w-50"
                                       required><br><br>
                                <label>Apellido</label><br>
                                <input type="text" name="lastName" placeholder="Apellido del administrador" class="w-50"
                                       required><br><br>
                                <label>DNI</label><br>
                                <label>(será la contraseña inicialmente)</label><br>
                                <input type="text" name="dni"><br><br>
                                <label>Genero</label><br>
                                <label>Hombre</label> <input type="radio" name="gender" value="Hombre" required><br>
                                <label>Mujer</label> <input type="radio" name="gender" value="Mujer" required><br><br>
                                <label>Fecha de nacimiento</label><br>
                                <input type="date" name="birthDate" required><br><br>
                                <label>Número de teléfono</label><br>
                                <input type="text" name="phoneNumber" required><br><br>
                                <label>Email</label><br>
                                <label>(parámetro para ingresar en la plataforma)</label><br>
                                <input type="email" name="email" required><br>
                                <button type="submit" class="btn btn-success btn-block">Crear</button>
                                <button type="reset" class="btn btn-danger btn-block">Limpiar información</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include_once('companies.php');
include_once('footer.php');
?>
