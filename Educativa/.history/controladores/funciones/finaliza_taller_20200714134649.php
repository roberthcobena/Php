<?php
	$finaliza=date("Y-m-d H:i:s");

	if(empty($_POST['id_alumno'])) {
	   $errors[] = "Falta el id del alumno";
	}else if(empty($_POST['id_taller'])) {
	   $errors[] = "Falta el id del taller";
	}else if(empty($_POST['resp1'])) {
	   $errors[] = "Conteste la pregunta 1";
	}else if(empty($_POST['resp2'])) {
	   $errors[] = "Conteste la pregunta 2";
	}else if(empty($_POST['resp3'])) {
	   $errors[] = "Conteste la pregunta 3";
	}else if(empty($_POST['resp4'])) {
	   $errors[] = "Conteste la pregunta 4";
	}else if(empty($_POST['resp5'])) {
	   $errors[] = "Conteste la pregunta 5";
	}else if(empty($_POST['resp6'])) {
	   $errors[] = "Conteste la pregunta 6";
	}else if(empty($_POST['resp7'])) {
	   $errors[] = "Conteste la pregunta 7";
	}else if(empty($_POST['resp8'])) {
	   $errors[] = "Conteste la pregunta 8";
	}else if(empty($_POST['resp9'])) {
	   $errors[] = "Conteste la pregunta 9";
	}else if(empty($_POST['resp10'])) {
	   $errors[] = "Conteste la pregunta 10";
	}else if ((!empty($_POST['id_alumno'])) &&
		     (!empty($_POST['id_taller'])) &&
		     (!empty($_POST['resp1'])) &&
		     (!empty($_POST['resp2'])) &&
		     (!empty($_POST['resp3'])) &&
		     (!empty($_POST['resp4'])) &&
		     (!empty($_POST['resp5'])) &&
		     (!empty($_POST['resp6'])) &&
		     (!empty($_POST['resp7'])) &&
		     (!empty($_POST['resp8'])) &&
		     (!empty($_POST['resp9'])) &&
	         (!empty($_POST['resp10']))
	){
		include ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		include ("../conexion/conexion.php");
		$id=intval($_POST['id_alumno']);
		$taller=intval($_POST['id_taller']);
		$curso=intval($_POST['id_curso']);


		//respuestas
		$resp1 =	intval($_POST['resp1']);
		$resp2 =	intval($_POST['resp2']);
		$resp3 =	intval($_POST['resp3']);
		$resp4 =	intval($_POST['resp4']);
		$resp5 =	intval($_POST['resp5']);
		$resp6 =	intval($_POST['resp6']);
		$resp7 =	intval($_POST['resp7']);
		$resp8 =	intval($_POST['resp8']);
		$resp9 =	intval($_POST['resp9']);
		$resp10 = intval($_POST['resp10']);

		//id preguntas
		$pre1 = intval($_POST['pregu1']);
		$pre2 = intval($_POST['pregu2']);
		$pre3 = intval($_POST['pregu3']);
		$pre4 = intval($_POST['pregu4']);
		$pre5 = intval($_POST['pregu5']);
		$pre6 = intval($_POST['pregu6']);
		$pre7 = intval($_POST['pregu7']);
		$pre8 = intval($_POST['pregu8']);
		$pre9 = intval($_POST['pregu9']);
		$pre10 = intval($_POST['pregu10']);

				//Registramos el fin del taller
				$finaliza=date("Y-m-d H:i:s");
				$sql="UPDATE alumno_taller SET fin_taller='".$finaliza."', est_taller='2' WHERE id_taller='".$taller."' ";
				$query_update = mysqli_query($con,$sql);
				//$messages[] = "Asignacion actualizada exitosamente.";
				if ($query_update) {
					$consul1="INSERT INTO respuesta (id_alumno, id_pregunta, resp_alumno) VALUES ('$id','$pre1','$resp1')";
					$query1= mysqli_query($con,$consul1);

					$consul2="INSERT INTO respuesta (id_alumno, id_pregunta, resp_alumno) VALUES ('$id','$pre2','$resp2')";
					$query2= mysqli_query($con,$consul2);

					$consul3="INSERT INTO respuesta (id_alumno, id_pregunta, resp_alumno) VALUES ('$id','$pre3','$resp3')";
					$query3= mysqli_query($con,$consul3);

					$consul4="INSERT INTO respuesta (id_alumno, id_pregunta, resp_alumno) VALUES ('$id','$pre4','$resp4')";
					$query4= mysqli_query($con,$consul4);

					$consul5="INSERT INTO respuesta (id_alumno, id_pregunta, resp_alumno) VALUES ('$id','$pre5','$resp5')";
					$query5= mysqli_query($con,$consul5);

					$consul6="INSERT INTO respuesta (id_alumno, id_pregunta, resp_alumno) VALUES ('$id','$pre6','$resp6')";
					$query6= mysqli_query($con,$consul6);

					$consul7="INSERT INTO respuesta (id_alumno, id_pregunta, resp_alumno) VALUES ('$id','$pre7','$resp7')";
					$query7= mysqli_query($con,$consul7);

					$consul8="INSERT INTO respuesta (id_alumno, id_pregunta, resp_alumno) VALUES ('$id','$pre8','$resp8')";
					$query8= mysqli_query($con,$consul8);

					$consul9="INSERT INTO respuesta (id_alumno, id_pregunta, resp_alumno) VALUES ('$id','$pre9','$resp9')";
					$query9= mysqli_query($con,$consul9);

					$consul10="INSERT INTO respuesta (id_alumno, id_pregunta, resp_alumno) VALUES ('$id','$pre10','$resp10')";
					$query10= mysqli_query($con,$consul10);

					if ($query1 AND $query2 AND $query3 AND $query4 AND $query5 AND $query6 AND $query7 AND $query8 AND $query9 AND $query10) {
						$messages[] = "Resultados guardados.";
					}else{
						$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
					}
				}else{
					$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
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