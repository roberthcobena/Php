<?php
	if ((!empty($_GET['id_c'])) &&
        (!empty($_GET['id_t'])) &&
		(!empty($_GET['id_a']))
	){
		include ("../conexion/db.php");//Contiene las variables de configuración para conectar a la base de datos
		include ("../conexion/conexion.php");
        $id=intval($_GET['id_a']);
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
        //EN CASO DE ESTAR VACÍAS SE LE ASIGNA UN VALOR "5" MÁS ADELANTE SE ASIGNA ESTA RESPUESTA COMO "SIN CONTESTAR"
        $resp1 = intval($_GET['r1']);
        if (empty($resp1)){
            $resp1=intval('5');
        }
        $resp2 = intval($_GET['r2']);
        if (empty($resp2)){
            $resp2=intval('5');
        }
        $resp3 = intval($_GET['r3']);
        if (empty($resp3)){
            $resp3=intval('5');
        }
        $resp4 = intval($_GET['r4']);
        if (empty($resp4)){
            $resp4=intval('5');
        }
        $resp5 = intval($_GET['r5']);
        if (empty($resp5)){
            $resp5=intval('5');
        }
        $resp6 = intval($_GET['r6']);
        if (empty($resp6)){
            $resp6=intval('5');
        }
        $resp7 = intval($_GET['r7']);
        if (empty($resp7)){
            $resp7=intval('5');
        }
        $resp8 = intval($_GET['r8']);
        if (empty($resp8)){
            $resp8=intval('5');
        }
        $resp9 = intval($_GET['r9']);
        if (empty($resp9)){
            $resp9=intval('5');
        }
        $resp10 =intval($_GET['r10']);
        if (empty($resp10)){
            $resp10=intval('5');
        }

				
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
						$finaliza=date("Y-m-d H:i:s");						//Variable de calificación
						$nota=0;		
						///Tras cada pregunta comprobamos si es correcta o no (SI ES CORRECTA SUMAMOS 1 PUNTO A LA VARIABLE NOTA)
						$sql1 = "SELECT * FROM pregunta p WHERE p.id_pregunta=$pre1";
							$query1 = mysqli_query($con, $sql1);
							$row1 = mysqli_fetch_array($query1); 
								if ($resp1 == $row1['opc_correcta']) {
									++$nota;
								}
						$sql2 = "SELECT * FROM pregunta p WHERE p.id_pregunta=$pre2";
								$query2 = mysqli_query($con, $sql2);
								$row2 = mysqli_fetch_array($query2); 
									if ($resp2 == $row2['opc_correcta']) {
										++$nota;
									}
						$sql3 = "SELECT * FROM pregunta p WHERE p.id_pregunta=$pre3";
								$query3 = mysqli_query($con, $sql3);
								$row3 = mysqli_fetch_array($query3); 
									if ($resp3 == $row3['opc_correcta']) {
										++$nota;
									} 											
						$sql4 = "SELECT * FROM pregunta p WHERE p.id_pregunta=$pre4";
								$query4 = mysqli_query($con, $sql4);
								$row4 = mysqli_fetch_array($query4); 
									if ($resp4 == $row4['opc_correcta']) {
										++$nota;
									}
						$sql5 = "SELECT * FROM pregunta p WHERE p.id_pregunta=$pre5";
								$query5 = mysqli_query($con, $sql5);
								$row5 = mysqli_fetch_array($query5); 
									if ($resp5 == $row5['opc_correcta']) {
										++$nota;
									}
						$sql6 = "SELECT * FROM pregunta p WHERE p.id_pregunta=$pre6";
								$query6 = mysqli_query($con, $sql6);
								$row6 = mysqli_fetch_array($query6); 
									if ($resp6 == $row6['opc_correcta']) {
										++$nota;
									}
						$sql7 = "SELECT * FROM pregunta p WHERE p.id_pregunta=$pre7";
								$query7 = mysqli_query($con, $sql7);
								$row7 = mysqli_fetch_array($query7); 
									if ($resp7 == $row7['opc_correcta']) {
										++$nota;
									}
						$sql8 = "SELECT * FROM pregunta p WHERE p.id_pregunta=$pre8";
								$query8 = mysqli_query($con, $sql8);
								$row8 = mysqli_fetch_array($query8); 
									if ($resp8 == $row8['opc_correcta']) {
										++$nota;
									}
						$sql9 = "SELECT * FROM pregunta p WHERE p.id_pregunta=$pre9";
								$query9 = mysqli_query($con, $sql9);
								$row9 = mysqli_fetch_array($query9); 
									if ($resp9 == $row9['opc_correcta']) {
										++$nota;
									}
						$sql10 = "SELECT * FROM pregunta p WHERE p.id_pregunta=$pre10";
								$query10 = mysqli_query($con, $sql10);
								$row10 = mysqli_fetch_array($query10); 
									if ($resp10 == $row10['opc_correcta']) {
										++$nota;
									}
						$sql="UPDATE alumno_taller SET fin_taller='".$finaliza."', prom_taller='".$nota."', est_taller='2' WHERE id_taller='".$taller."' AND id_alumno='".$id_user."'";
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