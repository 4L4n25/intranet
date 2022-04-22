<?php

require 'includes/funciones.php';

$auth = autenticado();

if(!$auth){
    header('location:login.php');
}else{
    if((time()-$_SESSION['time'])>900){
        header('Location:logout.php');
    }
}
require 'includes/config/database.php';

$db = conectarDb();

$nombre = '';
$apellido = '';
$departamento = '';
$cargo = '';
$correo = '';
$celular = '';
$extension = '';
$pass = '';
$passCon = '';
$password = '';
$role = '';
//arreglo para errores
$errores = [];
//ejecutar el codigo cuando se envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($db, $_POST['apellido']);
    $departamento = mysqli_real_escape_string($db, $_POST['departamento']);
    $cargo = mysqli_real_escape_string($db, $_POST['cargo']);
    $correo = mysqli_real_escape_string($db, $_POST['correo']);
    $celular = mysqli_real_escape_string($db, $_POST['celular']);
    $extension = mysqli_real_escape_string($db, $_POST['extension']);
    $pass = mysqli_real_escape_string($db, $_POST['contresenia']);
    $passCon = mysqli_real_escape_string($db, $_POST['contreseniaCon']);
    $role = $_POST['role'];

    //obtener los datos de la imagen
    $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
    $tipoImagen = $_FILES['imagen']['type'];
    $tamañoImagen = $_FILES['imagen']['size'];

    //Errores
    if ($pass === $passCon) {
        $password = password_hash($pass, PASSWORD_BCRYPT);
    } else {
        $errores[] = 'Las contraseñas no coinciden';
    }
    if (!$nombre) {
        $errores[] = 'Ingresa un nombre';
    }
    if (!$apellido) {
        $errores[] = 'Ingresa un apellido';
    }
    if (!$departamento) {
        $errores[] = 'Ingresa un departamento';
    }
    if (!$cargo) {
        $errores[] = 'Ingresa un cargo';
    }
    if (!$correo ) {
        $errores[] = 'Ingresa un correo valido';
    }
    if (!$celular) {
        $errores[] = 'Ingresa un celular';
    }
    $imagen = $_FILES['imagen'];
    if (!$imagen['name'] || $imagen['error']) {
        $errores[] = 'La imagen es obligatoria';
    }

    $medida = 5000 * 10000;

    if (empty($errores)) {

        if ($tamañoImagen <= $medida) {

            if ($tipoImagen == 'image/jpeg' || $tipoImagen == 'image/jpg' || $tipoImagen == 'image/png') {
                //ruta de la carpeta almacenaje
                $carpetaDestino = $_SERVER['DOCUMENT_ROOT'] . '\assets\images/';

                move_uploaded_file($_FILES['imagen']['tmp_name'], $carpetaDestino . $nombreImagen);
            } else {
                $errores[] = 'solo se admiten imagenes';
            }
        } else {
            $errores[] = 'El tamaño excede el máximo permitido';
        }

        $sql = "INSERT INTO usuarios (nombre,apellido,departamento,cargo,correo,celular,extension,imagen,contraseña, role_id) 
            VALUES ('$nombre','$apellido','$departamento','$cargo','$correo','$celular','$extension','$nombreImagen','$password','$role')";
        $query = mysqli_query($db, $sql);

        if (!$query) {
            echo 'Guardado Fallido';
        } else {
            header('Location:configuracion.php?resultado=1');
        }
    }
}

$resultado = $_GET['resultado'] ?? null;


