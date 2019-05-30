<?php
    require_once('conexion-bd.php');

    $urlCan = '../candidatos-registrados.php';
    $urlEdi = './editar.php';
    $urlInd = './index.php';

    $idDup = "Error: Numero de estudiante duplicado. Intente nuevamente.";
  
    if(isset($_POST['registrar'])){

        $nombre = $_POST['nombre'];
        $inicial = $_POST['inicial'];
        $apellidos = $_POST['apellidos'];
        $num_estudiante = $_POST['numero-estudiante'];
        $departamento = $_POST['departamento'];
        $puesto = $_POST['puesto'];
        $posicion = $_POST['posicion'];
        $year = $_POST['year'];

        //Primero verifica si el #estudiante es unico
        $sql = "SELECT * FROM candidatos WHERE id = '$num_estudiante'"; 
        $con = conectarBD();

        // crear el prepare statement
        if ($stmt = mysqli_prepare($con, $sql)) {

            // ejecutar el query
            mysqli_stmt_execute($stmt);
                
            $result = mysqli_stmt_get_result($stmt);

            $row = mysqli_fetch_assoc($result);

            //verifica si num. estudiante existe
            if($row['id'] != $num_estudiante){

                //arreglo archivos
                $archivo = $_FILES['archivo'];
                $archivoName = $archivo['name'];
                $tipo = $archivo['type'];

                //si tiene algun documento ejecuta
                if($tipo != null){

                    //valida formato para fotos
                    if($tipo == "image/jpg" || $tipo == "image/jpeg"){

                        //si no existe el directorio 'img' lo crea
                        if(!is_dir('img')){
                            mkdir('img', 0777);
                        }
                        //mueve la imagen del archivo temporal al archivo final
                        move_uploaded_file($archivo['tmp_name'],'img/'.$archivoName);
                        //Termina proceso de subir archivos----------------------------
                        
                        //Conecta a la base datos
                        $con = conectarBD();

                        //Primer insert en tabla candidatos
                        $queryFile_1 = $con -> query("INSERT INTO candidatos (id, nombre, inicial, apellidos,  puesto, posicion, year, path) 
                        VALUES('$num_estudiante', '$nombre', '$inicial', '$apellidos', '$puesto', '$posicion', '$year', '$archivoName')");

                        //Segundo insert en tabla
                        $queryFile_2 = $con -> query("INSERT INTO departamento (id, num_estudiante, departamentos) VALUES (NULL, '$num_estudiante', '$departamento')");

                        //valida si ejecuta query
                        if($queryFile_1 && $queryFile_2){
                            ?><script>
                                alert("¡Candidato registrado con éxito!");
                            </script><?php
                            header("Location: $urlCan");

                        //si no ejecuta imprime error
                        }else{
                            echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con)."\n";
                            header("Refresh:5; url: $urlInd");
                        }
                    //formato incorrecto
                    }else{?>
                        <script>
                            alert("Elija una imagen con el formato correcto. (JPG o JPEG)");
                            history.back(-1);
                        </script><?php
                    }

                    
                }else{//Si no existe foto No guarda el path

                    $con = conectarBD();
                    
                    //query que no guarda el path
                    $queryNull_1 = $con -> query("INSERT INTO candidatos (id, nombre, inicial, apellidos, puesto, posicion, year) 
                    VALUES('$num_estudiante', '$nombre', '$inicial', '$apellidos', '$puesto', '$posicion', '$year')");
                    
                    //Segundo insert en tabla
                    $queryNull_2 = $con -> query("INSERT INTO departamento (id, num_estudiante, departamentos) VALUES (NULL, '$num_estudiante', '$departamento')");
                    var_dump($queryNull_2);

                    //valida si query ejecuto
                    if($queryNull_1 && $queryNull_2){ 
                        ?><script>
                            alert("¡Candidato registrado con éxito!");
                        </script><?php
                        header("Location: $urlCan");

                     //no ejecuta el query imprime error
                    }else{
                        echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con)."\n";
                        header("Refresh: 5; url= $urlInd");
                        
                    }
                }

            }else{
                ?><script>
                    alert("<?php echo $idDup; ?>");
                    history.back(-1);
                </script><?php
            }
   
        }else{
            echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con);
            header("Refresh: 5; url= $urlInd");
        }

        //Cierra conexion
        mysqli_close($con);
        
        //Cierra statement
        mysqli_stmt_close($exe);    
    }

    if(isset($_POST['update'])){

        //subir archivos
        $archiva = $_FILES['archivo'];
        $archivoName = $archiva['name'];
        $tipo = $archiva['type'];

        //$id = $_GET['id'];

        $id_post = $_POST['id'];
        $nombre = $_POST['nombre'];
        $inicial = $_POST['inicial'];
        $apellidos = $_POST['apellidos'];
        $num_estudiante = $_POST['num_est'];
        $departamento = $_POST['departamento'];
        $puesto =$_POST['puesto'];
        $posicion = $_POST['posicion'];
        $year = $_POST['year'];

        var_dump($id_post);
        
        $select_all = "SELECT * FROM departamento";

        $queryNull = "UPDATE candidatos SET id ='$num_estudiante', nombre = '$nombre', 
        inicial = '$inicial', apellidos = '$apellidos', puesto = '$puesto', posicion = '$posicion', 
        year = '$year' WHERE id = '$id_post'";

        $con = conectarBD();

        //Condicion corre si no escoje una foto
        if($tipo != null){
        
            if($tipo == "image/jpg" || $tipo == "image/jpeg"){
                echo"Entro a validacion de imagen";
    
                //si no existe el archivo img lo crea
                if(!is_dir('img')){
                    mkdir('img', 0777);
                    echo "creo directorio";
                }
                //mueve la imagen del archivo temporal al archivo final
                $move = move_uploaded_file($archivo['tmp_name'],'img/'.$archivoName);
                echo"movio archivo\n";

                if($s = mysqli_query($con,$select_all)){ 
                    echo"entro a select all"; 

                    while($row_dep = mysqli_fetch_array($s)){
                        var_dump($row_dep);
                        $row_id = $row_dep['id'];
                        $num = $row_dep['num_estudiante'];

                        if($num == $id_post){
                            echo"------------------------------------------------------";
                            echo"Son iguales";
                            var_dump($row_id);
                            var_dump($num);
                            var_dump($id_post);

                            $query_1 = "UPDATE candidatos SET id ='$num_estudiante', nombre = '$nombre', 
                            inicial = '$inicial', apellidos = '$apellidos', puesto = '$puesto', 
                            posicion = '$posicion', year = '$year', path ='$archivoName' 
                            WHERE id = '$id_post'";
                            
                            //valida que se guarden los datos
                            if($q1 = mysqli_query($con,$query_1)  /**/){
                                var_dump($q1);
                                echo "entro al query 1";
                                
                                if($q2 = mysqli_query($con,$query_2)){?>
                                <script>
                                    alert("Candidato actualizado con exito.");
                                </script><?php
                                }
                                //var_dump($q2);
                               
                                header("Refresh: 1; url= $urlCan");
                            }else{
                                //imprime el error de la conexion
                                echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con); 
                                //header("Refresh:5; URL= $urlUpd");
                            }
                        }
                    }

                    
                
                    //$query_2 = "UPDATE departamento SET id = NULL, num_estudiante = NULL, 
                    //departamentos = '$departamento' WHERE num_estudiante = '$row_id'";

                    

                }else{
                    echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con);
                }

                
            
            }else{
                echo "Elija una imagen en el formato correcto. (JPG o JPEG)";
                //header("Refresh: 3; url= $urlEdi");
            }
        
        }else{
            echo "No tiene foto";
            var_dump($archiva);
            var_dump($archivoName);
            var_dump($tipo);
            die();
        }
        
        //Cierra statement
        mysqli_stmt_close($query_1,$queryNull);

        // ce rrar la conexion
        mysqli_close($con);
    }

    //Imprime los valores en editar
    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $sql_1 = "SELECT * FROM candidatos WHERE id = '$id'";

        $sql_2 = "SELECT * FROM departamento WHERE num_estudiante = '$id'";

        $con = conectarBD();

        //crear el prepare statement
        if ($stmt_1 = mysqli_prepare($con, $sql_1)) {

            //ejecutar el query_1
            $exe_1 = mysqli_stmt_execute($stmt_1);

            var_dump($exe_1);

            $result_1 = mysqli_stmt_get_result($stmt_1);

            $row_1 = mysqli_fetch_assoc($result_1);
            
            var_dump($row_1);

            $num_estudiante_1 = $row_1['id'] ;
            $nombre = $row_1['nombre'] ;
            $inicial = $row_1['inicial'];
            $apellidos = $row_1['apellidos'];
            $puesto = $row_1['puesto'];
            $posicion = $row_1['posicion'];
            $year = $row_1['year'];

            if($stmt_2 = mysqli_prepare($con, $sql_2)){

                //ejecuta el query_2
                $exe_2 = mysqli_stmt_execute($stmt_2);

                $result_2 = mysqli_stmt_get_result($stmt_2);
 
                $row_2 = mysqli_fetch_assoc($result_2);

                var_dump($row_2);

                $dep_id = $row_2['id'];
                $dep_num_stu = $row_2['num_estudiante'];
                $dep_departamento= $row_2['departamentos'];

            }else{
                echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con);
                echo"Error prepare 2";
            }

        }else{
            echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con);
            echo "Error prepare 1";
        }
  
        // liberar memoria
        mysqli_stmt_close($stmt_1,$stmt_2);
        
        // cerrar la conexion
        mysqli_close($con);
    }
?>
        
