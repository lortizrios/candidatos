<?php
    function alertas(){

        //destruye las $_SESSION[''] para que no hayan errores y tampoco haya más de una session activa
        session_destroy();

        //habilita las $_SESSION['']; 
        session_start();

        $update = $_SESSION['update'];
        $error_actualizar = $_SESSION['error_actualizar'];
        $errorGuardarFoto = $_SESSION['error-guardar-foto'];
        $validar_img = $_SESSION['validar_img'];
        $delError = $_SESSION['delete-error'];
        $delComplete = $_SESSION['delete-completed'];
        $estDuplicado = $_SESSION['estudiante-duplicado'];
        $canRegistrado = $_SESSION['candidato-registrado'];
        $errorRegistrar = $_SESSION['error-registrar'];

        //llama a las funciones creadas en javascript/funtions.js
        //<script>funciones();</script>

        if($update){
            //echo $update;
            ?><script>salert_update();</script><?php
        } 

        elseif($error_actualizar){
            //echo $error_actualizar;
            ?><script>errorActualizar();</script><?php
        }

        elseif($errorGuardarFoto){
            //echo $errorGuardarFoto;
            ?><script>salert_error_foto();</script><?php  
        }

        elseif($validar_img){
            //echo $validar_img;
            ?><script>img_format_val();</script><?php
        }

        elseif($delError){
            //echo $delError;
            ?><script>delError();</script><?php
        }

        elseif($delComplete){
            //echo $delComplete
            ?><script>delCompleted();</script><?php
        }

        elseif($estDuplicado){
            //echo $estDuplicado
            ?><script>estDuplicado();</script><?php
        }

        elseif($canRegistrado){
            //echo $canRegistrado
            ?><script>candRegistrado();</script><?php
        }

        elseif($errorRegistrar){
            //echo $errorRegistrar;
            ?><script>errorRegistrar();</script><?php
        }

        session_destroy();
    }
?>