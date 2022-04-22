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

$fechaInicio = '';
$fechaFin = '';
$descripcion = '';

$errores = [];
$ok = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  $fechaInicio = $_POST['fechaInicio'];
  $fechaFin = $_POST['fechaFin'];
  $descripcion = $_POST['descripcion'];
  $tipo = $_POST['tipo'];

  if (!$fechaInicio) {
    $errores[] = 'La fecha en la que te vas es obligatoria';
  }

  if (!$fechaFin) {
    $errores[] = 'La fecha en la que te regresas es obligatoria';
  }


  if (empty($errores)) {
    $sql = "INSERT INTO solicitudes (tipo, fechainicio, fechafin , descripcion,idusuarios) VALUES ('$tipo','$fechaInicio','$fechaFin','$descripcion',1)";

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
  <h1>Solicitud de vacaciones</h1>
</div>
<main class="container">
  <form action="vacaciones.php" method="POST">
  <?php foreach ($errores as $error) : ?>
      <div class="alerta error">
        <?php echo $error ?>
      </div>
    <?php endforeach; ?>
    <?php if ($ok === 'Registro guardado con exito') {
      echo '<div class="alerta success">' . $ok . '</div>';
    } ?>
    <input type="hidden" value="vacaciones" name="tipo">
    <div class="mb-3">
      <label for="fechaInicio" class="form-label">Fecha inicio</label>
      <input type="date" id="fechaInicio" name="fechaInicio" value="<?php echo $fechaInicio ?>" required class="form-control form-control-lg" placeholder="Ingresa tu correo">
    </div>

    <div class="mb-3">
      <label for="fechaFin" class="form-label">Fecha final</label>
      <input type="date" id="fechaFin" name="fechaFin" required value="<?php echo $fechaFin ?>" class="form-control form-control-lg" placeholder="Ingresa tu correo">
    </div>
    <div class="mb-3">
      <label for="descripcion" class="form-label">Describe porque requieres tu vacaciones</label>
      <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?php echo $descripcion ?></textarea>
    </div>
    <button type="submit" class="btn btn-lg btn-block btn-info">Solicitar</button>
  </form>
</main>

<?php
require "/intranet/assets/shared/footer.php";
?>