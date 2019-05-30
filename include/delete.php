<?php


    require('conexion-bd.php');

        if(isset($_GET['id'])){

            $id =  $_GET['id'];

            //Esconde candidatos
            $sql = "UPDATE candidatos SET stat = 0 WHERE id='$id'";

            $con = conectarBD();
            $url = '../candidatos-registrados.php';

            // crear el prepare statement
            if ( $stmt = mysqli_prepare($con, $sql) ) {

                // ejecutar el query
                if(mysqli_stmt_execute($stmt)){
                    header("Location: $url");
                }else{
                    echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con);
                    header("Refresh: 5; $url");
                }
            } else {
            echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con);
            header('Refresh: 3; URL= ../candidatos-registrados.php');
            
            }
            
            // liberar memoria
            mysqli_stmt_close($stmt);
        }
    

?>