<!DOCTYPE html>
<html lang="es">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible".content="ie-edge-">
    
    <!--Link css-->
    <link rel="stylesheet" href="css/estilos.css">

    <!--CSS Bootsrap-->
    <link rel="stylesheet" href="css/bootstrap.min.css" >

 
    <!--Validacion textbox-->
    <script type="text/javascript" src="validation.js"></script>

    <?php 
      include(__DIR__.'/include/navbar.php'); 
      require_once(__DIR__.'/include/proceso.php'); 
    ?> 

    <title>Candidatos</title>

    <!--Imagen inter Bayamon-->
    <center>
      <img src="imagenes/inter-bayamon.jpg">  
    </center>

  </head>

  <body class="container">
    
    <hr style="margin-top:10px">

    <form class="needs-validation" method="POST" action="include/proceso.php" 
    enctype="multipart/form-data" novalidate>

      <!--Crea grupo de formas-->
      <div class="form-row" style="margin-top:10px">
         
        <input hidden type="text" name="id" value="<?php echo $id; ?>">

        <!--Renglon Nombre-->
        <div class="form-group col-md-4">
          <label for="nombre">Nombre*</label>
          <input type="text" name="nombre" class="form-control form-control-lg" id="nombre" value="<?php echo $nombre; ?>" placeholder="Nombre" required="">

          <div class="invalid-feedback">
            favor de ingresar el Nombre
          </div>
        </div>

        <!--Renglon Inicial-->
        <div class="form-group col-md-1">
          <label for="inicial">Inicial</label>
          <input type="text" name="inicial" class="form-control form-control-lg" id="inicial" value="<?php echo $inicial; ?>" placeholder="Inicial" >
        </div>

        <!--Renglon Apellido-->
        <div class="form-group col-md-7">
          <label for="apellido">Apellido*</label>
          <input type="text" name="apellidos" class="form-control form-control-lg" id="apellido" value="<?php echo $apellidos; ?>" placeholder="Apellido" required>
        
            <div class="invalid-feedback">
              favor de ingresar el Apellido
            </div>
        </div>
      </div>
          
      <!--Numero de estudiante-->
      <div class="form-group row">
        <div class="form-group col-md-4" >
          <label for="numero-estudiante">Numero de estudiante*</label>
          <input type="text" name="num_est" class="form-control form-control-lg" 
          id="id" value="<?php echo $id; ?>"  placeholder="Numero de estudiante" required>
              
          <div class="invalid-feedback">
            favor de ingresar el numero de estudiante
          </div>
        </div>

        <!--Opcion Departamento-->
        <div class="col-4" >
          <label for="departamento">Departamento*</label>
          <select class="custom-select custom-select-lg mb-3" value="" name="departamento" id='dept' required>
            <option value=" <?php echo $dep_departamento; ?> "><?php echo $dep_departamento; ?></option>
            <option value="Desconocido" name="departamento">Desconocido</option>
            <option value="Ciencias Naturales y Matemática" name="departamento">Ciencias Naturales y Matemática</option>
            <option value="Ciencias de la Salud" name="departamento">Ciencias de la Salud</option><?php 
            if($dep_departamento != Aeronáutica){
              echo "<option value='Aeronáutica' name='departamento'>Aeronáutica</option>";
            } ?>
            <option value="Estudios Humanísticos" name="departamento">Estudios Humanísticos</option>
            <option value="Administración de Empresas" name="departamento">Administración de Empresas</option>
            <option value="Comunicaciones" name="departamento">Comunicaciones</option>
            <option value="Informática" name="departamento">Informática</option>
            <option value="Ing. Eléctrica" name="departamento">Ing. Eléctrica</option>
            <option value="Ing. Industrial" name="departamento">Ing. Industrial</option>
            <option value="Ing. Mecánica" name="departamento">Ing. Mecánica</option>
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

        <!--Drop Down Year-->
        <div class="col-md-2">
          <label for="year">Año*</label>
          <select class="custom-select custom-select-lg mb-3" name="year" required>
              <option value="2019" name="year">2019</option>
              <option value="2020" name="year">2020</option>
              <option value="2021" name="year">2021</option>
              <option value="2022" name="year">2022 </option>
              <option value="2023" name="year">2023 </option>
              <option value="2024" name="year">2024</option>
              <option value="2025" name="year">2025</option>
              <option value="2026" name="year">2026</option>
              <option value="2027" name="year">2027</option>
              <option value="2028" name="year">2028</option>
          </select>

          <div class="invalid-feedback">
              Escoja Año*
          </div>
        </div>

        <div class="file" style="margin-top:15px">
          <label for="exampleFormControlFile1">Foto del candidato</label>

          <input value="file" class="form-control-file" id="archivo"
          type="file"  name="archivo">
        </div>
      </div>  
                  
      <button type="submit" class="btn btn-primary custom-select-lg"
        name="update" style="margin-bottom: 90px" value="Submit">Editar</button> 

    </form>
                
    <!--Offline-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>