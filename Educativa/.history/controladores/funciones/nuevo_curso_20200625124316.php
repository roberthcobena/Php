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
	$cod_curso="CUR". rand(1000,9999) ."-" .date("Y");
    
    // VALIDAR SI HAY UN CURSO SIMILAR
    $sql = "SELECT * FROM cursos WHERE nom_curso = '" . $curso . "' AND sec_curso = '" . $seccion . "' AND jornada = '" . $jornada . "'";
    $query_check_user_name = mysqli_query($con,$sql);
	$query_check_user=mysqli_num_rows($query_check_user_name);
    if($query_check_user == 1) {
        $errors[] = "El curso ya existe.";
    } else { // SI NO EXISTE SE CREA
    $sqli="INSERT INTO cursos (nom_curso, sec_curso, jornada) VALUES ('$curso','$seccion','$jornada')";
    $query_new_insert = mysqli_query($con,$sqli);
		if ($query_new_insert){
			$messages[] = "Curso registrado correctamente¡¡";
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