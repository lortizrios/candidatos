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
        echo "<table class='table table-hover'>";
?>

        <thead>
            <tr>
                <th>Num. Estudiante</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Departamento</th>
                <th>Puesto</th>
                <th>Posicion</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

            <tbody>

            <?php

        while ( $row = mysqli_fetch_assoc($result) ){

            if( $row['stat'] == true){

            echo "<tr>\n";
                echo "<td>" . $row['id'] . "</td>\n";
                echo "<td>" . $row['nombre'] . "</td>\n";
                echo "<td>" . $row['apellidos'] . "</td>\n";
                echo "<td>" . $row['departamento'] . "</td>\n";
                echo "<td>" . $row['puesto'] . "</td>\n";
                echo "<td>" . $row['posicion'] . "</td>\n";
                echo "<td> <a href='editar.php? id=" . $row['id'] . "'>Editar</a></td>\n";
                echo "<td> <a href='eliminar.php? id=" . $row['id'] . "'>Eliminar</a></td>\n";

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
    <!-- Modal -->
    <div class="modal fade" id="modal_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Texto Modal
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>

<?php
// cerrar la conexion
mysqli_close($con);
?>
