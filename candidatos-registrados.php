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
        
        <!--Barra de navegacion-->
        <?php include("include/navbar.php"); ?>

        <title>Candidatos</title>

        <!--Imagen inter Bayamon-->
        <center>
        <img src="imagenes/inter-bayamon.jpg">  
        </center>
    </head>

    <body class="container">

        <div style="margin-top: 15px" class="container table-responsive">
            <div id="resultados"></div>
            <div id="result"></div>
            <br>
        </div>
        <div id="resultados"></div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
    </body>
</html>

<script>
  $(document).ready(function(){

  load_data();

    function load_data(query){
      $.ajax({
        url:"fetch.php",
        method:"POST",
        data:{query:query},
        success:function(data){    
          $('#result').html(data);
        }
      });
    }
    $('#search_text').keyup(function(){
      var search = $(this).val();
      if(search != ''){
        load_data(search);
      }else{
        load_data();
      }
    });
  });
</script>