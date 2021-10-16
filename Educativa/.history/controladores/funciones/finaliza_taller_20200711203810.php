<?php
	if(empty($_POST['id_alumno'])) {
	   $errors[] = "Falta el id del alumno";
	}else if(empty($_POST['m_docente'])) {
	   $errors[] = "Elija un docente";
	}else if(empty($_POST['m_curso'])) {
	   $errors[] = "Elija un curso";
	}else if(empty($_POST['m_estado'])) {
	   $errors[] = "Elija un estado";
	}else if ((!empty($_POST['m_id'])) &&
		     (!empty($_POST['m_docente'])) &&
		     (!empty($_POST['m_curso'])) &&
	         (!empty($_POST['m_estado']))
	){
		include ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		include ("../conexion/conexion.php");
		$id_curso=intval($_POST['m_id']);
		$docente=intval($_POST['m_docente']);
		$curso=intval($_POST['m_curso']);
		$estado=intval($_POST['m_estado']);		

		$sqli="INSERT INTO alumno_taller (id_taller, id_alumno, ini_taller) VALUES ('$id_taller','$id','$inicia')";
		$query_new_insert = mysqli_query($con,$sqli);
        if ($$query_new_insert){
				//Registramos el fin del taller
				$finaliza=date("Y-m-d H:i:s");
				$sql="UPDATE alumno_taller SET id_docente='".$docente."', id_curso='".$curso."', est_doc_cur='".$estado."' WHERE id_doc_cur='".$id_curso."' ";
				$query_update = mysqli_query($con,$sql);
				$messages[] = "Asignacion actualizada exitosamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}

	}else{
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
						<strong>¡Bien hecho! </strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
?>