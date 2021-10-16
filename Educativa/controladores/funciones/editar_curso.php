<?php	
	if (empty($_POST['m_id'])) { //validamos que no este vacío el campo
       $errors[] = "Falta id del curso"; //mensaje en caso de error
    }else if (empty($_POST['m_curso'])) { 
        $errors[] = "Falta nombre del curso";
    }else if (empty($_POST['m_seccion'])) { 
        $errors[] = "Falta sección del curso";
    }else if (empty($_POST['m_jornada'])) { 
        $errors[] = "Falta Jornada del curso";
    }else if (empty($_POST['m_estado'])) { 
        $errors[] = "Falta estado del curso";
    }else if (
        !empty($_POST['m_id']) && //si hay algo se procede
        !empty($_POST['m_curso']) &&
        !empty($_POST['m_seccion']) &&
        !empty($_POST['m_jornada']) &&
        !empty($_POST['m_estado'])  
	){
		/* Connect To Database*/
		require_once ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos		
        
        //hacemos variables que almacenen lo que esta en el modal
		$id_curso=intval($_POST['m_id']); //variable númerica entera
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["m_curso"],ENT_QUOTES))); //variable de texto
        $seccion=mysqli_real_escape_string($con,(strip_tags($_POST["m_seccion"],ENT_QUOTES)));
        $jornada=intval($_POST['m_jornada']);
        $estado=intval($_POST['m_estado']);
        
        //SQL de actualizacion de datos
		$sql="UPDATE cursos SET nom_curso='".$nombre."', sec_curso='".$seccion."', jornada='".$jornada."', est_curso='".$estado."' WHERE id_curso='".$id_curso."' ";
        $query_update = mysqli_query($con,$sql);
        //mensajes de exito o error
			if ($query_update){
				$messages[] = "Curso actualizado exitosamente.";
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




