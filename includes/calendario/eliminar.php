<?php

require '../config/database.php';

$db = conectarDb();

$id = $_GET['id'];

$sql = "DELETE FROM calendario WHERE id = '$id'";

echo '<pre>';
var_dump($sql);
echo '</pre>';

$resultado = mysqli_query($db,$sql);

if(!$resultado){
    echo 'upps a ocurrido un error intenta de nuevo más tarde';
}else{
    echo 'Evento eliminado con exito';
}

header('location:calendario.php');