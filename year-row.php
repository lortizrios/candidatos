<?php 
    require_once('include/conexion-bd.php');?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <?php 

    $con = conectarBD();
    $query_1 = "SELECT * FROM candidatos ORDER BY id" ; 
    $query_2 = "SELECT * FROM departamento ORDER BY num_estudiante";
    $result_cand = mysqli_query($con, $query_1);
    $result_dep = mysqli_query($con, $query_2);

    echo "<table cellspacing='10' class='table table-hover'>";

    if(mysqli_num_rows($result_cand) && mysqli_num_rows($result_dep) > 0){

        $output.= '
        <div class="table-responsive">
        <table class="table table bordered">
        <tr>
            <th>Nº</th>
            <th>Foto</th>
            <th>Nº&nbsp;Estudiante</th>
            <th>Nombre </th>
            <th>Inicial</th>
            <th>Apellidos</th>
            <th>Departamento</th>
            <th>Puesto</th>
            <th>Posición</th>
            <th>Año</th>
            <th>Activar</th>
        </tr>';

        echo $output;

        while($row_cand = mysqli_fetch_array($result_cand)){

            $row_dep = mysqli_fetch_array($result_dep);
            
            if($row_cand['stat'] != 1){
                $x;
                $x++;
                echo"<tr>";
                    //Contador
                    echo"<td>".$x."</td>\n";

                    $directorio = opendir('img_candidatos');

                    //Verifica si hay fotos y las muestra
                    if($directorio){
                        while($images = readdir($directorio)){
                            if($images == $row_cand['path']){
                                echo"<td><img src='img_candidatos/$images' height='100px' width='100px'></td>";
                            }
                        }
                        
                        //Si no tiene foto muestra un icono
                    }if($row_cand['path'] != true){
                        echo"<td>";?> <img src="imagenes/candidato_icon.gif" 
                        height="100px" width="100px"> <?php echo"</td>\n";
                    }
                    echo"<td>".$num_estudiante = $row_cand['id']."</td>\n";
                    echo"<td>".$row_cand["nombre"]."</td>\n";
                    echo"<td>".$row_cand["inicial"]."</td>\n";
                    echo"<td>".$row_cand["apellidos"]."</td>\n";

                    if($row_cand['id'] == $row_dep['num_estudiante']){    
                        echo "<td>".$row_dep['departamentos']."</td>\n";
                    }else{
                        echo"<td>No</td>";
                    }

                    echo"<td>".$row_cand["puesto"]."</td>\n";
                    echo"<td>".$row_cand["posicion"]."</td>\n";
                    echo"<td>".$row_cand["year"]."</td>\n";

                    
                    echo"<td><a class='enable' nombre = ".$row_cand['nombre']."  apellidos =".$row_cand['apellidos']."
                    href='include/habilitar_candidato.php?id=".$row_cand['id']."'>Activar</a></td>\n";
                echo"</tr>";
            }
        }  
    }          
                         
         

        // liberar memoria
        mysqli_stmt_close($stmt);
        
     ?>

    <script type="text/javascript">

        $('.enable').click(function(e){

            var nombre = $(this).attr("nombre");
            var inicial = $(this).attr("inicial");
            var last = $(this).attr("apellidos");
        
            del = confirm("¿Desea habilitar a "+nombre+" "+last+"?");

            if(!del){
                e.preventDefault();
            }

        });

    </script>

<?php

// cerrar la conexion
mysqli_close($con);
?>
