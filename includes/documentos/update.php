<?php
//iniciar la conexión a base de datos
require "../config/database.php";

//crear variable de conexión a base
$db = conectarDb();

//obtener los datos del forulariopor metodos
$id = $_POST['id'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];

//obtener los datos del archivo
$nombreArchivo = md5(uniqid(rand(), true)).'.pdf';
$tipoArchivo = $_FILES['archivo']['type'];
$tamañoArchivo = $_FILES['archivo']['size'];


if ($tamañoArchivo <= 10000000) {



    if ($tipoArchivo == "application/pdf") {
        //ruta de la carpeta almacenaje
        $carpetaDestino = $_SERVER['DOCUMENT_ROOT'] . '\assets\docs/';

        move_uploaded_file($_FILES['archivo']['tmp_name'], $carpetaDestino . $nombreArchivo);
    } else {
        echo 'solo se admiten pdf';
    }
} else {
    echo 'El tamaño excede el máximo permitido';
}
//mover la imagen de la carpeta temporal a la de destino

$sql = "UPDATE documentos SET titulo='$titulo', descripcion='$descripcion', archivo='$nombreArchivo' WHERE id = '$id'";

$resultado = mysqli_query($db, $sql);


if (!$resultado) {
    echo "Cambio Fallido";
}
header('location:../../carga-documentos.php');
