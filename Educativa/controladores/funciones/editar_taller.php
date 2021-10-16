<?php
	if(empty($_POST['m_id'])) {
	   $errors[] = "Falta el id";
	}else if(empty($_POST['m_tema'])) {
	   $errors[] = "Elija el tema";
	}else if(empty($_POST['m_curso'])) {
	   $errors[] = "Elija un curso";
	}else if(empty($_POST['m_nombre'])) {
	   $errors[] = "Falta el nombre";
	}else if(empty($_POST['m_cant'])) {
	   $errors[] = "Falta la cantidad de preguntas";
	}else if(empty($_POST['m_acceso'])) {
	   $errors[] = "Falta la disponibilidad del taller";
	}else if(empty($_POST['m_inicio'])) {
	   $errors[] = "Elija una fecha de inicio";
	}else if(empty($_POST['m_fin'])) {
	   $errors[] = "Elija una fecha de fin";
	}else if(empty($_POST['m_estado'])) {
	   $errors[] = "Elija un estado";
	}else if ((!empty($_POST['m_id'])) &&
		     (!empty($_POST['m_tema'])) &&
		     (!empty($_POST['m_curso'])) &&
		     (!empty($_POST['m_nombre'])) &&
		     (!empty($_POST['m_cant'])) &&
		     (!empty($_POST['m_acceso'])) &&
		     (!empty($_POST['m_inicio'])) &&
		     (!empty($_POST['m_fin'])) &&
	         (!empty($_POST['m_estado']))
	){
		include ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		include ("../conexion/conexion.php");
		$id=intval($_POST['m_id']);
		$tema=intval($_POST['m_tema']);
		$curso=intval($_POST['m_curso']);
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["m_nombre"],ENT_QUOTES)));
		$cantidad=intval($_POST['m_cant']);
		$disponi=intval($_POST['m_acceso']);
		$inicio=mysqli_real_escape_string($con,(strip_tags($_POST["m_inicio"],ENT_QUOTES)));
		$fin=mysqli_real_escape_string($con,(strip_tags($_POST["m_fin"],ENT_QUOTES)));
		$estado=intval($_POST['m_estado']);


		$sql1="SELECT * FROM taller WHERE id_taller=$id";
		$query1= mysqli_query($con,$sql1);
		while ($row1= mysqli_fetch_array($query1)){
			$cant=$row1['cant_taller'];
		}

		if ($cant==$cantidad) {
			$sql="UPDATE taller SET tema_taller='".$tema."', curs_taller='".$curso."', nom_taller='".$nombre."', cant_taller='".$cantidad."', acce_taller='".$disponi."', inicio_t='".$inicio."', fin_t='".$fin."', esta_taller='".$estado."' WHERE id_taller='".$id."' ";
            $query_update = mysqli_query($con,$sql);
            if ($query_update){
				    $messages[] = "Taller actualizado exitosamente.";
			    } else{
				    $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			    }
		}elseif($cant != $cantidad){


			$consul="SELECT * FROM pregunta p, taller t WHERE p.id_taller=t.id_taller AND t.id_taller = '$id' AND p.est_pregu='1'";
            $count=mysqli_query($con,$consul);
            $cont=mysqli_num_rows($count);
                    if ($cont == $cantidad) {

                        $sql="UPDATE taller SET tema_taller='".$tema."', curs_taller='".$curso."', nom_taller='".$nombre."', cant_taller='".$cantidad."', acce_taller='".$disponi."', inicio_t='".$inicio."', fin_t='".$fin."', esta_taller='1' WHERE id_taller='".$id."' ";
                        $query_update = mysqli_query($con,$sql);
                        if ($query_update){
				                $messages[] = "Taller actualizado exitosamente.";
			                } else{
				                $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			                }

                    }elseif($cont != $cantidad){

                    	$sql="UPDATE taller SET tema_taller='".$tema."', curs_taller='".$curso."', nom_taller='".$nombre."', cant_taller='".$cantidad."', acce_taller='".$disponi."', inicio_t='".$inicio."', fin_t='".$fin."', esta_taller='3' WHERE id_taller='".$id."' ";
                        $query_update = mysqli_query($con,$sql);
                        if ($query_update){
				                $messages[] = "Taller actualizado exitosamente.";
			                } else{
				                $errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			                }

                    }
                    


			

		}

		

	
	}else{
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