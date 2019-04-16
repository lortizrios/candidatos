<?php

// Funcion para conectar a base de datos
function conectarBD(){

    // host, usuario, password, base de datos
    $link= mysqli_connect('localhost', 'root', 'root', 'papeleta');

    // Verificar conexion
    if (!$link){
        die("Error en la conexión:".mysqli_connect_errno().' '.mysqli_connect_error());
    }

    return $link;
}

?>