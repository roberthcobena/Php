<?php	
	require_once ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../conexion/conexion.php");//Contiene funcion que conecta a la base de datos	

	if (empty($_POST['m_id'])) {
           $errors[] = "Falta id de unidad";
	} else if (empty($_POST['m_unidad'])) {
		$errors[] = "Falta nombre de la unidad";
	} else if (empty($_POST['m_descripcion'])) {
		$errors[] = "Falta nombre de la unidad";
	} else if ((!empty($_POST['m_id'])) &&
			   (!empty($_POST['m_unidad'])) &&
			   (!empty($_POST['m_descripcion'])) &&
			   (!empty($_POST['m_estado']))
	){
		
	$id_unidad=intval($_POST['m_id']);
	$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["m_unidad"],ENT_QUOTES)));
	$descripcion=mysqli_real_escape_string($con,(strip_tags($_POST["m_descripcion"],ENT_QUOTES)));			
	$estado=intval($_POST['m_estado']);
	
	//ALMACENADO DE ARCHIVO
	$uploadedFile = '';
    if(!empty($_FILES["portada_info"]["type"])){
        $fileName = time().'_'.$_FILES['portada_info']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["portada_info"]["name"]);
        $file_extension = end($temporary);
        if((($_FILES["portada_info"]["type"] == "image/png") || ($_FILES["portada_info"]["type"] == "image/jpg") || ($_FILES["portada_info"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
            $sourcePath = $_FILES['portada_info']['tmp_name'];
			$carpeta = "../../recursos/img/";
				if (!file_exists($carpeta)) {
				    mkdir($carpeta, 0777, true);
				}
            $targetPath = "../../recursos/img/".$fileName;
            if(move_uploaded_file($sourcePath,$targetPath)){
				$uploadedFile = "../recursos/img/".$fileName;
				$sql="UPDATE unidad SET uni_nombre='".$nombre."', uni_descripcion='".$descripcion."', url_img='".$uploadedFile."', uni_est='".$estado."' WHERE id_unidad='".$id_unidad."' ";		
            }else{
				$sql="UPDATE unidad SET uni_nombre='".$nombre."', uni_descripcion='".$descripcion."', uni_est='".$estado."' WHERE id_unidad='".$id_unidad."' ";		
			}
        }
    }
		
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "La unidad ha sido modificada satisfactoriamente.";
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