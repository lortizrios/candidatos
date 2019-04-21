<?php

    //script php 
    require_once('conexion-bd.php');

    $sql = "select * from candidatos" ; 

    $con = conectarBD();

    // crear el prepare statement
    if ( $stmt = mysqli_prepare($con, $sql) ) {

        // ejecutar el query
        mysqli_stmt_execute($stmt);
        
        
        $result = mysqli_stmt_get_result($stmt);
        
        // obtener los resultados
        echo "<table cellspacing='10' class='table table-hover'>";
?>

        <thead>
            <tr>
                <th>Nº&nbsp;Estudiante </th>
                <th>Nombre </th>
                <th>Inicial</th>
                <th>Apellidos</th>
                <th>Departamento</th>
                <th>Puesto</th>
                <th>Posición</th>
                <th>&nbsp;&nbsp;Editar</th>
                <th>&nbsp;&nbsp;Eliminar</th>
            </tr>
        </thead>

            <tbody>

<?php
        
        while ( $row = mysqli_fetch_assoc($result) ){

            if( $row['stat'] == true){

            echo "<tr>\n";
                echo "<td>" . $row['id'] . "</td>\n";
                echo "<td>" . $row['nombre'] . "</td>\n";
                
                //Si no tiene inicial imprime --- 
                if ($row['inicial'] == null){
                     echo "<td>" ."-----". "</td>\n";
                }  else{//imprime inicial
                echo "<td>" .$row['inicial'] . "</td>\n";
                }
                
                echo "<td>" . $row['apellidos'] . "</td>\n";
                echo "<td>" . $row['departamento'] . "</td>\n";
                echo "<td>" . $row['puesto'] . "</td>\n";
                echo "<td>" . $row['posicion'] . "</td>\n";

                //Editar
                echo "<td><button type='button' class='btn btn-link' data-toggle='modal'
                data-target='#modal_editar' id=" . $row['id'] . ">Editar</button></td>";

                //Borrar
                echo "<td><button type='button' class='btn btn-link' data-toggle='modal'
                data-target='#modal_borrar' id=" . $row['id'] . ">Eliminar</button></td>";
            }
        }
            echo "</tbody>\n";
            echo "</table>\n";

            // liberar memoria
            mysqli_stmt_close($stmt);
    } else {
        echo "ERROR: " . mysqli_errno($con) . ' - ' . mysqli_error($con);
    }
?>

    

    <!-- Modal Editar -->
    <div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Candidato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    Editar Candidato <?php  $row['nombre'] ?>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Si</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal borrar -->
    <div class="modal fade" id="modal_borrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Candidato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    Esta seguro que desea eliminar el candidato?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Si</button>
                </div>
            </div>
        </div>
    </div>

<?php
// cerrar la conexion
mysqli_close($con);
?>
