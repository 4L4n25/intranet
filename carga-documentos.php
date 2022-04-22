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
//iniciar la conexión a base de datos
require "includes/config/database.php";

$titulo = '';
$descripcion = '';
$departamento = '';

$errores = [];
$ok = '';
//crear variable de conexión a base
$db = conectarDb();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //obtener los datos del forulariopor metodos
  $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
  $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
  $departamento = mysqli_real_escape_string($db, $_POST['departamento']);

  //obtener los datos del archivo
  //generar nombre unico 
  $nombreArchivo = md5(uniqid(rand(), true)) . '.pdf';
  $tipoArchivo = $_FILES['archivo']['type'];
  $tamañoArchivo = $_FILES['archivo']['size'];
  $archivo = $_FILES['archivo'];

  if (!$titulo) {
    $errores[] = 'Ingresa un nombre';
  }

  if (!$descripcion) {
    $errores[] =  'Ingresa un nombre';
  }

  if (!$departamento) {
    $errores[] =  'Selecciona un departamento';
  }

  if (!$archivo['name'] || $archivo['error']) {
    $errores[] = 'El archivo es obligatorio';
  }



  if (empty($errores)) {

    if ($tamañoArchivo <= 10000000) {
      if ($tipoArchivo == "application/pdf" || $tipoArchivo == 'application/docx' || $tipoArchivo == 'application/xlsx') {
        //ruta de la carpeta almacenaje
        $carpetaDestino = $_SERVER['DOCUMENT_ROOT'] . '\assets\docs/';
        //mover la imagen de la carpeta temporal a la de destino
        move_uploaded_file($_FILES['archivo']['tmp_name'], $carpetaDestino . $nombreArchivo);
      } else {
        $errores[] = 'solo se admiten pdf';
      }
    } else {
      $errores[] = 'El tamaño excede el máximo permitido';
    }

    $sql = "INSERT INTO documentos (titulo, descripcion, archivo) VALUES ('$titulo','$descripcion','$nombreArchivo')";
    $query = mysqli_query($db, $sql);

    if (!$query) {
      $errores[] = "registro fallido";
    } else {
      header('Location:carga-documentos.php?resultado=1');
    }
  }
}

$resultado = $_GET['resultado'] ?? null;

require 'assets/shared/header.php';
?>

<div class="text-center">
  <h1>Carga documentos</h1>
</div>
<main class="container">
  <?php foreach ($errores as $error) : ?>
    <div class="alerta error">
      <?php echo $error ?>
    </div>
  <?php endforeach; ?>
  <?php if (intval($resultado) === 1) {
    echo '<div class="alerta success">Documento Guardado con exito</div>';
  } else if (intval($resultado) === 2) {
    echo '<div class="alerta success">Documento Actualizado correctamente</div>';
  } else if (intval($resultado) === 3) {
    echo '<div class="alerta success">Documento eliminado correctamente</div>';
  } ?>
  <form action="carga-documentos.php" method="POST" enctype="multipart/form-data" required>
    <div class="mb-3">
      <label for="titulo" class="form-label">Titulo </label>
      <input type="text" class="form-control form-control-lg" name="titulo" id="titulo" value="<?php echo $titulo ?>" placeholder="Que docuemento se esta subiendo">
    </div>
    <div class="mb-3">
      <label for="descripcion" class="form-label">Descripción del documento</label>
      <textarea class="form-control form-control-lg" id="descripcion" name="descripcion" placeholder="Para que se usa el documento" rows="3"><?php echo $descripcion ?></textarea>
    </div>
    <div class="mb-3">
      <label for="departamento" class="form-label">Departamento al que pertence el documento</label>
      <select class="form-select form-select-lg mb-3" id="departamento" name="departamento" aria-label=".form-select-lg example">
        <option disabled selected>--Seleccione una opción--</option>
        <option value="administracion">Administracion</option>
        <option value="contabilidad">Contabilidad</option>
        <option value="legal">Legal</option>
        <option value="fiscal">Fiscal</option>
        <option value="sistemas">sistemas</option>
      </select>
    </div>
    <div class="input-group mb-3">
      <input type="file" class="form-control" accept=".pdf,.xlsx, .docx" name="archivo" id="archivo">
      <label class="input-group-text" for="archivo">Cargar</label>
    </div>

    <div class="text-center">
      <span class="text-center bg-danger text-white font-doc">Solo se admiten pdf</span>
    </div>
    <button class="btn btn-block btn-lg btn-success" type="submit">Subir</button>
  </form>
  <hr>
  <?php require 'includes/tablas/documento.php'; ?>
</main>
<?php
require 'assets/shared/footer.php'
?>