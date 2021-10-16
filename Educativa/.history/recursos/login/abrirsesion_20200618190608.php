<?php 
session_start();
include("../core/conexion.php");
$con = new bd();

$usuario = $_POST["username"];
$clave = $_POST["pass"];
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