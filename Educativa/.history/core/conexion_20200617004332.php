<?php
	//$conexion=mysqli_connect("localhost","root","","sisv2");
	//if(!$conexion){echo "ERROR AL CONCECTAR CON LA BASE DE DATOS";}
	//else{echo "CONECTADO A LA BASE DE DATOS";}
class bd
{
	private $conexion;
	
	public function bd(){
		$this->conexion=@mysqli_connect("localhost","root","","sisv2");
	}
	
	public function consulta($sql){
		return mysqli_query($this->conexion, $sql);
	}
	
	public function num_filas($resultado){
		return mysqli_num_rows($resultado);
	}
	
	public function arreglo($resultado){
		return mysqli_fetch_array($resultado);
	}
	
	public function login($usuario, $clave){
	//$sql = "select * from usuario where us_usuario='".$usuario."' and us_clave='".$clave."' and us_estado=1";
	$sql = "SELECT * FROM usuario WHERE u_usuario='".$usuario."' and u_contra= '".$clave."' and u_estado=1";
	$resultado = $this->consulta($sql);
		$arrUs = array();
		
		$nfilas = $this->num_filas($resultado);
		
		if($nfilas > 0){
			
			while ($lista = $this->arreglo($resultado)){
			
			array_push($arrUs, $lista);
		 }
		 return $arrUs;
		}
		else{
			return false;
		}

	}

	public function sesion($usuario){
		$sql = "SELECT * FROM usuario WHERE u_usuario='".$usuario."' and u_estado=1";
	    $resultado = $this->consulta($sql);
		
		$nfilas = $this->num_filas($resultado);

		$lista = $this->arreglo($resultado);

		if ($lista["u_tipo"] == 'alumno') {
			$ses=1;
			return $ses;
		}else if ($lista["u_tipo"] == 'docente') {
			$ses=2;
			return $ses;
		}else if ($lista["u_tipo"] == 'admin') {
			$ses=3;
			return $ses;
		}
		
	}

	public function tipo($id){
		$sql = "SELECT * FROM usuario WHERE id_usuario ='".$id."' ";
	    $resultado = $this->consulta($sql);
		
		$nfilas = $this->num_filas($resultado);

		$lista = $this->arreglo($resultado);

		if ($lista["u_tipo"] == 'alumno') {
			$del=1;
			return $del;
		}else if ($lista["u_tipo"] == 'docente') {
			$del=2;
			return $del;
		}else if ($lista["u_tipo"] == 'admin') {
			$del=3;
			return $del;
		}
		
	}


	

}
?>

