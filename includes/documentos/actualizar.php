<?php
    require '../config/database.php';

    $db = conectarDb();

    $id = $_GET['id'];

    $query = "SELECT * FROM documentos WHERE ID = '$id'";

    $resultado = mysqli_query($db,$query);

    $campo = mysqli_fetch_assoc($resultado);

    require '../../assets/shared/header.php';
?>

<main class="container">
  <form action="update.php" method="POST" enctype="multipart/form-data" required>
      <input type="hidden" name="id" id="id" value="<?php echo $campo['id'] ?>">
    <div class="mb-3">
      <label for="titulo" class="form-label">Titulo </label>
      <input type="text" class="form-control form-control-lg" name="titulo" id="titulo" value="<?php echo $campo['titulo'] ?>" placeholder="Que docuemento se esta subiendo">
    </div>
    <div class="mb-3">
      <label for="descripcion" class="form-label">Descripción del documento</label>
      <textarea class="form-control form-control-lg" id="descripcion" name="descripcion" placeholder="Para que se usa el documento" rows="3"><?php echo $campo['descripcion'] ?></textarea>
    </div>
    <div class="input-group mb-3">
      <input type="file" class="form-control" accept=".pdf,.xlsx, .docx" value="<?php echo $campo['archivo'] ?>" name="archivo" id="archivo">
      <label class="input-group-text" for="archivo">Cargar</label>
    </div>
    <button class="btn btn-block btn-lg btn-success" type="submit">Subir</button>
  </form>
</main>
<?php
require '../../assets/shared/footer.php';