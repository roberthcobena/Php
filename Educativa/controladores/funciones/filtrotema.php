<?php
if (empty($_POST['id'])) {
	$errors[] = "Falta id del curso";
}elseif (empty($_POST['tema'])) {
	$errors[] = "Seleccione los temas";
}elseif (empty($_POST['est'])) {
	$errors[] = "Seleccione los estudiantes";
}elseif (empty($_POST['archivo'])) {
	$errors[] = "Seleccione el ti[po de archivo";
}else if ((!empty($_POST['id'])) &&
	         (!empty($_POST['tema'])) &&
	         (!empty($_POST['est'])) &&
	         (!empty($_POST['archivo']))
	){
	include ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	include ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos
	$id=intval($_POST['id']);

	$tema = array (serialize($_POST['tema']));
	$est = array (serialize($_POST['est']));
	
	$archivo=intval($_POST['archivo']);
	if ($archivo == 1) {
		echo '<script> imprimir_reporte('.$id.','.$tema.','.$est.'); </script>';
	}elseif ($archivo == 2) {
		imprimir_excel($id,$tema,$est);
	}else{
		$errors []= "Error desconocido.";
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
						<strong>¡Reporte echo!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
?>