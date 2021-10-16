<?php
	if (empty($_POST['id_c'])) { //validamos que no este vacío el campo
       $errors[] = "Falta id del usuario"; //mensaje en caso de error
    }else if (empty($_POST['contra_1'])) { 
        $errors[] = "Falta contraseña";
    }else if (empty($_POST['contra_2'])) { 
        $errors[] = "Falta confirmación de contraseña";
    }else if ($_POST['contra_1'] != $_POST['contra_2']) { 
        $errors[] = "Contraseñas no coinciden";
    }else if ((!empty($_POST['id_c'])) &&
		(!empty($_POST['contra_1'])) &&
		(!empty($_POST['contra_2']))
	){
		/* Connect To Database*/
		require_once ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos		
        
        //hacemos variables que almacenen lo que esta en el modal
		$id_user=intval($_POST['id_c']); //variable númerica entera
		$contra=mysqli_real_escape_string($con,(strip_tags($_POST["contra_1"],ENT_QUOTES))); //variable de texto        
        
        //SQL de actualizacion de datos
		$sql="UPDATE usuario SET u_contra='".$contra."' WHERE id_usuario='".$id_user."' ";
        $query_update = mysqli_query($con,$sql);
        //mensajes de exito o error
			if ($query_update){
				$messages[] = "Usuario actualizado exitosamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido." ;
		}
		//muestra mensajes NO TOCAR
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