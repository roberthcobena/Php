<?php 
	$id_taller= $_GET['id_taller'];
	}if ((!empty($id_taller))
	){
		include ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		include ("../conexion/conexion.php");
		$docente=intval($_POST['docente']);
		$curso=intval($_POST['curso']);

		$sql = "SELECT * FROM doc_curso WHERE id_curso = '" . $curso . "' ";
    	$query_check_user_name = mysqli_query($con,$sql);
		$query_check_user=mysqli_num_rows($query_check_user_name);
		if($query_check_user == 1){
			$errors[] = "El curso ya tiene un docente asignado.";
		}else{
			$sqli="INSERT INTO doc_curso (id_docente, id_curso) VALUES ('$docente','$curso')";
    		$query_new_insert = mysqli_query($con,$sqli);
    		if ($query_new_insert) {
    			$messages[] = "Asignacion realizada correctamente";
    		}else{
    			$errors []= "Algo ha salido mal, por favor re-intente.".mysqli_error($con);
    		}
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