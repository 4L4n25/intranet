<?php

require '../funciones.php';

$auth = autenticado();

if(!$auth){
    header('location:../../login.php');
}


require '../config/database.php';

$db = conectarDb();



$title = '';
$descripcion = '';
$color = '';
$colorText = '';
$fechaInicio = '';
$fechaFin = '';

$errores = [];
$ok = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($db,$_POST['titulo']);
    $descripcion = mysqli_real_escape_string($db,$_POST['descripcion']);
    $color = mysqli_real_escape_string($db,$_POST['color']);
    $colorText = mysqli_real_escape_string($db,$_POST['colorText']);
    $fechaInicio = mysqli_real_escape_string($db,$_POST['fechaInicio']);
    $fechaFin = mysqli_real_escape_string($db,$_POST['fechaFin']);

    if (!$title) {
        $errores[] = 'El titulo es obligatorio';
    }

    if (!$color) {
        $errores[] = 'Selecciona un color para el fondo';
    }

    if (!$colorText) {
        $errores[] = 'Selecciona un color para las letras';
    }

    if (!$fechaInicio) {
        $errores[] = 'la fecha de inicio es obligatoria';
    }

    if (empty($errores)) {
        $sql = "INSERT INTO calendario (title,description,start,end,color,textColor)
        VALUES('$title','$descripcion','$fechaInicio','$fechaFin','$color','$colorText')";

        $resultado = mysqli_query($db, $sql);

        if (!$resultado) {
            $errores[] = 'Uupss a ocurrido un error intenta de nuevo mas tarde';
        } else {
            $ok = 'Evento guardado con exito :3';
        }
    }
}
require '../../assets/shared/header.php';
?>
<main class="container mt-5">
    <div class="text-center">
        <h1>Calendario de eventos</h1>
    </div>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach;

    if ($ok === 'Evento guardado con exito :3') {
        echo '<div class="alerta success">' . $ok . '</div>';
    }
     ?>

    <form action="calendario.php" method="POST">
        <div class="mb-3">
            <label for="tituloEvento" class="form-label">Titulo del evento</label>
            <input type="text" class="form-control" id="tituloEvento" name="titulo" placeholder="Nombre del evento">
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripcion</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="link del evento en caso de ser necesaria">
        </div>
        <div class="text-center d-flex justify-content-evenly my-5">
            <div>
                <label for="color" class="form-label">Seleccione un color para el fondo</label>
                <input type="color" class="form-control form-control-color mx-auto" id="color" name="color" value="#563d7c" title="Choose your color">
            </div>
            <div>
                <label for="colorText" class="form-label">Seleccione un color para las letras</label>
                <input type="color" value="#ffffff" class="form-control form-control-color mx-auto" id="colorText" name="colorText" value="#563d7c" title="Choose your color">
            </div>
        </div>
        <div class="d-flex justify-content-evenly">
            <div>
                <label class="label-date" for="fechaInicio">Inicio del evento</label>
                <input type="datetime-local" class="input-date" name="fechaInicio" id="fechaInicio">
            </div>
            <div>
                <label class="label-date" for="fechaFin">fin del evento</label>
                <input type="datetime-local" class="input-date" name="fechaFin" id="fechaFin">
            </div>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-lg btn-block btn-secondary">Enviar</button>
        </div>
    </form>

    <?php require '../tablas/evento.php' ?>
</main>


<!--Modal-->

<div class="modal" id="confirm-delete" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Eliminar Evento </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Deseas eliminar este evento?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger btn-ok">Borrar</a>
            </div>
        </div>
    </div>
</div>

<?php

require '../../assets/shared/footer.php';

?>