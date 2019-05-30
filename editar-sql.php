<?php

    

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
/*Si no contiene fotos corre statement

//Conecta a la base datos
            $con = conectarBD();
            
            if(mysqli_query($con,$queryNull)){
                echo"Entro mysqli_query()";

                if(mysqli_query($con,$query2)){
                    echo "Candidato actualizado con exito. mysqli_query(con,query2)";
                    //header("Refresh:3; URL= $urlCan");
                }

            }else{
                echo"Entro al else";
                echo "ERROR: " . mysqli_errno($con) . ' - ' . mysqli_error($con);
                //header("Refresh:2; URL= $urlEdi");
            }*/ 

            //subir archivos
        $archiva = $_FILES['archivo'];
        $archivoName = $archiva['name'];
        $tipo = $archiva['type'];
        

        $id = $_GET['id'];
        
        $nombre = $_GET['nombre'];
        $inicial = $_GET['inicial'];
        $apellidos = $_GET['apellidos'];
        $num_estudiante = $_GET['num_est'];
        $departamento = $_GET['departamento'];
        $puesto =$_GET['puesto'];
        $posicion = $_GET['posicion'];
        $year = $_GET['year'];

        $query_1 = "UPDATE candidatos SET id ='$num_estudiante', nombre = '$nombre', 
        inicial = '$inicial', apellidos = '$apellidos', puesto = '$puesto', posicion = '$posicion',
        year = '$year', path ='$archivoName' WHERE id = '$id'";

        $query_2 = "UPDATE departamento SET id = NULL, num_estudiante = '$num_estudiante', 
        departamentos = '$departamento' WHERE num_estudiante = '$id'";

        $queryNull = "UPDATE candidatos SET id ='$num_estudiante', nombre = '$nombre', 
        inicial = '$inicial', apellidos = '$apellidos', puesto = '$puesto', posicion = '$posicion', 
        year = '$year' WHERE id = '$id'";

        $con = conectarBD();

        //Condicion corre si no escoje una foto
        if($tipo != null){
           

            var_dump($tipo);
            if($tipo == "image/jpg" || $tipo == "image/jpeg"){
                echo"Entro a validacion de imagen";
    
                var_dump($tipo);
                //si no existe el archivo img lo crea
                if(!is_dir('img')){
                    mkdir('img', 0777);
                    echo "creo directorio";
                }
                //mueve la imagen del archivo temporal al archivo final
                $move = move_uploaded_file($archivo['tmp_name'],'img/'.$archivoName);
        
                var_dump($move);

                //valida si el query guarda los datos
                if(mysqli_query($con,$query_1) && mysqli_query($con,$query_2)){?>
                    <script>
                        alert("Candidato actualizado con exito.");
                    </script><?php
                    //header("Refresh: 1; url= $urlCan");
                }else{
                    //imprime el error de la conexion
                    echo "Error: " . mysqli_errno($con) . ' - ' . mysqli_error($con); 
                    //header("Refresh:5; URL= $urlUpd");
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

               
?>