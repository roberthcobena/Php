<?php 
	session_start();
	$id = $_SESSION['id_usuario']; 
	$id_taller= $_GET['id_taller'];
	if(!empty($id_taller))
	{
		include ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		include ("../conexion/conexion.php");
		
		$inicia=date("Y-m-d H:i:s");
		$sqli="INSERT INTO alumno_taller (id_taller, id_alumno, ini_taller) VALUES ('$id_taller','$id','$inicia')";
		$query_new_insert = mysqli_query($con,$sqli);
		if ($query_new_insert) {
			$messages[] = "Asignacion realizada correctamente";
		}else{
			$errors []= "Algo ha salido mal, por favor re-intente.".mysqli_error($con);
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