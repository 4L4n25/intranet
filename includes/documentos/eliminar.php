<?php

require '../config/database.php';

$db = conectarDb();

$id = $_GET['id'];

$sql = "DELETE FROM documentos WHERE id='$id'";

$resultado = mysqli_query($db,$sql);

header('location:../../carga-documentos.php');