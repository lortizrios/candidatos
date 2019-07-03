<?php require_once('include/conexion-bd.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<?php 
    $con = conectarBD();
    
	$output = '';
	if(isset($_POST["query"])){
		$search = mysqli_real_escape_string($con, $_POST["query"]);
        $query = "
        SELECT * FROM candidatos
		WHERE CONCAT(nombre, ' ', apellidos) LIKE '%".$search."%'
        OR departamento LIKE '%".$search."%'
        OR puesto LIKE '%".$search."%' ORDER BY nombre";
	}else{
		$query = "SELECT * FROM candidatos ORDER BY year";
	}

	$result = mysqli_query($con, $query);

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
			<th>Año</th>
			<th>Activar</th>
		</tr>';
		echo $output;
					
		//Imprime todos los candidatos
		while($row = mysqli_fetch_array($result)){
				
			//Imprime candidatos con stat == 1
			if($row['stat'] != 1){
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
					echo"<td>".$row["inicial"]."</td>\n";
					echo"<td>".$row["apellidos"]."</td>\n";

					echo "<td>".$row['departamento']."</td>\n";
					

					echo"<td>".$row["puesto"]."</td>\n";
					echo"<td>".$row["posicion"]."</td>\n";
					echo"<td>".$row["year"]."</td>\n";

					echo"<td><a class='enable' href='#' onclick='return false' id = ".$row['id']." nombre = ".$row['nombre']."  
					inicial=".$row["inicial"]." apellido = ".$row['apellidos'].">Activar</button></td>\n";
				echo"</tr>";
			}
		} 
	}else{
		echo "<h5 style='color: red;'>Candidato no encontrado.<h5> ";
	}

	// liberar memoria
	mysqli_stmt_close($result);
	
	//Cierra conexion
	mysqli_close($con);
?>

<script type="text/javascript">

	$('.enable').click(function(){
		var id = $(this).attr("id");
		var nombre = $(this).attr("nombre");
		var apellido = $(this).attr("apellido");
	
		swal({
			title: "Activar",
			text: "¿Deseas reactivar a "+nombre+"?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then(function(reactivar){
			if(reactivar){   
				//Envia los datos para habilitar-candidato.php
				$.ajax({            
					url:'include/habilitar-candidato.php',
					type:'get',
					data:{idd:id},
				}) 
				
				//Refresca la pagina
				location.reload(true);
						
				swal({
					title: "Activado",
					text: "¡"+nombre+" ha sido reactivado!",
					icon: "success",
					buttons: false,
					timer: 3000,
				});          
			}
		})
	})
</script>
