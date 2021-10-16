<?php 
	if(empty($_POST['año'])) {
	   $errors[] = "Falta año lectivo";
	}else if(empty($_POST['desde'])) {
	   $errors[] = "Falta inicio de año lectivo";
	}else if(empty($_POST['hasta'])) {
	   $errors[] = "Falta fin de año lectivo";
	}else if ((!empty($_POST['año'])) &&
	         (!empty($_POST['desde'])) &&
	         (!empty($_POST['hasta']))
	){
	include ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	include ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos
	$año=mysqli_real_escape_string($con,(strip_tags($_POST["año"],ENT_QUOTES)));
	$desde = date("Y/m/d", strtotime($_POST["desde"],ENT_QUOTES));
	$hasta = date("Y/m/d", strtotime($_POST["hasta"],ENT_QUOTES));
    
    // VALIDAR SI HAY UN AÑO LECTIVO SIMILAR
    $sql = "SELECT * FROM anios_lectivos WHERE desde = '" . $desde . "' AND hasta = '" . $hasta . "' AND estado = '1'";
    $query_check_user_name = mysqli_query($con,$sql);
	$query_check_user=mysqli_num_rows($query_check_user_name);
    if($query_check_user == 1) {
        $errors[] = "Ya existe un año elesctivo en ese rango de fechas";
    } else { // SI NO EXISTE SE CREA
    $sqli="INSERT INTO anios_lectivos (anio, desde, hasta) VALUES ('$año','$desde','$hasta')";
    $query_new_insert = mysqli_query($con,$sqli);
		if ($query_new_insert){
			$messages[] = "Año registrado correctamente¡¡";
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