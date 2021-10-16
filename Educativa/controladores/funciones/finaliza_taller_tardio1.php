<?php
if ((!empty($_GET['id_c'])) &&
    (!empty($_GET['id_t'])) &&
    (!empty($_GET['id_a'])) &&
	(!empty($_GET['cant']))
	){
	    include ("../conexion/db.php");//Contiene las variables de configuración para conectar a la base de datos
		include ("../conexion/conexion.php");
        $id=intval($_GET['id_a']);
        $curso=intval($_GET['id_c']);
        $taller=intval($_GET['id_t']);
        $cant=intval($_GET['cant']);

        $preg[]="";
        $resp[]="";
        $i=0;
        $vall=0;

        $consul="SELECT * FROM pregunta WHERE id_taller ='".$taller."' ";
        $query = mysqli_query($con, $consul);
        while ($row= mysqli_fetch_array($query)){
        	++$i;
        	$preg[$i]=$row['id_pregunta'];
        }

        for ($x=1; $x <= $cant; $x++) { 
        	$consul1="INSERT INTO respuesta (id_alumno, id_pregunta, resp_alumno) VALUES ('$id','$preg[$x]','5')";
			$query1= mysqli_query($con,$consul1);
			++$vall;
        }

        if ($vall == $cant) {
        	session_start();
			$id_user = $_SESSION['id_usuario'];
			$finaliza=date("Y-m-d H:i:s");
			$punt = floatval(10/$cant);						//Variable de calificación
			$nota=0;

			for ($y=1; $y <= $cant; $y++) { 
				$consul2="SELECT * FROM respuesta WHERE id_pregunta ='".$preg[$y]."' ";
                $query2 = mysqli_query($con, $consul2);
                $row2 = mysqli_fetch_array($query2);
                $resp[$y]=$row2['resp_alumno'];
			}

			for ($z=1; $z <= $cant; $z++) { 
        		$consul3 = "SELECT * FROM pregunta p WHERE p.id_pregunta=$preg[$z]";
				$query3 = mysqli_query($con, $consul3);
				$row3 = mysqli_fetch_array($query3); 
					if ($resp[$y] == $row3['opc_correcta']) {
						$nota = $nota + $punt;
					}
        	}

        	$sql="UPDATE alumno_taller SET fin_taller='".$finaliza."', prom_taller='".$nota."', est_taller='2' WHERE id_taller='".$taller."' AND id_alumno='".$id_user."'";
			$query_update = mysqli_query($con,$sql);

			$messages[] = "Resultados guardados.";


        }else{
        	$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
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
						<strong>¡Bien hecho! </strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>