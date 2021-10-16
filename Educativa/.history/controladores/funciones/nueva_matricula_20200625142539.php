<?php 
	if(empty($_POST['m_alumno'])) {
		$errors[] = "Falta id del alumno";
	 }else if(empty($_POST['m_cod'])) {
		$errors[] = "Falta código del curso";
	 }else if ((!empty($_POST['m_alumno'])) &&			  
			  (!empty($_POST['m_cod']))
	 ){
	include ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	include ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$alumno=intval($_POST['m_alumno']);
	$curso=mysqli_real_escape_string($con,(strip_tags($_POST["m_cod"],ENT_QUOTES)));
    // VALIDAR SI YA ESTA MATRICULADO
    $sql = "SELECT * FROM cursos c, alumnos a WHERE c.id_curso=a.alum_seccion AND c.cod_curso = '" . $curso . "' AND a.alum_usu = '" . $alumno . "'";
    $query_check_user_name = mysqli_query($con,$sql);
	$query_check_user=mysqli_num_rows($query_check_user_name);
    if($query_check_user == 1) {
        $errors[] = "Usted ya está matriculado en dicho curso.";
    } else { // SI NO EXISTE SE CREA
    $sqli="INSERT INTO cursos (nom_curso, cod_curso, sec_curso, jornada) VALUES ('$curso','$cod_curso','$seccion','$jornada')";
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