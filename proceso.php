<?php

    require_once 'conexion-bd.php';

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $num_estudiante = $_POST['numero-estudiante'];
    $departamento = $_POST['departamento'];
    $puesto = $_POST['puesto'];
    $posicion= $_POST['posicion'];

    $sql = "insert into candidatos values (?,?,?,?,?,?) ";

    //Conecta a la base datos
    $con = conectarBD();

    //Prepare statement
    $statement = mysqli_prepare($con, $sql);

    // bind de los valores enviados con los marcadores
    mysqli_stmt_bind_param($statement, "ssssss", $nombre, $apellidos, $num_estudiante, $departamento, $puesto, $pocision);

    if(isset($_POST['registrar'])){

        $con -> query("INSERT INTO candidatos (nombre, apellidos, id, departamento, puesto, posicion) 
        VALUES('$nombre', '$apellido', '$num_estudiante', '$departamento', '$puesto', '$posicion')")
        
        or die($mysqli-> error); 

        header('location: candidatos-registrados.php');
    }

    
?>