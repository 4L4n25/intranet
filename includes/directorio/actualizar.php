<?php

require '../config/database.php';

$db=conectarDb();

$id = $_POST['id'];

var_dump($id);

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$departamento = $_POST['departamento'];
$cargo = $_POST['cargo'];
$correo = $_POST['correo'];
$celular = $_POST['celular'];
$extension = $_POST['extension'];

$nombreImagen = md5(uniqid(rand(), true)).'.jpg';
$tipoImagen = $_FILES['imagen']['type'];
$tamañoImagen = $_FILES['imagen']['size'];

if($tamañoImagen<=70000000){

	if($tipoImagen=='image/jpeg'||$tipoImagen=='image/jpg'||$tipoImagen=='image/png'){
//ruta de la carpeta almacenaje
$carpetaDestino=$_SERVER['DOCUMENT_ROOT'].'\assets\images/';

move_uploaded_file($_FILES['imagen']['tmp_name'],$carpetaDestino.$nombreImagen);

}else{
	echo'solo se admiten imagenes';
}

}else{
	echo 'El tamaño excede el máximo permitido';
}

$sql = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', departamento = '$departamento',cargo='$cargo',
        correo = '$correo', celular='$celular', extension='$extension', imagen='$nombreImagen' WHERE id='$id'";

echo '<pre>';
var_dump($sql);
echo '<pre>';


$resultado = mysqli_query($db,$sql);


echo '<pre>';
var_dump($resultado);
echo '<pre>';

if(!$resultado){
    echo 'Guardado Fallido';
}else{
    header('location:../../configuracion.php?resultado=2');
}