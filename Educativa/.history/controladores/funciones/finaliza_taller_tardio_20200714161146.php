<?php
	if ((!empty($_GET['id_c'])) &&
		(!empty($_GET['id_t']))
	){
		include ("../conexion/db.php");//Contiene las variables de configuración para conectar a la base de datos
		include ("../conexion/conexion.php");
		$curso=intval($_GET['id_c']);
		$taller=intval($_GET['id_t']);

		//id preguntas
		$pre1 =	intval($_GET['p1']);
		$pre2 =	intval($_GET['p2']);
		$pre3 =	intval($_GET['p3']);
		$pre4 =	intval($_GET['p4']);
		$pre5 =	intval($_GET['p5']);
		$pre6 =	intval($_GET['p6']);
		$pre7 =	intval($_GET['p7']);
		$pre8 =	intval($_GET['p8']);
		$pre9 =	intval($_GET['p9']);
		$pre10 =intval($_GET['p10']);
        
		//respuestas
		$resp1 = intval($_POST['pregu1']);
		$resp2 = intval($_POST['pregu2']);
		$resp3 = intval($_POST['pregu3']);
		$resp4 = intval($_POST['pregu4']);
		$resp5 = intval($_POST['pregu5']);
		$resp6 = intval($_POST['pregu6']);
		$resp7 = intval($_POST['pregu7']);
		$resp8 = intval($_POST['pregu8']);
		$resp9 = intval($_POST['pregu9']);
		$resp10 = intval($_POST['pregu10']);

				
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
						//Registramos el fin del taller
						session_start();
						$id_user = $_SESSION['id_usuario'];
						$finaliza=date("Y-m-d H:i:s");
						$sql="UPDATE alumno_taller SET fin_taller='".$finaliza."', est_taller='2' WHERE id_taller='".$taller."' AND id_alumno='".$id_user."'";
						$query_update = mysqli_query($con,$sql);

						$messages[] = "Resultados guardados.";
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