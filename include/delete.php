<?php
    session_destroy();
    session_start();

    require('conexion-bd.php');

    $id = filter_input(INPUT_GET, "idd");  

    //Esconde candidatos
    $sql = "UPDATE candidatos SET stat = 0 WHERE id='$id'";

    $con = conectarBD();
    $url = '../candidatos-registrados.php';

    // crear el prepare statement
    if ($stmt = mysqli_prepare($con,$sql)) {

        // ejecutar el query
        mysqli_stmt_execute($stmt);
        //echo"ejecuto el query";
        //$_SESSION['delete-completed']= "Delete completed";
        header("Location: ../candidatos-registrados.php");
        //header("Refresh: 5; $url");
        
    }else{
        //$_SESSION['delete-error']="Error al borrar candidato";
        echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con);
        header('Location: ./candidatos-registrados.php');
    }
    
    // liberar memoria
    mysqli_stmt_close($stmt);

    //Cierra conexion
    mysqli_close($con);

    session_destroy();
?>