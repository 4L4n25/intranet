<?php

require '../config/database.php';

$db = conectarDb();

$id = $_GET['id'];

$sql = "DELETE FROM usuarios WHERE id='$id'";

echo '<pre';
var_dump($sql);
echo '<pre>';

$resultado = mysqli_query($db,$sql);

header('location:../../configuracion.php?resultado=3');