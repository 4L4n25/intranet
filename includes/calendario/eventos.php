<?php
header('Content-Type: application/json');


require '../config/database.php';

$db=conectarDb();

$query = 'SELECT * FROM calendario';

$resultado = mysqli_query($db,$query);

 

while($json = mysqli_fetch_assoc($resultado)){
    $calendario[] = $json;
}

echo json_encode($calendario);

