<?php
	if (empty($_POST['unidad'])) { //validamos que no este vacío el campo
       $errors[] = "Falta la unidad"; //mensaje en caso de error
    }else if (empty($_POST['tema'])) { 
        $errors[] = "Falta el nombre del tema";
    }else if (empty($_POST['descripcion'])) { 
        $errors[] = "Falta una descripcion";
    }else if (
        !empty($_POST['unidad']) && //si hay algo se procede
        !empty($_POST['tema']) &&
        !empty($_POST['descripcion'])  
	){
		require_once ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos
		$uni=intval($_POST['unidad']);
		$tema=mysqli_real_escape_string($con,(strip_tags($_POST["tema"],ENT_QUOTES))); //variable de texto
        $descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));

        $sql = "INSERT INTO tema (id_unidad, te_nombre, te_descripcion) VALUES ('$uni','$tema','$descripcion')";
        $query_new_insert = mysqli_query($con,$sql);
        if ($query_new_insert){
			$messages[] = "Curso registrado correctamente¡¡";
		} else{
				$errors []= "Algo ha salido mal, por favor re-intente.".mysqli_error($con);
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