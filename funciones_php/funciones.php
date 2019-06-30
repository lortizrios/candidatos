<?php
    function alertas(){

        session_destroy();
        session_start();

        
        $error_query_foto = $_SESSION['error_query_foto'];
        $error_guardar_foto = $_SESSION['error_guardar_foto'];
        $validar_img = $_SESSION['validar_img'];
        $delError = $_SESSION['delete-error'];
        $delComplete = $_SESSION['delete-completed'];
        $habilitar = $_SESSION['habilitar'];

        if($update = $_SESSION['update']){
            echo $update;
            ?><script>salert_update();</script><?php
        } 

        elseif($error_query_foto){
            echo $error_query_foto;
            ?><script>salert_error();</script><?php
        }

        elseif($error_guardar_foto){
            echo $error_guardar_foto;
            ?><script>salert_error_foto();</script><?php  
        }

        elseif($validar_img){
            echo $validar_img;
            ?><script>img_format_val();</script><?php
        }

        elseif($delError){
            echo$delError;
            ?><script>delError();</script><?php
        }

        elseif($delComplete){
            ?><script>delCompleted();</script><?php
        }

        session_destroy();
    }
?>