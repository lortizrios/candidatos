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

        //Crear el prepare statement
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

                //si tiene algun formato de documento ejecuta
                if($tipo != null){

                    //valida formato para fotos
                    if($tipo == "image/jpg" || $tipo == "image/jpeg"){

                        //si no existe el directorio 'img' lo crea
                        if(!is_dir('../img_candidatos')){
                            mkdir('../img_candidatos', 0777);
                        }
                        //mueve la imagen del archivo temporal al archivo final
                        if($move = move_uploaded_file($archivo['tmp_name'],'../img_candidatos/'.$archivoName)){
                            echo"Guardo la foto en el folder";
                            var_dump($move);
                            var_dump($archivoName);
                            var_dump($archivo['tmp_name']);

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

                        }else{
                            echo"No guardo la foto en el folder";
                        }
                        //Termina proceso de subir archivos----------------------------
                        
                        
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
        $foto = $_POST['archivo'];

        var_dump($id_post);
        
        $select_all = "SELECT * FROM departamento";

        $query_foto = "UPDATE candidatos SET nombre = '$nombre', inicial = '$inicial', apellidos = '$apellidos', 
        puesto = '$puesto', posicion = '$posicion', year = '$year', path = '$foto' WHERE id = '$id_post'";

        $query_departamento = "UPDATE departamento SET departamentos = '$departamento' 
        WHERE num_estudiante = '$num_estudiante'";

        $query_foto_vacia = "UPDATE candidatos SET id ='$num_estudiante', nombre = '$nombre', 
        inicial = '$inicial', apellidos = '$apellidos', puesto = '$puesto', posicion = '$posicion', 
        year = '$year' WHERE id = '$id_post'";

        $con = conectarBD();

        //subir archivos
        $archivo = $_FILES['archivo'];
        $archivoName = $archivo['name'];
        $tipo = $archivo['type'];

        //Verifica si tiene foto
        if($tipo != null){
        
            if($tipo == "image/jpg" || $tipo == "image/jpeg"){
                echo"Entro a validacion de imagen\n";

                var_dump($archivo);
               
    
                //si no existe el archivo img lo crea
                if(!is_dir('img')){
                    mkdir('img', 0777);
                    echo "creo directorio\n";
                }else{
                    echo "Ya existe la carpeta\n";
                }

                //mueve la imagen del archivo temporal al archivo final
                if(move_uploaded_file($archivo['tmp_name'],'./img'.$archivoName)){
                    echo"imagen guardada con exito\n";
                }else{
                    echo"Error al guardar imagen";
                }
                
                //Selecciona todos de la tabla departamento
                if($s = mysqli_query($con,$select_all)){ 
                    echo"entro a select all"; 

                    //imprime todos los que esten en departamento
                    while($row_dep = mysqli_fetch_array($s)){
                        var_dump($row_dep);
                        $row_id = $row_dep['id'];
                        $num = $row_dep['num_estudiante'];

                        //valida que num estudiante candidato y num estudiante departamento sean iguales 
                        if($num == $id_post){
                            echo"------------------------------------------------------";
                            echo"Son iguales";
                            var_dump($row_id);
                            var_dump($num);
                            var_dump($id_post);

                            $query_foto;
                            
                            //valida que se actualicen los datos del 
                            if($qf = mysqli_query($con,$query_foto)){
                                var_dump($qf);
                                echo "entro al query_foto";
                                
                                //me quede aqui------------------------------------
                                $query_departamento;

                                var_dump($id_post);
                                
                                if($qd = mysqli_query($con,$query_departamento)){
                                    echo "Se cumplio update_departamento";?>

                                    <script>
                                        alert("Candidato actualizado con exito.");
                                    </script><?php

                                    header("Refresh: 1; url= $urlCan");
                                }
                                
                            }else{
                                //imprime el error de la conexion
                                echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con); 
                                //header("Refresh:5; URL= $urlUpd");
                            }
                        }
                    }

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

    //Imprime los valores para utilizarlos en editar.php
    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $sql = "SELECT candidatos.id, candidatos.nombre, candidatos.inicial, candidatos.apellidos, 
        candidatos.puesto, candidatos.posicion, candidatos.stat, candidatos.path, candidatos.year, 
        departamento.departamentos FROM candidatos, departamento 
        WHERE candidatos.id=departamento.num_estudiante AND candidatos.id = '$id'";

        $con = conectarBD();

        if($stmt = mysqli_prepare($con ,$sql)){
        
            //ejecuta el query_2
            $exe = mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $row = mysqli_fetch_assoc($result);

            $num_estudiante = $row['id'] ;
            $nombre = $row['nombre'] ;
            $inicial = $row['inicial'];
            $apellidos = $row['apellidos'];
            $puesto = $row['puesto'];
            $posicion = $row['posicion'];
            $year = $row['year'];
            $departamento = $row['departamentos'];

            var_dump($row['id']);
            var_dump($row['nombre']);
            var_dump($row['inicial']);
            var_dump($row['apellidos']);
            var_dump($row['puesto']);
            echo"posicion";
            var_dump($row['posicion']);
            echo"stat";
            var_dump($row['stat']);
            echo"year";
            var_dump($row['year']);
            var_dump($row['path']);
            var_dump($row['departamentos']);

        }else{
            echo"Error sql3";echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con);
        }
           
        // liberar memoria
        mysqli_stmt_close($stmt);
        
        // cerrar la conexion
        mysqli_close($con);
    }
?>
        
