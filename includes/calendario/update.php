<?php 

require '../config/database.php';

$db = conectarDb();

$id='';
$titulo = '';
$descripcion = '';
$color = '';
$textColor = '';
$start = '';
$end = '';

$id = $_POST['id'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$color = $_POST['color'];
$textColor = $_POST['textColor'];
$start = $_POST['inicio'];
$end = $_POST['fin'];

$sql = "UPDATE calendario SET title='$titulo', description = '$descripcion', color= '$color', 
        textColor = '$textColor', start = '$start', end = '$end' WHERE id ='$id'";

echo '<pre>';
var_dump($sql);
echo '</pre>';

$resultado = mysqli_query($db,$sql);

if(!$resultado){
    echo 'Upss a ocurrido un error intenta de nuevo más tarde';
}

header('location:calendario.php');