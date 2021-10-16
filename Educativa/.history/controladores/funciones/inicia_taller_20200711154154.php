<?php 
	session_start();
	$id = $_SESSION['id_usuario']; 
	$id_taller= $_GET['id_taller'];
	if(!empty($id_taller))
	{
		include ("../conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		include ("../conexion/conexion.php");
		
		$inicia=date("Y-m-d H:i:s");
		$sqli="INSERT INTO alumno_taller (id_taller, id_alumno, ini_taller) VALUES ('$id_taller','$id','$inicia')";
		$query_new_insert = mysqli_query($con,$sqli);
	}
		