require 'assets/shared/header.php';
?>
<main class="container mt-5">
    <div class="text-center mb-5">
        <h1>Usuarios</h1>
    </div>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>
    <?php if (intval($resultado) === 1) {
        echo '<div class="alerta success">Usuario Creado con exito</div>';
    } else if (intval($resultado) === 2) {
        echo '<div class="alerta success">Usuario Actualizado correctamente</div>';
    } else if (intval($resultado) === 3) {
        echo '<div class="alerta success">Usuario eliminado correctamente</div>';
    } ?>
    <form action="configuracion.php" method="POST" class="row" enctype="multipart/form-data">
        <div class="col-md-6 row mb-3">
            <label for="nombre" class="col-sm-2 col-form-label">Nombre(s)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control form-control-lg" value="<?php echo $nombre; ?>" id="nombre" name="nombre">
            </div>
        </div>
        <div class="col-md-6 row mb-3">
            <label for="apellido" class="col-sm-2 col-form-label">apellido(s)</label>
            <div class="col-sm-10">
                <input type="text" class="form-control form-control-lg" value="<?php echo $apellido; ?>" id="apellido" name="apellido">
            </div>
        </div>
        <div class="col-md-6 row mb-3">
            <label for="departamento" class="col-sm-2 col-form-label">Departamento</label>
            <div class="col-sm-10">
                <input type="text" class="form-control form-control-lg" id="departamento" value="<?php echo $departamento; ?>" name="departamento">
            </div>
        </div>
        <div class="col-md-6 row mb-3">
            <label for="cargo" class="col-sm-2 col-form-label">Cargo</label>
            <div class="col-sm-10">
                <input type="text" class="form-control form-control-lg" id="cargo" value="<?php echo $cargo; ?>" name="cargo">
            </div>
        </div>
        <div class="col-md-6 row mb-3">
            <label for="correo" class="col-sm-2 col-form-label">Correo</label>
            <div class="col-sm-10">
                <input type="mail" class="form-control form-control-lg" id="correo" value="<?php echo $correo; ?>" name="correo">
            </div>
        </div>
        <div class="col-md-6 row mb-3">
            <label for="celular" class="col-sm-2 col-form-label">Celular</label>
            <div class="col-sm-10">
                <input type="text" class="form-control form-control-lg" id="celular" value="<?php echo $celular; ?>" name="celular">
            </div>
        </div>
        <div class="col-md-6 row mb-3">
            <label for="extension" class="col-sm-2 col-form-label">Extensión</label>
            <div class="col-sm-10">
                <input type="number" class="form-control form-control-lg" id="extension" name="extension" value="<?php echo $extension; ?>">
            </div>
        </div>
        <div class="col-md-6 row mb-3">
            <label for="contraseña" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10 d-flex justify-content-center align-items-center">
                <input type="password" class=" form-control form-contol-lg" id="contraseña" name="contresenia">
                <i class="ms-2 fa-solid fa-eye-slash mostrar visually-hidden" onclick="mostrarContraseña()"></i>
                <i class="ms-2 fa-solid fa-eye ocultar" onclick="mostrarContraseña()"></i>
            </div>
        </div>
        <div class="col-md-6 row mb-3">
            <label for="contraseña-con" class="col-sm-2 col-form-label">Confirmar password</label>
            <div class="col-sm-10 d-flex justify-content-center align-items-center">
                <input type="password" class=" form-control form-contol-lg" id="contraseña-con" name="contreseniaCon">
                <i class="ms-2 fa-solid fa-eye-slash mostrar-con visually-hidden" onclick="mostrarContraseñaConfirmar()"></i>
                <i class="ms-2 fa-solid fa-eye ocultar-con" onclick="mostrarContraseñaConfirmar()"></i>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label class="col-sm-2 col-form-label">Role de usuario</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="role1" value="1">
                <label class="form-check-label" for="role1">Administrador</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="role2" value="2">
                <label class="form-check-label" for="role2">Moderador</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="role" id="role3" value="3">
                <label class="form-check-label" for="role3">Usuario</label>
            </div>
        </div>
        </div>
        <div class="col-md-6 input-group mb-3">
            <input type="file" class="form-control" name="imagen" id="imagen">
            <label class="input-group-text" for="imagen">Cargar</label>
        </div>
        <div class="text-center pb-2">
            <span class="font-error">Tamaño maximo permitodo 5MB</span>
        </div>

        <button type="submit" class="btn btn-lg btn-block btn-success">Enviar</button>
    </form>
    <hr>
    <?php require 'includes/tablas/usuario.php'; ?>
</main>


<?php
require 'assets/shared/footer.php';
