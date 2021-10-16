<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../../login.php");
		exit;
    }
	/* Connect To Database*/
	include("../../../controladores/conexion/db.php");
	include("../../../controladores/conexion/conexion.php");
	//Archivo de funciones PHP
	include("funciones.php");
	$id_curso= intval($_GET['id_curso']);
	$sql_count=mysqli_query($con,"select * FROM cursos where id_curso='".$id_curso."'");
	$count=mysqli_num_rows($sql_count);
	if ($count==0)
	{
	echo "<script>alert('Curso no encontrado')</script>";
	echo "<script>window.close();</script>";
	exit;
	}
	$sql="SELECT * FROM cursos c, jornadas j, anios_lectivos a, docentes d, doc_curso o, datos_usuarios u WHERE c.jornada=j.id_seccion AND a.id=c.an_lec AND c.id_curso=o.id_curso AND o.id_docente=d.id_docente AND d.id_usuario=u.id_usuario AND c.id_curso=".$id_curso."";
	$sql_repor=mysqli_query($con, $sql);
	$rw_repor=mysqli_fetch_array($sql_repor);
	$curso=$rw_repor['nom_curso'];
	$seccion=$rw_repor['sec_curso'];
	$jornada=$rw_repor['nom_seccion'];
	$lectivo=$rw_repor['anio'];
	$Docente=$rw_repor['apell_user']." ".$rw_repor['nomb_user'];
	$doc="Promedios por temas ".$rw_repor['nom_curso']."-".$rw_repor['sec_curso']." (".$rw_repor['nom_seccion']." ".$rw_repor['anio'].").pdf";

	
	
	require '../vendor/autoload.php';
	use Spipu\Html2Pdf\Html2Pdf;
	use Spipu\Html2Pdf\Exception\Html2PdfException;
	use Spipu\Html2Pdf\Exception\ExceptionFormatter;
	try{
		
		// init HTML2PDF
        $html2pdf = new HTML2PDF('L', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');
		  ob_start();
		include('reporte.php');
		 $content = ob_get_clean();
        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        // send the PDF
        $html2pdf->Output(''.$doc.'');
	}
	catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }	
