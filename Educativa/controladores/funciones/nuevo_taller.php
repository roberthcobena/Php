<?php 
	if(empty($_POST['tema'])) {
	   $errors[] = "Falta el tema";
	}else if(empty($_POST['curso'])) {
	   $errors[] = "Falta el curso";
	}else if(empty($_POST['nombre'])) {
	   $errors[] = "Falta el nombre del taller";
	}else if(empty($_POST['cantidad'])) {
	   $errors[] = "Falta la cantidad de pregubtas del taller";
	}else if(empty($_POST['disponi'])) {
	   $errors[] = "Falta la disponibilidad del taller";
	}else if(empty($_POST['inicio'])) {
	   $errors[] = "Falta la fecha de inicio";
	}else if(empty($_POST['fin'])) {
	   $errors[] = "Falta la fecha de final";
	}else if ((!empty($_POST['tema'])) &&
	         (!empty($_POST['curso'])) &&
	         (!empty($_POST['nombre'])) &&
	         (!empty($_POST['cantidad'])) &&
	         (!empty($_POST['disponi'])) &&
	         (!empty($_POST['inicio'])) &&
	         (!empty($_POST['fin']))
	){
	include ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	include ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos
	$tema=intval($_POST['tema']);
	$curso=intval($_POST['curso']);
	$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
	$cantidad=intval($_POST['cantidad']);
	$disponi=intval($_POST['disponi']);
	$inicio=mysqli_real_escape_string($con,(strip_tags($_POST["inicio"],ENT_QUOTES)));
	$fin=mysqli_real_escape_string($con,(strip_tags($_POST["fin"],ENT_QUOTES)));
    
    // VALIDAR SI HAY UN CURSO SIMILAR
    $sql = "SELECT * FROM taller WHERE tema_taller = '" . $tema . "' AND curs_taller = '" . $curso . "' AND nom_taller = '" . $nombre . "' ";
    $query_check_user_name = mysqli_query($con,$sql);
	$query_check_user=mysqli_num_rows($query_check_user_name);
    if($query_check_user == 1) {
        $errors[] = "El taller ya existe.";
    } else { // SI NO EXISTE SE CREA
    $sqli="INSERT INTO taller (tema_taller, curs_taller, nom_taller, cant_taller, acce_taller, inicio_t, fin_t, esta_taller) VALUES ('$tema','$curso','$nombre','$cantidad','$disponi','$inicio', '$fin', '3')";
    $query_new_insert = mysqli_query($con,$sqli);
		if ($query_new_insert){
			$messages[] = "Taler creado correctamente¡¡";
		} else{
				$errors []= "Algo ha salido mal, por favor re-intente.".mysqli_error($con);
			}
          }
		} else{
			$errors []= "Error desconocido.";
		}
		if (isset($errors)){
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>