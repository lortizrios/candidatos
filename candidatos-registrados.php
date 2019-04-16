<!doctype html>

<html>
    <?php include("navbar.php"); ?>
    
    <head>
        <title>Lista de candidatos</title>
        
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="css/bootstrap.min.css" >

        

        <title>Candidatos</title>
            
        <!--Imagen inter Bayamon-->
        <center>
        <img src="imagenes/inter-bayamon.jpg">  
        </center>
    </head>

    <body style="margin-top: 15px">

        <!--<div style="margin-bottom: 15px" class="container">
            <h6 class="display-4">Candidatos</h6>
        </div>-->

        <div style="margin-top: 15px" class="container table-responsive">
            <?php
                include("tabla-candidatos.php");
            ?>
            
            <div style="margin-bottom:15px">
                <a class="btn btn-primary" 
                href="index.php">Registrar Candidato </a>
            </div>
        </div>

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
    </body>
</html>