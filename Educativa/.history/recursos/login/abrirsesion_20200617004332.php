<?php 
session_start();
include("../core/conexion.php");
$con = new bd();

$usuario = $_POST["username"];
$clave = $_POST["pass"];

// $consulta="SELECT * FROM usuario WHERE u_usuario='$usuario' and u_contra='$clave' and u_estado=1";

// $resultado=mysqli_query($conexion, $consulta);
// $tipus=mysqli_fetch_array($resultado);
// $filas=mysqli_num_rows($resultado);
// if ($filas>0)
// {
//  	if ($tipus ["u_tipo"]=='alumno') 
//  	{header("location:../unidades/unidades.html");}
//  	else{header("location:../admin/administrador.html");}
//  }
// else{
// 	echo "<script>alert('El usuario o contraseña estan incorrectos'); location.href='index.php';</script>";
// 	}
// mysqli_free_result($resultado);
// mysqli_free_result($tipus);
// mysqli_close($conexion);


$arreglox = $con->login($usuario, $clave);
$tipus = $con->sesion($usuario);

if($arreglox == false){
	echo "<script>alert('El usuario o contraseña estan incorrectos'); location.href='login.php';</script>";
}else if ($tipus == 1){
	foreach($arreglox as $variable){
		$_SESSION['usuario'] = $variable["u_usuario"];
	}
    	header("location:../unidades/unidades.php");
    }else if ($tipus == 3) {
    	foreach($arreglox as $variable){
		$_SESSION['usuario'] = $variable["u_usuario"];
	}
    	header("location:../admin/administrador.php");
    }


?>