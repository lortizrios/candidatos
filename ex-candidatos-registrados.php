<!DOCTYPE html>
<html lang="es">
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
             
        <!--CSS Bootsrap-->
        <link rel="stylesheet" href="css/bootstrap.min.css" >

        <!--CSS-->
        <link rel="stylesheet" href="css/estilos.css">

        <!--Libreria Sweet Alert-->
        <script src="sweetalert/sweetalert.min.js"></script>
        
        <!--Barra de navegacion-->
        <?php include("include/navbar.php"); ?>

        <title>Ex-candidatos</title>

        <!--Imagen inter Bayamon-->
        <center>
        <img src="imagenes/inter-bayamon.jpg">  
        </center>
    </head>

    <body class="container" >
        
        <div style="margin-top: 15px" class="container table-responsive">
            <h5>Ex-candidatos inactivos</h5>
            <?php
                //Imprime la tabla creada en php
                require_once('year-row.php');

                //logica de alertas sweet alert
                require_once('funciones_php/funciones.php');

                //llama a las alertas creadas
                alertas();
            ?>
        </div>

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
    </body>
</html>