<?php 
	if(empty($_POST['taller'])) {
	   $errors[] = "Falta el id del taller";
	}else if(empty($_POST['pregunta'])) {
	   $errors[] = "Escriba la pregunta";
	}else if(empty($_POST['op1'])) {
	   $errors[] = "Escriba la opcion de respuesta";
	}else if(empty($_POST['op2'])) {
	   $errors[] = "Escriba la opcion de respuesta";
	}else if(empty($_POST['op3'])) {
	   $errors[] = "Escriba la opcion de respuesta";
	}else if(empty($_POST['op4'])) {
	   $errors[] = "Escriba la opcion de respuesta";
	}else if(empty($_POST['correcta'])) {
	   $errors[] = "Seleccione la respuesta correcta";
	}else if ((!empty($_POST['taller'])) &&
	         (!empty($_POST['pregunta'])) &&
	         (!empty($_POST['op1'])) &&
	         (!empty($_POST['op2'])) &&
	         (!empty($_POST['op3'])) &&
	         (!empty($_POST['op4'])) &&
	         (!empty($_POST['correcta']))
	){
	include ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	include ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos
	$taller=intval($_POST['taller']);
	$pregunta=mysqli_real_escape_string($con,(strip_tags($_POST["pregunta"],ENT_QUOTES)));
	$op1=mysqli_real_escape_string($con,(strip_tags($_POST["op1"],ENT_QUOTES)));
	$op2=mysqli_real_escape_string($con,(strip_tags($_POST["op2"],ENT_QUOTES)));
	$op3=mysqli_real_escape_string($con,(strip_tags($_POST["op3"],ENT_QUOTES)));
	$op4=mysqli_real_escape_string($con,(strip_tags($_POST["op4"],ENT_QUOTES)));
	$correcta=intval($_POST['correcta']);
    
    // VALIDAR SI HAY UN CURSO SIMILAR
    $sql = "SELECT * FROM pregunta WHERE des_pregunta = '" . $pregunta . "' AND id_taller = '" . $taller . "' ";
    $query_check_user_name = mysqli_query($con,$sql);
	$query_check_user=mysqli_num_rows($query_check_user_name);
    if($query_check_user == 1) {
        $errors[] = "La pregunta ya existe.";
    } else { // SI NO EXISTE SE CREA

    	$consul="SELECT * FROM pregunta WHERE id_taller = '" . $taller . "' ";
    	$count=mysqli_query($con,$consul);
    	$cont=mysqli_num_rows($count);
    	$consul1="SELECT * FROM taller WHERE id_taller = '" . $taller . "' ";
    	$count1=mysqli_query($con,$consul1);
    	while ($row1= mysqli_fetch_array($count1)){
    		$cant = $row1['cant_taller'];
    	}
    	if ($cont == $cant) {
    		$errors[] = "Solo se permite crear ".$cant." preguntas.";
    	}else{
    		$sqli="INSERT INTO pregunta (id_taller, des_pregunta, opc_1, opc_2, opc_3, opc_4, opc_correcta) VALUES ('$taller','$pregunta','$op1','$op2', '$op3', '$op4', '$correcta')";
    		$query_new_insert = mysqli_query($con,$sqli);
    		if ($query_new_insert){
				$messages[] = "Pregunta creada correctamente¡¡";
			}else{
					$errors []= "Algo ha salido mal, por favor re-intente.".mysqli_error($con);
				}
    		}
   
		
          }
		
		} else{
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
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>