<!DOCTYPE html>
    <html>
        <head>

            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta http-equiv="x-ua-compatible".content="ie-edge-">
            
            <title>Candidatos</title>
            
            <?php include("navbar.php")?>

            <script type="text/javascript" src="validation.js"></script>
            
            <!--Imagen inter Bayamon-->
            <center>
                <img src="imagenes/inter-bayamon.jpg">  
            </center>

            <!--Link css-->
            <link rel="stylesheet" href="practica/css/estilos.css">

            <!-- Bootstrap CSS -->
            <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
            
            <!--Link css-->
            <link rel="stylesheet" href="css/bootstrap.min.css">

        </head>

            <body class="container">
                <hr style="margin-top:10px">

                <form class="needs-validation"  action="proceso.php" method="POST" novalidate>

                    <!--Crea grupo de formas-->
                    <div class="form-row" style="margin-top:10px">
                        
                        <!--Renglon Nombre-->
                        <div class="form-group col-md-4">
                            <label for="nombre">Nombre*</label>
                            <input type="text" name="nombre" class="form-control form-control-lg" id="nombre" placeholder="Nombre" required="">

                            <div class="invalid-feedback">
                                favor de ingresar el Nombre
                            </div>
                        </div>

                        <!--Renglon Inicial-->
                        <div class="form-group col-md-1">
                            <label for="inicial">Inicial</label>
                            <input type="text" name="inicial" class="form-control form-control-lg" id="inicial" placeholder="Inicial" >
                        </div>

                        <!--Renglon Apellido-->
                        <div class="form-group col-md-7">
                            <label for="apellido">Apellido*</label>
                            <input type="text" name="apellidos" class="form-control form-control-lg" id="apellido" placeholder="Apellido" required>
                        
                            <div class="invalid-feedback">
                                favor de ingresar el Apellido
                            </div>
                        </div>
                    </div>
                    
                    <!--Numero de estudiante-->
                    <div class="form-group row">
                        <div class="form-group col-md-4" >
                            <label for="numero-estudiante">Numero de estudiante*</label>
                            <input type="text" name="numero-estudiante" class="form-control form-control-lg" id="numero-estudiante" placeholder="Numero de estudiante" required>
                            
                            <div class="invalid-feedback">
                                favor de ingresar el numero de estudiante
                            </div>
                        </div>

                        <!--Opcion Departamento-->
                        <div class="col-4" >
                            <label for="departamento">Departamento*</label>
                            <select class="custom-select custom-select-lg mb-3" name="departamento" required>
                                <option value="">Escoja el departamento...</option>
                                <option value="1" name="departamento">Desconocido</option>
                                <option value="2" name="departamento">Ciencias Naturales y Matemática </option>
                                <option value="3" name="departamento">Ciencias de la Salud</option>
                                <option value="4" name="departamento">Aeronáutica</option>
                                <option value="5" name="departamento">Estudios Humanísticos</option>
                                <option value="6" name="departamento">Administración de Empresas</option>
                                <option value="7" name="departamento">Comunicaciones</option>
                                <option value="8" name="departamento">Informática</option>
                                <option value="9" name="departamento">Ing. Eléctrica</option>
                                <option value="10" name="departamento">Ing. Industrial</option>
                                <option value="11" name="departamento">Ing. Mecánica </option>
                            </select>
                            
                            <div class="invalid-feedback">
                                favor de escojer el departamento
                            </div>

                        </div>

                        <!--Opcion Puesto-->
                        <div class="col-4">
                            <label for="puesto">Puesto*</label>
                            <select class="custom-select custom-select-lg mb-3" name="puesto" required>
                                <option value="">Escoja el puesto...</option>
                                <option value="1" name="puesto">Presidente</option>
                                <option value="2" name="puesto">Vicepresidente</option>
                                <option value="3" name="puesto">Secretario</option>
                                <option value="4" name="puesto">Tesorero</option>
                                <option value="5" name="puesto">Vocal</option>
                                <option value="6" name="puesto">Senador</option>

                            </select>

                            <div class="invalid-feedback">
                            favor de escojer el puesto
                            </div>
                        </div>

                        <!--Opcion Posicion-->
                        <div class="col-md-3">
                            <label for="posicion">Posición*</label>
                            <select class="custom-select custom-select-lg mb-3" name="posicion" required>
                                <option value="">Escoja la posición...</option>
                                <option value="1" name="posicion">Primera posición</option>
                                <option value="2" name="posicion">Segunda posición</option>
                                <option value="3" name="posicion">Tercera posición</option>
                                <option value="4" name="posicion">Cuarta posición </option>
                                <option value="5" name="posicion">Quinta posición </option>
                            </select>

                            <div class="invalid-feedback">
                                favor de escojer la posición
                            </div>
                        </div> 

                        <!--Subir documento boton pequeno-->
                        <div class="form-group" style="margin-top:15px">
                            <label for="exampleFormControlFile1">Example file input</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>  
                        
                    </div>  
                        
                    <button type="submit" class="btn btn-primary custom-select-lg" 
                    name="registrar" style="margin-bottom: 90px" value="Submit" onclick="go()">Registrar Candidato
                    </button>
                    
                </form>
                      
                <!--Offline-->
                <script src="js/jquery.js"></script>
                <script src="js/bootstrap.min.js"></script>
                <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>-->
            </body>
    </html>