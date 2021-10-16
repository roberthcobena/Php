<?php	
	require_once ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos	

	if (empty($_POST['unidad'])) {
           $errors[] = "Falta nombre de unidad";
	} else if (empty($_POST['unidad'])) {
		$errors[] = "Falta nombre de unidad";
	} else if ((!empty($_POST['unidad'])) &&
			  (!empty($_POST['unidad']))
	){
		
			$unidad=mysqli_real_escape_string($con,(strip_tags($_POST["unidad"],ENT_QUOTES)));
			$id_inves=intval($_POST["id_inv"]);

	$uploadedFile = '';
    if(!empty($_FILES["foto_in"]["type"])){
        $fileName = time().'_'.$_FILES['foto_in']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["foto_in"]["name"]);
        $file_extension = end($temporary);
        if((($_FILES["foto_in"]["type"] == "image/png") || ($_FILES["foto_in"]["type"] == "image/jpg") || ($_FILES["foto_in"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
            $sourcePath = $_FILES['foto_in']['tmp_name'];
			$carpeta = "../../fotos/$id_inves/";
				if (!file_exists($carpeta)) {
				    mkdir($carpeta, 0777, true);
				}
            $targetPath = "../../fotos/$id_inves/".$fileName;
            if(move_uploaded_file($sourcePath,$targetPath)){
                $uploadedFile = "../fotos/$id_inves/".$fileName;
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