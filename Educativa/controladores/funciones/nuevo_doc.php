<?php
	if(empty($_POST['cedula'])){
		$errors[]="Falta la cedula";
	}else if(empty($_POST['nombre'])){
		$errors[]="Falta el nombre del docente";
	}else if (empty($_POST['apellido'])) {
		$errors[]="Falta el apellido del docente";
	}else if (empty($_POST['cargo'])) {
		$errors[]="Falta el cargo del docente";
	}else if (empty($_POST['titulo'])) {
		$errors[]="Falta el titulo del docente";
	}else if (empty($_POST['usuario'])) {
		$errors[]="Falta el usuario del docente";
	}else if (empty($_POST['clave'])) {
		$errors[]="Falta la clave del docente";
	}else if ((!empty($_POST['cedula'])) &&
		     (!empty($_POST['nombre'])) &&
	         (!empty($_POST['apellido'])) &&
	         (!empty($_POST['cargo'])) &&
	         (!empty($_POST['titulo'])) &&
	         (!empty($_POST['usuario'])) &&
	         (!empty($_POST['clave']))
	){
		include ("../conexion/db.php");
		include ("../conexion/conexion.php");

		$cedula=mysqli_real_escape_string($con,(strip_tags($_POST["cedula"],ENT_QUOTES)));
		$usuario=mysqli_real_escape_string($con,(strip_tags($_POST["usuario"],ENT_QUOTES)));
		$clave=mysqli_real_escape_string($con,(strip_tags($_POST["clave"],ENT_QUOTES)));
		$tipo_usuario=intval(2);
		$cargo=intval($_POST["cargo"]);
		$titulo=mysqli_real_escape_string($con,(strip_tags($_POST["titulo"],ENT_QUOTES)));
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$apellido=mysqli_real_escape_string($con,(strip_tags($_POST["apellido"],ENT_QUOTES)));
		$correo=mysqli_real_escape_string($con,(strip_tags($_POST["correo"],ENT_QUOTES)));
		$telf=mysqli_real_escape_string($con,(strip_tags($_POST["telf"],ENT_QUOTES)));

		$sql="SELECT * FROM usuario WHERE u_usuario = '" . $usuario . "'  ";
    	$query_check_user_name = mysqli_query($con,$sql);
		$query_check_user=mysqli_num_rows($query_check_user_name);

		$sql1="SELECT * FROM datos_usuarios WHERE ced_user = '" . $cedula . "'  ";
    	$query_check_user_name1 = mysqli_query($con,$sql1);
		$query_check_user1=mysqli_num_rows($query_check_user_name1);

		if($query_check_user == 1 || $query_check_user1 == 1){
			$errors[]="El usuario ya esta registrado";
		}else{
			$sqli="INSERT INTO usuario (u_usuario, u_contra, u_tipo) VALUES ('$usuario','$clave','$tipo_usuario')";
			$query_new_insert = mysqli_query($con,$sqli);
			if ($query_new_insert) {
				//obtener id
				$consul="SELECT id_usuario FROM usuario WHERE u_usuario='".$usuario."' ";
				$result=mysqli_query($con,$consul);
				$row = mysqli_fetch_assoc($result);
				$id = $row['id_usuario'];
				//llenar otras dos tablas
				$consul1="INSERT INTO datos_usuarios (id_usuario, ced_user, nomb_user, apell_user, telf_user, correo_user) VALUES ('$id', '$cedula', '$nombre', '$apellido', '$telf', '$correo')";
				$insert1= mysqli_query($con,$consul1);
				$consul2="INSERT INTO docentes (id_usuario, doc_titulo, doc_cargo) VALUES ('$id', '$titulo', '$cargo')";
				$insert2= mysqli_query($con,$consul2);
				if ($insert1 AND $insert2) {
					$messages[] = "Docente registrado correctamente¡¡";
				}else{
					$errors []= "Algo ha salido mal, por favor re-intente.".mysqli_error($con);
				}
			}else{
				$errors []= "Algo ha salido mal, por favor re-intente.".mysqli_error($con);
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
