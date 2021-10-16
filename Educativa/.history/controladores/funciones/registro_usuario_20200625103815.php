<?php 
	if(empty($_POST['new_user'])) {
	   $errors[] = "Falta nombre de usuario";
	}else if(empty($_POST['new_pass'])) {
	   $errors[] = "Falta contraseña";
	}else if ((!empty($_POST['new_user'])) &&
	         (!empty($_POST['new_pass']))
	){
	include ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	include ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos
	$usuario=mysqli_real_escape_string($con,(strip_tags($_POST["new_user"],ENT_QUOTES)));
	$pass=mysqli_real_escape_string($con,(strip_tags($_POST["new_pass"],ENT_QUOTES)));
	$tipo_usuario=intval(3);	
    
    // VALIDAR SI HAY UN USUARIO SIMILAR
    $sql = "SELECT * FROM usuario WHERE u_usuario = '" . $usuario . "' AND u_tipo = '" . $tipo_usuario . "' AND jornada = '" . $jornada . "'";
    $query_check_user_name = mysqli_query($con,$sql);
	$query_check_user=mysqli_num_rows($query_check_user_name);
    if($query_check_user == 1) {
        $errors[] = "El curso ya existe.";
    } else { // SI NO EXISTE SE CREA
    $sqli="INSERT INTO cursos (nom_curso, sec_curso, jornada) VALUES ('$usuario','$pass','$jornada')";
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