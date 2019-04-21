<!doctype html>
<html>
    
    <head>
        <title>Lista de candidatos</title>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible".content="ie-edge-">
             
        <!--CSS Bootsrap-->
        <link rel="stylesheet" href="css/bootstrap.min.css" >

        <!--CSS-->
        <link rel="stylesheet" href="css/estilos.css">
        
        <!--Barra de navegacion-->
        <?php include("navbar.php"); ?>
        
        <!--Imagen inter Bayamon-->
        <center>
        <img src="imagenes/inter-bayamon.jpg">  
        </center>
    </head>

    <body class="container" >
        <!--<div style="margin-bottom: 15px" class="container">
            <h6 class="display-4">Candidatos</h6>
        </div>-->

        <div style="margin-top: 15px" class="container table-responsive">
            <?php
                include("tabla-candidatos.php");
            ?>
        </div>

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
    </body>
</html>