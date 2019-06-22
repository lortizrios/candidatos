<?php
    include_once('include/conexion-bd.php');

    $connect = conectarBD();

    //Adicional dinamic search
    $output = '';
    if(isset($_POST["query"])){
        $search = ucwords(strtolower($_POST["query"]));
        $query = "
        SELECT * FROM candidatos 
        WHERE CONCAT(nombre, ' ', apellidos) LIKE '%".$search."%'";
    }else{
        $query = "SELECT * FROM candidatos ORDER BY nombre";
    }
    //------------------------
    //$query = "SELECT * FROM candidatos ORDER BY id";

    $result = mysqli_query($connect, $query);
    
    echo "<table cellspacing='10' class='table table-hover'>";

    if(mysqli_num_rows($result) > 0){

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

        while($row = mysqli_fetch_array($result)){
            
            if($row['stat'] !=0){
                $x;
                $x++;
                echo"<tr>";
                    //Contador
                    echo"<td>".$x."</td>\n";

                    $directorio = opendir('img_candidatos');

                    //Verifica si hay fotos y las muestra
                    if($directorio){
                        while($images = readdir($directorio)){
                            if($images == $row['path']){
                                echo"<td><img src='img_candidatos/$images' height='100px' width='100px'></td>";
                            }
                        }
                        
                        //Si no tiene foto muestra un icono
                    }if($row['path'] != true){
                        echo"<td>";?> <img src="imagenes/candidato_icon.gif" 
                        height="100px" width="100px"> <?php echo"</td>\n";
                    }
                    echo"<td>".$num_estudiante = $row['id']."</td>\n";
                    echo"<td>".$row["nombre"]."</td>\n";
                    if($row['inicial'] != null){
                        echo"<td>".$row["inicial"]."."."</td>\n";
                    }else{
                        echo"<td>".$row["inicial"]."</td>\n";
                    }
                    echo"<td>".$row["apellidos"]."</td>\n";
                    echo"<td>".$row['departamento']."</td>\n";
                    echo"<td>".$row["puesto"]."</td>\n";
                    echo"<td>".$row["posicion"]."</td>\n";
                    //Editar
                    echo "<td><a href='editar.php?id=".$row['id']."'>Editar</a></td>\n";

                    //Borrar
                    echo "<td><a class='delete' href='include/delete.php?id=".$row['id']."' name=".$row['nombre']." 
                    apellido=". $row['apellidos']." >Eliminar</button></td\n>";

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