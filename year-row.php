<?php 
    require_once('include/conexion-bd.php');?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <?php 

    $sql = "SELECT * FROM candidatos" ; 
    $con = conectarBD();

    // crear el prepare statement
    if ($stmt = mysqli_prepare($con, $sql) ) {

        // ejecutar el query
        mysqli_stmt_execute($stmt);
        
        
        $result = mysqli_stmt_get_result($stmt);
        
        // obtener los resultados
        echo "<table cellspacing='10' class='table table-hover'>";?>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nº&nbsp;Estudiante</th>
                    <th>Nombre </th>
                    <th>Inicial</th>
                    <th>Apellidos</th>
                    <th>Departamento</th>
                    <th>Puesto</th>
                    <th>Posición</th>
                    <th>Año</th>
                    <th>Habilitar</th>
                </tr>
            </thead> <?php 

            echo"<tbody>";
                    
                while ( $row = mysqli_fetch_assoc($result) ){

                    if( $row['stat'] == false ){

                        echo "<tr>\n";
                            echo"<td>";?> <img src="<?php echo 'img/'.$row['path']; ?>" height="100px" width="100px"> <?php echo"</td>";
                            echo "<td>". $row['id'] . "</td>\n";
                            echo "<td>". $row['nombre'] . "</td>\n";
                        
                            //Si no tiene inicial imprime ""
                            if ($row['inicial'] == null){
                                echo "<td>" ."". "</td>\n";
                            }  else{//imprime inicial
                                echo "<td>" .$row['inicial'] . "</td>\n";
                            }
                            echo "<td>" . $row['apellidos'] . "</td>\n";
                            echo "<td>" . $row['departamento'] . "</td>\n";
                            echo "<td>" . $row['puesto'] . "</td>\n";
                            echo "<td>" . $row['posicion'] . "</td>\n";
                            echo "<td>".$row['year']."</td>\n";
                            echo"<td><a class='enable' nombre = ".$row['nombre']."  apellidos =".$row['apellidos']."
                            href='include/habilitar_candidato.php?id=".$row['id']."'>Activar</a></td>\n";
                        echo "</tr>\n";
                    }
                }
            echo "</tbody>\n";
        echo "</table>\n";

        // liberar memoria
        mysqli_stmt_close($stmt);
        
    } else {
        echo "ERROR: " . mysqli_errno($con) . ' - ' . mysqli_error($con);
    } ?>

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
