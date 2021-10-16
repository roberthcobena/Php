<?php	
	if (empty($_POST['m_id'])) { //validamos que no este vacío el campo
       $errors[] = "Falta id de la pregunta"; //mensaje en caso de error
    }else if(empty($_POST['m_taller'])) {
	   $errors[] = "Falta el id del taller";
	}else if(empty($_POST['m_pregunta'])) {
	   $errors[] = "Escriba la pregunta";
	}else if(empty($_POST['m_op1'])) {
	   $errors[] = "Escriba la opcion de respuesta";
	}else if(empty($_POST['m_op2'])) {
	   $errors[] = "Escriba la opcion de respuesta";
	}else if(empty($_POST['m_op3'])) {
	   $errors[] = "Escriba la opcion de respuesta";
	}else if(empty($_POST['m_op4'])) {
	   $errors[] = "Escriba la opcion de respuesta";
	}else if(empty($_POST['m_correcta'])) {
	   $errors[] = "Seleccione la respuesta correcta";
	}else if(empty($_POST['m_estado'])) {
	   $errors[] = "Seleccione el estado";
	}else if (
        !empty($_POST['m_id']) && //si hay algo se procede
        (!empty($_POST['m_taller'])) &&
        (!empty($_POST['m_pregunta'])) &&
	    (!empty($_POST['m_op1'])) &&
	    (!empty($_POST['m_op2'])) &&
	    (!empty($_POST['m_op3'])) &&
	    (!empty($_POST['m_op4'])) &&
	    (!empty($_POST['m_correcta'])) &&
	    (!empty($_POST['m_estado'])) 
	){
		/* Connect To Database*/
		require_once ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos		
        
        //hacemos variables que almacenen lo que esta en el modal
		$id_pre=intval($_POST['m_id']); //variable númerica entera
		$taller=intval($_POST['m_taller']);
		$pregunta=mysqli_real_escape_string($con,(strip_tags($_POST["m_pregunta"],ENT_QUOTES)));
		$op1=mysqli_real_escape_string($con,(strip_tags($_POST["m_op1"],ENT_QUOTES)));
		$op2=mysqli_real_escape_string($con,(strip_tags($_POST["m_op2"],ENT_QUOTES)));
		$op3=mysqli_real_escape_string($con,(strip_tags($_POST["m_op3"],ENT_QUOTES)));
		$op4=mysqli_real_escape_string($con,(strip_tags($_POST["m_op4"],ENT_QUOTES)));
		$correcta=intval($_POST['m_correcta']);
		$estado=intval($_POST['m_estado']);

		
			$sql="UPDATE pregunta SET des_pregunta='".$pregunta."', opc_1='".$op1."', opc_2='".$op2."', opc_3='".$op3."', opc_4='".$op4."', opc_correcta='".$correcta."', est_pregu='".$estado."' WHERE id_pregunta='".$id_pre."' ";
        	$query_update = mysqli_query($con,$sql);
        //mensajes de exito o error
			if ($query_update){
				$messages[] = "Pregunta actualizada exitosamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		
        
        //SQL de actualizacion de datos
		
		
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