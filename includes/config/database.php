<?php

function conectarDb():mysqli{

    $db = new mysqli("localhost","root","","intranet");

    if(!$db){
        echo "Error no se pudo conectar a MySQL";
        echo "Error de depuracion" . mysqli_connect_errno();
        echo "error de depuración: " . mysqli_connect_error();
        exit;
    }
    return $db;
}