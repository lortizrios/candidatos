<?php
    require_once('conexion-bd.php');

    session_destroy();
    session_start();

    $urlCan = '../candidatos-registrados.php';
    $urlEdi = './editar.php';
    $urlInd = './index.php';

    $idDup = "Error: Numero de estudiante duplicado. Ingrese otro numero de estudiante.";       


    if(isset($_POST['registrar'])){

        $nombre = $_POST['nombre'];
        $inicial = $_POST['inicial'];
        $apellidos = $_POST['apellidos'];
        $num_estudiante = $_POST['numero-estudiante'];
        $departamento = $_POST['departamento'];
        $puesto = $_POST['puesto'];
        $posicion = $_POST['posicion'];
        $year = $_POST['year'];

        //Primero verifica si el #estudiante no existe
        $sql_validar = "SELECT * FROM candidatos WHERE id = '$num_estudiante'";
         
        $con = conectarBD();

        //Crear el prepare statement
        if ($stmt = mysqli_prepare($con, $sql_validar)) {

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
                            //echo"Guardo la foto en el folder";
                            //var_dump($move);
                            //var_dump($archivoName);
                            //var_dump($archivo['tmp_name']);

                            //Conecta a la base datos
                            $con = conectarBD();

                            //Inserta datos
                            $query = $con -> query("INSERT INTO candidatos (id, nombre, inicial, apellidos, departamento, puesto, posicion, year, path) 
                            VALUES('$num_estudiante', '$nombre', '$inicial', '$apellidos', '$departamento', '$puesto', '$posicion', '$year', '$archivoName')");

                            //valida si ejecuta query
                            if($query){
                                $_SESSION['candidato-registrado']="candidato-registrado query foto linea 75 de proceso.php";
                                header("Location: $urlCan");

                               
                            }else{ //si no entra ejecuta imprime error
                                //echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con)."\n";
                                $_SESSION['error-registrar']="error registrar query foto linea 81 de proceso.php";
                                header("Location: $urlCan");
                            }

                        }else{
                            //echo"Entro error linea 86";
                            $_SESSION['error-guardar-foto']="Registrar error guardar foto linea 86 de proceso.php";
                            header("Location: $urlCan");
                        }
                        //Termina proceso de subir archivos----------------------------
                         
                    }else{//Entra cuando el formato de foto en incorrecto
                        $_SESSION['validar_img']="Imagen en formato incorrecto linea 95 de proceso.php";
                        header("Location: $urlCan");
                    }

                    
                }else{//Query no guarda

                    $con = conectarBD();
                    
                    //query que no guarda el path
                    $queryNull = $con -> query("INSERT INTO candidatos (id, nombre, inicial, apellidos, departamento, puesto, posicion, year) 
                    VALUES('$num_estudiante', '$nombre', '$inicial', '$apellidos', '$departamento','$puesto', '$posicion', '$year')");
                    
                    var_dump($queryNull);

                    //valida si query ejecuto
                    if(!$queryNull){ 
                        $_SESSION['candidato-registrado']="candidato-registrado query sin foto linea 110 de proceso.php";
                        header("Location: $urlCan");

                     //no ejecuta el query imprime error
                    }else{
                        $_SESSION['error-registrar']="error registrar sin foto linea 115 de proceso.php";
                        //echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con)."\n";
                        header("Location: $urlCan");
                    }
                }
            }else{
                $_SESSION['estudiante-duplicado'] = "Error: Numero de estudiante duplicado linea 121 de proceso.php";
                header("Location: $urlCan");
            }
   
        }else{
            //echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con);

            $_SESSION['error-registrar']="error registrar prepare linea 128 de proceso.php";
            header("Location: $urlCan");
        }

        //Cierra conexion
        mysqli_close($con);
        
        //Cierra statement
        mysqli_stmt_close($query, $queryNull,$sql_validar);    
    }

    if(isset($_POST['update'])){

        //Variables extraidas de editar.php
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

        //subir archivos
        $archivo = $_FILES['archivo'];
        $archivoName = $archivo['name'];
        $tipo = $archivo['type'];

        //var_dump($id_post);
        
        $query_foto = "UPDATE candidatos SET id = '$num_estudiante', nombre = '$nombre', inicial = '$inicial', apellidos = '$apellidos', 
        departamento = '$departamento', puesto = '$puesto', posicion = '$posicion', year = '$year', path = '$archivoName' WHERE id = '$id_post'";


        $query_foto_vacia = "UPDATE candidatos SET id = '$num_estudiante', nombre = '$nombre', inicial = '$inicial', 
        apellidos = '$apellidos', departamento = '$departamento', puesto = '$puesto', posicion = '$posicion', year = '$year' 
        WHERE id = '$id_post'";

        $con = conectarBD();

        //Verifica si tiene foto
        if($tipo != null){
            
            //Validacion de imagen
            if($tipo == "image/jpg" || $tipo == "image/jpeg"){

                //var_dump($archivo);
        
                //si no existe el directorio 'img' lo crea
                if(!is_dir('../img_candidatos')){
                    mkdir('../img_candidatos', 0777);
                }

                //mueve la imagen del archivo temporal al archivo final
                if($move = move_uploaded_file($archivo['tmp_name'],'../img_candidatos/'.$archivoName)){
                    //echo"Guardo la foto en el folder";
                    //var_dump($move);
                    //var_dump($archivoName);
                    //var_dump($archivo['tmp_name']);
                                                
                    //Conecta a la base datos
                    $con;

                    $query_foto;
                    
                    //valida que se actualicen los datos del 
                    if($qf = mysqli_query($con,$query_foto)){
                        //var_dump($qf);
                        //echo"entro al query_foto";
                        //var_dump($id_post);
                        //Variables para cachar errores o validaciones
                        $_SESSION['update']="Session['update'] Se guardaron los datos linea 201 de proceso.php";
                       
                        //var_dump($update);
                        header("Location:$urlCan");
                        
                    }else{
                        $_SESSION['error_actualizar']="Error al actualizar los datos linea 207 de proceso.php";
                        //var_dump($error_querry);
                        //imprime el error de la conexion
                        //echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con); 
                        header("Location: $urlCan");
                    }

                }else{
                    //Variables para cachar errores o validaciones
                    $_SESSION['error-guardar-foto']="No guardo foto en folder linea 216 de proceso.php"; 
                    //var_dump($error_guardar_foto);
                    header("Location: $urlCan");
                }
                
                
            }else{
                //Variables para cachar errores o validaciones
                $_SESSION['validar_img']="Formato de img erroneo linea 224 de proceso.php";
                header("Location: $urlCan");
            }
        
            
        }else{//Si no tiene foto corre esta logica
            
            //Conecta a base de datos
            $con;
              
            //corre el query
            $query_foto_vacia;
            
            //valida que se actualicen los datos del 
            if($qfv = mysqli_query($con,$query_foto_vacia)){
                //var_dump($qfv);
                //echo "entro al query_foto_vacia linea 249";
                $_SESSION['update']="Session['update'] Se guardaron los datos Linea 214 en proceso.php";
                header("Location: $urlCan");
            }else{
                //imprime el error de la conexion
                //echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con); 
                $_SESSION['error_actualizar']= "Error al actualizar los datos linea 246 de proceso.php";
                header("Location: $urlCan");
            }
        }
        //Cierra statement
        mysqli_stmt_close($query_foto,$query_foto_vacia);

        // ce rrar la conexion
        mysqli_close($con);
    }

    //Obtiene id de boton editar e imprime los valores para utilizarlos en editar.php
    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $sql = "SELECT * FROM candidatos WHERE id = '$id'";

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
            $departamento = $row['departamento'];

            //var_dum imprime la variable insertada en un arreglo para
            //proposito de debuging
            /*var_dump($row['id']);
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
            echo"Departamento";
            var_dump($row['departamento']);*/

        }else{
            echo"Error sql3";echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con);
        }
           
        // liberar memoria
        mysqli_stmt_close($stmt);
        
        // cerrar la conexion
        mysqli_close($con);
    }
?>
        
