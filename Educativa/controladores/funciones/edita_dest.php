<?php
	if (empty($_POST['m_id'])) { //validamos que no este vacío el campo
       $errors[] = "Falta id del curso"; //mensaje en caso de error
    }else if (empty($_POST['m_nombre'])) { 
        $errors[] = "Falta el nombre del estudiante";
    }else if (empty($_POST['m_apellido'])) { 
        $errors[] = "Falta el apellido del estudiante";
    }else if (empty($_POST['m_curso'])) { 
        $errors[] = "Falta el curso del estudiante";
    }else if (empty($_POST['m_usuario'])){
    	$errors[] = "Falta el usuario";
    }else if (empty($_POST['m_clave'])) { 
        $errors[] = "Falta una clave";
    }else if (empty($_POST['m_estado'])) { 
        $errors[] = "Falta estado del usario";
    }else if (
        !empty($_POST['m_id']) && //si hay algo se procede
        !empty($_POST['m_nombre']) &&
        !empty($_POST['m_apellido']) &&
        !empty($_POST['m_curso']) &&
        !empty($_POST['m_usuario']) &&
        !empty($_POST['m_clave']) &&
        !empty($_POST['m_estado'])  
	){
		/* Connect To Database*/
		require_once ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos		
        
        //hacemos variables que almacenen lo que esta en el modal
		$id_user=intval($_POST['m_id']); //variable númerica entera
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["m_nombre"],ENT_QUOTES))); //variable de texto
        $apellido=mysqli_real_escape_string($con,(strip_tags($_POST["m_apellido"],ENT_QUOTES)));
        $curso=intval($_POST['m_curso']);
        $usuario=mysqli_real_escape_string($con,(strip_tags($_POST["m_usuario"],ENT_QUOTES)));
        $clave=mysqli_real_escape_string($con,(strip_tags($_POST["m_clave"],ENT_QUOTES)));
        $estado=intval($_POST['m_estado']);
        
        //SQL de actualizacion de datos
		$sql="UPDATE usuario u
				JOIN datos_usuarios d
				ON u.id_usuario=d.id_usuario
				JOIN alumnos a
				ON u.id_usuario=a.alum_usu
				SET u.u_usuario='$usuario', u.u_contra='$clave', u.u_estado='$estado', d.nomb_user='$nombre', d.apell_user='$apellido', d.esta_user='$estado', a.alum_seccion='$curso', a.alum_estado='$estado' WHERE u.id_usuario='$id_user'";
        $query_update = mysqli_query($con,$sql);
        //mensajes de exito o error
			if ($query_update){
				$messages[] = "Usuario actualizado exitosamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
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