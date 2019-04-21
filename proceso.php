<?php

    require_once 'conexion-bd.php';

    $nombre = $_POST['nombre'];
    $inicial = $_POST['inicial'];
    $apellidos = $_POST['apellidos'];
    $num_estudiante = $_POST['numero-estudiante'];
    $departamento = $_POST['departamento'];
    $puesto = $_POST['puesto'];
    $posicion= $_POST['posicion'];

    $sql = "insert into candidatos values (?,?,?,?,?,?,?)";

    //Conecta a la base datos
    $con = conectarBD();

    //Prepare statement
    $statement = mysqli_prepare($con, $sql);

    // bind de los valores enviados con los marcadores
    mysqli_stmt_bind_param($statement, "sssssss", $nombre, $inicial, $apellidos, $num_estudiante, $departamento, $puesto, $pocision);

    if(isset($_POST['registrar'])){

        
        $con -> query("INSERT INTO candidatos (nombre, inicial, apellidos, id, departamento, puesto, posicion) 
        VALUES('$nombre', '$inicial', '$apellidos', '$num_estudiante', '$departamento', '$puesto', '$posicion')"
        );

        if($con == true){
           header('location: candidatos-registrados.php'); 
        }
        else{
             $mysqli-> error;
        }
        

    } 

    
?>