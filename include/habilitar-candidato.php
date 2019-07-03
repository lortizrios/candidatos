<?php
    require('conexion-bd.php');
    
    session_destroy();
    session_start();

    $id = filter_input(INPUT_GET, "idd");  

    //Esconde candidatos
    $sql = "UPDATE candidatos SET stat = 1 WHERE id='$id'";

    $con = conectarBD();

    // crear el prepare statement
    if ( $stmt = mysqli_prepare($con, $sql) ) {

        // ejecutar el query
        if(mysqli_stmt_execute($stmt)){
            header('Location: ../ex-candidatos-registrados.php');
        }else{
            echo "ERROR: " . mysqli_errno($con) . ' - ' . mysqli_error($con);
        }
    } else {
    echo "ERROR: " . mysqli_errno($con) . ' - ' . mysqli_error($con);
    }

    // liberar memoria
    mysqli_stmt_close($stmt);

    //Cierra conexion
    mysqli_close($con);
?>