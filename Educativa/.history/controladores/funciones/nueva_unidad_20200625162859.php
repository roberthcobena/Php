<?php	
	require_once ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos	

	if (empty($_POST['unidad'])) {
           $errors[] = "Falta nombre de unidad";
	} else if (empty($_POST['descripcion'])) {
		$errors[] = "Falta descripción de la unidad";
	} else if ((!empty($_POST['unidad'])) &&
			  (!empty($_POST['descripcion']))
	){
		
	$unidad=mysqli_real_escape_string($con,(strip_tags($_POST["unidad"],ENT_QUOTES)));
	$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["descripcion"],ENT_QUOTES)));			

	$uploadedFile = '';
    if(!empty($_FILES["portada_u"]["type"])){
        $fileName = time().'_'.$_FILES['portada_u']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["portada_u"]["name"]);
        $file_extension = end($temporary);
        if((($_FILES["portada_u"]["type"] == "image/png") || ($_FILES["portada_u"]["type"] == "image/jpg") || ($_FILES["portada_u"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
            $sourcePath = $_FILES['portada_u']['tmp_name'];
			$carpeta = "../../recursos/img/";
				if (!file_exists($carpeta)) {
				    mkdir($carpeta, 0777, true);
				}
            $targetPath = "../../recursos/img/".$fileName;
            if(move_uploaded_file($sourcePath,$targetPath)){
                $uploadedFile = "../recursos/img/".$fileName;
            }
        }
    }

		$sql="UPDATE tbl_docente SET ruta_foto='".$uploadedFile."' WHERE id_usuario='".$id_inves."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "La Foto de perfil ha sido modificada satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
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