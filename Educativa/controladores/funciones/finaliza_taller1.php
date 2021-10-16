<?php

if(empty($_POST['id_alumno'])) {
	   $errors[] = "Falta el id del alumno";
}else if(empty($_POST['id_taller'])) {
	   $errors[] = "Falta el id del taller";
}else if(empty($_POST['cant_taller'])) {
	   $errors[] = "Falta cantidad de preguntas";
}else if ((!empty($_POST['id_alumno'])) &&
		     (!empty($_POST['id_taller'])) &&
	         (!empty($_POST['cant_taller']))
	){
	    include ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		include ("../conexion/conexion.php");
		$id=intval($_POST['id_alumno']);
		$taller=intval($_POST['id_taller']);
		$curso=intval($_POST['id_curso']);
		$cant=intval($_POST['cant_taller']);
		$resp[]="";
		$preg[]="";
		$vall=0;
		$val=0;
	
	    for ($i = 1; $i <= $cant; $i++) {
	    if(empty($_POST['resp'.$i])) {
	    	$errors[] = "Falta de responder la pregunta ".$i;
	    }else if(!empty($_POST['resp'.$i])){
	    	$resp[$i] = intval($_POST['resp'.$i]);
	    	$preg[$i] = intval($_POST['pregu'.$i]);
	    	++$vall;
	    }       
        }

        
        if ($vall == $cant) {
        	for ($x=1; $x <= $cant; $x++) { 
        		$consul="INSERT INTO respuesta (id_alumno, id_pregunta, resp_alumno) VALUES ('$id','$preg[$x]','$resp[$x]')";
				$query= mysqli_query($con,$consul);
				++$val;
        	}
        }else{
        	$errors []= "Error desconocido.";
        }


        if ($vall == $cant) {
        	//Registramos el fin del taller
			session_start();
			$id_user = $_SESSION['id_usuario'];
			$finaliza=date("Y-m-d H:i:s");
			//Variable de calificación
			$punt = floatval(10/$cant);
			$nota=0;
        	for ($y=1; $y <= $cant; $y++) { 
        		$sql1 = "SELECT * FROM pregunta p WHERE p.id_pregunta=$preg[$y]";
				$query1 = mysqli_query($con, $sql1);
				$row1 = mysqli_fetch_array($query1); 
					if ($resp[$y] == $row1['opc_correcta']) {
						$nota = $nota + $punt;
					}
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