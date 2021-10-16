<?php
	if (empty($_POST['m_id'])) { //validamos que no este vacío el campo
       $errors[] = "Falta id del docente"; //mensaje en caso de error
    }else if (empty($_POST['m_cedula'])) { 
        $errors[] = "Falta nombre del docente";
    }else if (empty($_POST['m_nombre'])) { 
        $errors[] = "Falta nombre del docente";
    }else if (empty($_POST['m_apellido'])) { 
        $errors[] = "Falta apellido del docente";
    }else if (empty($_POST['m_titulo'])){
    	$errors[] = "Falta el titulo del docente";
    }else if (empty($_POST['m_cargo'])){
    	$errors[] = "Falta el cargo del docente";
    }else if (empty($_POST['m_estado'])) { 
        $errors[] = "Falta estado del docente";
    }else if (
        !empty($_POST['m_id']) && //si hay algo se procede
        !empty($_POST['m_cedula']) &&
        !empty($_POST['m_nombre']) &&
        !empty($_POST['m_apellido']) &&
        !empty($_POST['m_titulo']) &&
        !empty($_POST['m_cargo']) &&
        !empty($_POST['m_estado'])  
	){
		/* Connect To Database*/
		require_once ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos		
        
        //hacemos variables que almacenen lo que esta en el modal
		$id_user=intval($_POST['m_id']); //variable númerica entera
		$cedula=mysqli_real_escape_string($con,(strip_tags($_POST["m_cedula"],ENT_QUOTES)));
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["m_nombre"],ENT_QUOTES))); //variable de texto
        $apellido=mysqli_real_escape_string($con,(strip_tags($_POST["m_apellido"],ENT_QUOTES)));
        $titulo=mysqli_real_escape_string($con,(strip_tags($_POST["m_titulo"],ENT_QUOTES)));
        $cargo=intval($_POST['m_cargo']);
        $estado=intval($_POST['m_estado']);
        
        //SQL de actualizacion de datos
		$sql="UPDATE usuario u
				JOIN datos_usuarios d
				ON u.id_usuario=d.id_usuario
				JOIN docentes o
				ON u.id_usuario=o.id_usuario
				SET d.ced_user='$cedula', d.nomb_user='$nombre', d.apell_user='$apellido', o.doc_titulo='$titulo', o.doc_cargo='$cargo',o.doc_estado='$estado', u.u_estado='$estado', d.esta_user='$estado' WHERE o.id_docente='$id_user'";
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
