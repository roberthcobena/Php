<?php
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_id_obj'])) {
       $errors[] = "Id de objetivo";
    }else if (
		!empty($_POST['mod_id_obj'])  
	){
		/* Connect To Database*/
		require_once ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		
		$id_obj=intval($_POST['mod_id_obj']);
		$just=mysqli_real_escape_string($con,(strip_tags($_POST["mod_just_obj"],ENT_QUOTES)));
		$descrip=mysqli_real_escape_string($con,(strip_tags($_POST["mod_desc_obj"],ENT_QUOTES)));
		
		$sql="UPDATE tbl_pr_obj_espe SET justi_obj='".$just."', cumpl_obje='".$descrip."' WHERE id_pr_obj_espe='".$id_obj."' ";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Cumplimiento de objetivo actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
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




