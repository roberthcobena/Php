<?php 
	if(empty($_POST['curso'])) {
	   $errors[] = "Falta nombre del curso";
	}else if(empty($_POST['seccion'])) {
	   $errors[] = "Falta sección del curso";
	}else if(empty($_POST['jornada'])) {
	   $errors[] = "Falta jornada del curso";
	}else if ((!empty($_POST['curso'])) &&
	         (!empty($_POST['seccion'])) &&
	         (!empty($_POST['jornada']))
	){
	include ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	include ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos
	$curso=mysqli_real_escape_string($con,(strip_tags($_POST["curso"],ENT_QUOTES)));
	$seccion=mysqli_real_escape_string($con,(strip_tags($_POST["seccion"],ENT_QUOTES)));
	$jornada=intval($_POST['jornada']);	
    
    // revisar si el codigo ya fue registrado
    $sql = "SELECT * FROM tbl_proy_result WHERE tipo_proy_result = '" . $tipo_resa . "' AND id_proyecto = '" . $proyecto . "' AND est_result = 1";
    $query_check_user_name = mysqli_query($con,$sql);
	$query_check_user=mysqli_num_rows($query_check_user_name);
    if($query_check_user == 1) {
        $errors[] = "Ya existe un resultado alcanzado de ese tipo.";
    } else {
    $sqli="INSERT INTO tbl_proy_result (id_proyecto, tipo_proy_result, des_proy_result, indi_proy_result) VALUES ('$proyecto','$tipo_resa','$des_resa','$ind_resa')";
    $query_new_insert = mysqli_query($con,$sqli);
		if ($query_new_insert){
			$messages[] = "Resultado alcanzado añadido al proyecto correctamente¡¡";
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