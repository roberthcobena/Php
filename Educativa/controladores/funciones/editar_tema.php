<?php 
	if (empty($_POST['m_id'])) { //validamos que no este vacío el campo
       $errors[] = "Falta id del tema"; //mensaje en caso de error
    }else if (empty($_POST['m_unidad'])) { 
        $errors[] = "Falta la unidad";
    }else if (empty($_POST['m_tema'])) { 
        $errors[] = "Falta el nombre del tema";
    }else if (empty($_POST['m_descripcion'])) { 
        $errors[] = "Falta una descripcion";
    }else if (empty($_POST['m_estado'])) { 
        $errors[] = "Falta estado del curso";
    }else if (
        !empty($_POST['m_id']) && //si hay algo se procede
        !empty($_POST['m_unidad']) &&
        !empty($_POST['m_tema']) &&
        !empty($_POST['m_descripcion']) &&
        !empty($_POST['m_estado'])  
	){
		require_once ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos
		$id_tema=intval($_POST['m_id']); //variable númerica entera
		$uni=intval($_POST['m_unidad']);
		$tema=mysqli_real_escape_string($con,(strip_tags($_POST["m_tema"],ENT_QUOTES))); //variable de texto
        $descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["m_descripcion"],ENT_QUOTES)));
        $estado=intval($_POST['m_estado']);

        $sql="UPDATE tema SET id_unidad='".$uni."', te_nombre='".$tema."', te_descripcion='".$descripcion."', tem_estado='".$estado."' WHERE id_tema='".$id_tema."' ";
        $query_update = mysqli_query($con,$sql);
        if ($query_update){
				$messages[] = "Tema actualizado exitosamente.";
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