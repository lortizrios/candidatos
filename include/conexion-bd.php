<?php

    // Funcion para conectar a base de datos
    function conectarBD(){

    $servidor = "localhost";
    $usuario = "root";
    $password = "root";
    $tabla = "papeleta";
    

    // host, usuario, password, base de datos
    $link= mysqli_connect($servidor, $usuario, $password, $tabla);

    // Verificar conexion
    if (!$link){
        die("Error en la conexión:".mysqli_connect_errno().' '.mysqli_connect_error());
    }

    return $link;
}

?>