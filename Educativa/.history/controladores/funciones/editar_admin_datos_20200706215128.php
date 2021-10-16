<?php
	if (empty($_POST['id_d'])) { //validamos que no este vacío el campo
       $errors[] = "Falta id del usuario"; //mensaje en caso de error
    }else if (empty($_POST['nombre'])) { 
        $errors[] = "Falta nombre del usuario";
    }else if (empty($_POST['apellido'])) { 
        $errors[] = "Falta apellido del usuario";
    }else if (empty($_POST['correo'])) { 
        $errors[] = "Falta correo del usuario";
    }else if (empty($_POST['telefono'])) { 
        $errors[] = "Falta teléfono del usuario";
    }else if ((!empty($_POST['m_id'])) &&
	(!empty($_POST['m_docente'])) &&
	(!empty($_POST['m_curso'])) &&
	(!empty($_POST['m_estado']))
){
		/* Connect To Database*/
		require_once ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos		
        
        //hacemos variables que almacenen lo que esta en el modal
		$id_user=intval($_POST['id_d']); //variable númerica entera
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES))); //variable de texto
        $apellido=mysqli_real_escape_string($con,(strip_tags($_POST["apellido"],ENT_QUOTES)));
        $telf=mysqli_real_escape_string($con,(strip_tags($_POST["telefono"],ENT_QUOTES)));
        $correo=mysqli_real_escape_string($con,(strip_tags($_POST["correo"],ENT_QUOTES)));        
        
        //SQL de actualizacion de datos
		$sql="UPDATE datos_usuarios SET nomb_user='".$nombre."', apell_user='".$apellido."', telf_user='".$telf."', correo_user='".$correo."' WHERE id_usuario='".$id_user."' ";
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