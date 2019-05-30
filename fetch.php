<?php
    include_once('include/conexion-bd.php');

    $connect = conectarBD();

    //cacha si se escribe en el search y ejecuta
    if(isset($_POST["query"])){

        $upcase = ucwords(strtolower($_POST["query"]));

        $search = mysqli_real_escape_string($connect, $upcase);

        $query = 
        "SELECT * FROM candidatos 
        WHERE nombre LIKE '".$search."%' 
        OR inicial LIKE '".$search."%' 
        OR apellidos LIKE '".$search."%'";

    }else{
        
        $query_1 = "SELECT * FROM candidatos ORDER BY id";
        
    }

    $result_cand = mysqli_query($connect, $query_1);
    $query_2 = "SELECT * FROM departamento ORDER BY num_estudiante";
    $result_dep = mysqli_query($connect, $query_2);

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
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>';

        echo $output;

        while($row_cand = mysqli_fetch_array($result_cand)){

            $row_dep = mysqli_fetch_array($result_dep);
            
            if($row_cand['stat'] !=0){
                    $x;
                    $x++;
                echo"<tr>";
                    

                    echo"<td>".$x."</td>\n";
                    if($row_cand['path'] == true){
                        echo"<td>";?> <img src="<?php echo 'img/'.$row_cand['path']; ?>" 
                        height="100px" width="100px"> <?php echo"</td>\n";
                    }else{
                        echo"<td>";?> <img src="imagenes/candidato_icon.gif" 
                        height="100px" width="100px"> <?php echo"</td>\n";
                    }
                    echo"<td>".$num_estudiante = $row_cand['id']."</td>\n";
                    echo"<td>".$row_cand["nombre"]."</td>\n";
                    echo"<td>".$row_cand["inicial"]."</td>\n";
                    echo"<td>".$row_cand["apellidos"]."</td>\n";

                    if($num_estudiante == $row_cand['num_estudiante']){    
                    echo "<td>".$row_dep['departamentos']."</td>";}

                    echo"<td>".$row_cand["puesto"]."</td>\n";
                    echo"<td>".$row_cand["posicion"]."</td>\n";
                    //Editar
                    echo "<td><a href='editar.php?id=".$row_cand['id']."'>Editar</a></td>\n";

                    //Borrar
                    echo "<td><a class='delete' href='include/delete.php?id=".$row_cand['id']."' name=".$row_cand['nombre']." 
                    apellido=". $row_cand['apellidos']." >Eliminar</button></td\n>";

                echo"</tr>";
            }
        }  
    }else{
        echo "<h5 style='color: red;'>Candidato no encontrado.<h5> ";
    }

?>
<script type="text/javascript">

$('.delete').click(function(e) {

    var nombre = $(this).attr("name");
    var appellido = $(this).attr("apellido");
    
    del = confirm("¿Desea eliminar a "+nombre+" "+appellido+"?");

    if(!del){
        e.preventDefault();
    }
})

</script>