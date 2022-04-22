<?php

require '../../assets/shared/header.php';

require '../config/database.php';
$id = $_GET['id'];

$db = conectarDb();

$sql = "SELECT * FROM calendario WHERE id='$id'";

$resultado = mysqli_query($db,$sql);

$calendario = mysqli_fetch_assoc($resultado);
?>

<main class="container mt-5">
    <div class="text-center">
        <h1>Actualizar eventos</h1>
    </div>
    <form action="update.php" method="POST">
        <input type="hidden" value="<?php echo $calendario['id'] ?>" name="id" id="id">
        <div class="mb-3">
            <label for="tituloEvento" class="form-label">Titulo del evento</label>
            <input type="text" class="form-control" id="tituloEvento" name="titulo" value="<?php echo $calendario['title'] ?>" placeholder="Nombre del evento">
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripcion</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $calendario['description'] ?>" placeholder="Descripcion del evento">
        </div>
        <div class="text-center d-flex justify-content-evenly my-5">
            <div>
                <label for="color" class="form-label">Seleccione un color para el fondo</label>
                <input type="color" class="form-control form-control-color mx-auto" id="color" name="color" value="<?php echo $calendario['color'] ?>" title="Choose your color">
            </div>
            <div>
                <label for="colorText" class="form-label">Seleccione un color para las letras</label>
                <input type="color" class="form-control form-control-color mx-auto" id="colorText" name="textColor" value="<?php echo $calendario['textColor'] ?>" title="Choose your color">
            </div>
        </div>
        <div class="d-flex justify-content-evenly">
            <div>
                <label class="label-date" for="fechaInicio">Inicio del evento</label>
                <input type="datetime-local" class="input-date" name="inicio" id="fechaInicio" value="<?php echo $calendario['start'] ?>"> 
            </div>
            <div>
                <label class="label-date" for="fechaFin">fin del evento</label>
                <input type="datetime-local" class="input-date" name="fin" id="fechaFin" value="<?php echo $calendario['end'] ?>">
            </div>
        </div>
        <div class="text-center">
        <span class="font-error">Selecionar fecha ya que no se colocan las anteriores</span>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-lg btn-block btn-secondary">Enviar</button>
        </div>
    </form>
</main>


<?php

require '../../assets/shared/footer.php';