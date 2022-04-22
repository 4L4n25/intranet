<?php
require 'includes/config/database.php';

require 'includes/funciones.php';

$auth = autenticado();

if(!$auth){
  header('location:login.php');
}else{
  if((time()-$_SESSION['time'])>900){
      header('Location:logout.php');
  }
}

$db = conectarDb();

$monto = '';
$cuenta = '';
$viaticos = '';
$fecha = '';

$errores = [];
$ok = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $monto = $_POST['monto'];
  $cuenta = $_POST['cuenta'];
  $viaticos = $_POST['viaticos'];
  $fecha = $_POST['fecha'];
  $tipo = $_POST['tipo'];

  if (!$monto) {
    $errores[] = 'El monto a pagar es obligatorio';
  }

  if (!$cuenta) {
    $errores[] = 'La cuenta en la que se te va a devolver es obligatoria';
  }

  if (!$viaticos) {
    $errores[] = 'El destino es obligatorio';
  }

  if (!$fecha) {
    $errores[] = 'La fecha del viaje es obligatoria';
  }

  //obtener los datos del archivo
  //generar nombre unico 
  $nombreArchivo = md5(uniqid(rand(), true)) . '.pdf';
  $tipoArchivo = $_FILES['pdf']['type'];
  $tamañoArchivo = $_FILES['pdf']['size'];

  if ($tamañoArchivo <= 10000000) {
    if ($tipoArchivo == "application/pdf" || $tipoArchivo == 'application/docx' || $tipoArchivo == 'application/xlsx') {
      //ruta de la carpeta almacenaje
      $carpetaDestino = $_SERVER['DOCUMENT_ROOT'] . '\assets\docs/';
      //mover la imagen de la carpeta temporal a la de destino
      move_uploaded_file($_FILES['pdf']['tmp_name'], $carpetaDestino . $nombreArchivo);
    } else {
      $errores[] = 'solo se admiten pdf';
    }
  } else {
    $errores[] = 'El tamaño excede el máximo permitido';
  }

  if (empty($errores)) {
    $sql = "INSERT INTO solicitudes (tipo, cuenta, destino,documento,fechainicio,monto,idusuarios) VALUES ('$tipo','$cuenta','$viaticos','$nombreArchivo','$fecha','$monto',1)";

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
  <h1>Solicitud de viaticos</h1>
</div>
<main class="container">
  <form action="viaticos.php" method="POST" enctype="multipart/form-data">
    <?php foreach ($errores as $error) : ?>
      <div class="alerta error">
        <?php echo $error ?>
      </div>
    <?php endforeach; ?>
    <?php if ($ok === 'Registro guardado con exito') {
      echo '<div class="alerta success">' . $ok . '</div>';
    } ?>
    <input type="hidden" value="viaticos" name="tipo">
    <div class="mb-3">
      <label for="monto" class="form-label">Monto solicitado</label>
      <input type="number" id="monto" name="monto" value="<?php echo $monto ?>" required class="form-control form-control-lg" placeholder="Gasto total">
    </div>
    <div class="mb-3">
      <label for="cuenta" class="form-label">N° Cuenta (N° tarjeta)</label>
      <input type="text" id="cuenta" name="cuenta" value="<?php echo $cuenta ?>" required class="form-control form-control-lg" placeholder="ejemplo: 0000-0000-0000-0000">
    </div>
    <div class="mb-3">
      <label for="pdf" class="form-label">Factura pdf</label>
      <input type="file" id="pdf" name="pdf" multiple accept=".pdf" required class="form-control form-control-lg">
    </div>
    <div class="mb-3">
      <label for="viaticos" class="form-label">Destino</label>
      <textarea class="form-control form-control-lg" name="viaticos" value="<?php echo $viaticos ?>" id="viaticos" rows="3" placeholder="Lugar al que acudiste"></textarea>
    </div>
    <div class="mb-3">
      <label for="fecha" class="form-label">Fecha de viaje</label>
      <input type="date" id="fecha" name="fecha" required class="form-control form-control-lg" value="<?php echo $fecha ?>">
    </div>
    <button type="submit" class="btn btn-lg btn-block btn-info">Solicitar</button>
  </form>
</main>

<?php
require "/intranet/assets/shared/footer.php";
?>