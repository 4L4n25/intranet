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

$errores = [];
$ok = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $descripcion = mysqli_real_escape_string($db,$_POST['compra']);
  $tipo = mysqli_real_escape_string($db,$_POST['tipo']);

  if (!$descripcion) {
    $errores[] = 'Describe el articulo, porque lo necesitas y agrega un link de compra';
  }


  if (empty($errores)) {
    $sql = "INSERT INTO solicitudes (tipo, descripcion,idusuarios) VALUES ('$tipo','$descripcion',1)";

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
  <h1>Solicitud de compra</h1>
</div>
<main class="container">
  <form action="compras.php" method="POST">

    <?php foreach ($errores as $error) : ?>
      <div class="alerta error">
        <?php echo $error ?>
      </div>
    <?php endforeach; ?>
    <?php if ($ok === 'Registro guardado con exito') {
      echo '<div class="alerta success">' . $ok . '</div>';
    } ?>
    <input type="hidden" value="compras" name="tipo">
    <div class="mb-3">
      <label for="compra" class="form-label">articulo(s) solicitado(s)</label>
      <textarea class="form-control form-control-lg" id="compra" name="compra" rows="3" placeholder="ej:computadora $14.000 link https://www.compras.com/computador"></textarea>
    </div>

    <button type="submit" class="btn btn-lg btn-block btn-info">Solicitar</button>
  </form>
</main>


<?php
require "/intranet/assets/shared/footer.php";
?>