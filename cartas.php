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


$descripcion = '';
$carta = '';

$errores = [];
$ok = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $descripcion = mysqli_real_escape_string($db,$_POST['descripcion']);
    $carta = mysqli_real_escape_string($db,$_POST['carta']);
    $tipo = mysqli_real_escape_string($db,$_POST['tipo']);

    if (!$descripcion) {
        $errores[] = 'Describe cual es el motivo por el que requieres esta carta';
    }

    if (!$carta) {
        $errores[] = 'Por favor selecciona el tipo de carta de requieres';
    }


    if (empty($errores)) {
        $sql = "INSERT INTO solicitudes (tipo, descripcion,requerimiento,idusuarios) VALUES ('$tipo','$descripcion','$carta',1)";
        $resultado = mysqli_query($db, $sql);

        if (!$resultado) {
            $errores[] = "registro fallido";
        } else {
            $ok = 'Registro guardado con exito';
        }
    }
}

require "/intranet/assets/shared/header.php";
?>
<div class="text-center mt-3">
    <h1>Solicitud de cartas</h1>
</div>

<main class="container">
    <form action="cartas.php" method="POST">

        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>
        <?php endforeach; ?>
        <?php if ($ok === 'Registro guardado con exito') {
            echo '<div class="alerta success">' . $ok . '</div>';
        } ?>

        <input type="hidden" value="carta" name="tipo">
        <div class="mb-3">
            <label for="descripcion" class="form-label">Explica para que y cuando la requieres</label>
            <textarea class="form-control form-control-lg" name="descripcion" id="descripcion" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="carta" class="form-label">Tipo de carta</label>
            <select class="form-select" name="carta" aria-label="Default select example">
                <option selected disabled>--Selecciona una opción--</option>
                <option value="servicio">Servicio social</option>
                <option value="recomendacion">Recomendación</option>
            </select>
        </div>

        <button type="submit" class="btn btn-lg btn-block btn-info">Solicitar</button>
    </form>
</main>

<?php
require "/intranet/assets/shared/footer.php";
?>