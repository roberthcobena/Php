<?php	
	if (empty($_POST['m_id'])) { //validamos que no este vacío el campo
       $errors[] = "Falta id del curso"; //mensaje en caso de error
    }else if (empty($_POST['m_año'])) { 
        $errors[] = "Falta nombre del año";
    }else if (empty($_POST['m_desde'])) { 
        $errors[] = "Falta inicio de año lectivo";
    }else if (empty($_POST['m_hasta'])) { 
        $errors[] = "Falta fin del año lectivo";
    }else if (empty($_POST['m_estado'])) { 
        $errors[] = "Falta estado del curso";
    }else if (
        !empty($_POST['m_id']) && //si hay algo se procede
        !empty($_POST['m_año']) &&
        !empty($_POST['m_desde']) &&
        !empty($_POST['m_hasta']) &&
        !empty($_POST['m_estado'])  
	){
		/* Connect To Database*/
		require_once ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos		
        
        //hacemos variables que almacenen lo que esta en el modal
		$id_año=intval($_POST['m_id']); //variable númerica entera
		$año=mysqli_real_escape_string($con,(strip_tags($_POST["m_año"],ENT_QUOTES))); //variable de texto
		$desde = date("Y/m/d", strtotime($_POST["m_desde"],ENT_QUOTES));
		$hasta = date("Y/m/d", strtotime($_POST["m_hasta"],ENT_QUOTES));
        $estado=intval($_POST['m_estado']);
        
        //SQL de actualizacion de datos
		$sql="UPDATE anios_lectivos a
				JOIN cursos c
				ON c.an_lec=a.id
				JOIN doc_curso d
				ON c.id_curso=d.id_curso
				SET a.anio='".$año."', a.desde='".$desde."', a.hasta='".$hasta."', a.estado='".$estado."', c.est_curso='".$estado."', d.est_doc_cur='".$estado."' WHERE id='".$id_año."' ";
        $query_update = mysqli_query($con,$sql);
        //mensajes de exito o error
			if ($query_update){
				$messages[] = "Año Lectivo actualizado exitosamente.";
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




