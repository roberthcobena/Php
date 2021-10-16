<?php
	if (empty($_POST['id_d'])) { //validamos que no este vacío el campo
       $errors[] = "Falta id del usuario"; //mensaje en caso de error
    }else if (empty($_POST['nombre'])) { 
        $errors[] = "Falta nombre del usuario";
    }else if (empty($_POST['apellido'])) { 
        $errors[] = "Falta apellido del usuario";
    }else if (empty($_POST['titulo'])) { 
        $errors[] = "Falta titulo del usuario";
    }else if ((!empty($_POST['id_d'])) &&
		(!empty($_POST['nombre'])) &&
		(!empty($_POST['apellido'])) &&
		(!empty($_POST['titulo']))
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
        $titulo=mysqli_real_escape_string($con,(strip_tags($_POST["titulo"],ENT_QUOTES)));         
        
        //SQL de actualizacion de datos
		$sql="UPDATE usuario u
				JOIN datos_usuarios d
				ON u.id_usuario=d.id_usuario
				JOIN docentes o
				ON u.id_usuario=o.id_usuario
				SET d.nomb_user='$nombre', d.apell_user='$apellido', d.telf_user='$telf', d.correo_user='$correo', o.doc_titulo='$titulo' WHERE u.id_usuario='$id_user'";
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