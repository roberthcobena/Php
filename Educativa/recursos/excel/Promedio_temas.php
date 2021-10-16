<?php

session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
    }
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

	/* Connect To Database*/
	include("../../controladores/conexion/db.php");
	include("../../controladores/conexion/conexion.php");
$id_curso= intval($_GET['id_curso']);
$sql="SELECT * FROM cursos c, jornadas j, anios_lectivos a, docentes d, doc_curso o, datos_usuarios u WHERE c.jornada=j.id_seccion AND a.id=c.an_lec AND c.id_curso=o.id_curso AND o.id_docente=d.id_docente AND d.id_usuario=u.id_usuario AND c.id_curso=".$id_curso."";
	$sql_repor=mysqli_query($con, $sql);
	$rw_repor=mysqli_fetch_array($sql_repor);
	$curso="Curso: ".$rw_repor['nom_curso'];
	$seccion="Seccion: ".$rw_repor['sec_curso'];
	$jornada="Jornada: ".$rw_repor['nom_seccion'];
	$lectivo="Año lectivo: ".$rw_repor['anio'];
	$Docente="Docente: ".$rw_repor['apell_user']." ".$rw_repor['nomb_user'];
	$hoja=$rw_repor['nom_curso']."-".$rw_repor['sec_curso']." (".$rw_repor['nom_seccion']." ".$rw_repor['anio'].")";
	$doc="Promedios por temas".$rw_repor['nom_curso']."-".$rw_repor['sec_curso']." (".$rw_repor['nom_seccion']." ".$rw_repor['anio'].").xls";
$let = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Sistema web evaluacion")
							 ->setLastModifiedBy("Sistema web evaluacion")
							 ->setTitle("Promedio de los estudiantes")
							 ->setSubject("Promedio estudiantil del curso")
							 ->setDescription("pomedio obtenido mediante las notas de los talleres realizados.")
							 ->setKeywords("Promedio de los estudiantes")
							 ->setCategory("Test result file");



// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B2', 'ESCUELA DE EDUACIÓN BÁSICA FISCAL CIUDAD DE CUENCA')
            ->setCellValue('C5', $Docente)
            ->setCellValue('C6', $curso)
            ->setCellValue('C7', $seccion)
            ->setCellValue('C8', $jornada)
            ->setCellValue('C9', $lectivo);

$styleArray = array(
"font"  => array(
"bold" => true,
"size"  => 15,
"name" => "Arial"
));

$objPHPExcel->getActiveSheet()->getStyle("B2")->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle("B2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Miscellaneous glyphs, UTF-8

//comienzo del encabezado de la tabla
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B12', 'N°')
            ->setCellValue('C12', 'Estudiantes');

$sql3="SELECT * FROM unidad WHERE uni_est='1'";
$query3=mysqli_query($con,$sql3);
$ct=0;
$l=2;
 while ($row3=mysqli_fetch_array($query3)) {
	 ++$ct;
	 $id=$row3['id_unidad'];
	 $sql4="SELECT * FROM unidad u, tema t WHERE u.id_unidad=t.Id_unidad AND u.id_unidad='$id' AND uni_est='1'";
		    $query4=mysqli_query($con,$sql4);
		    while ($row4=mysqli_fetch_array($query4)) {
		    	++$l;

	            $in=$let[$l]."12";
		    	$tema=$row4['te_nombre'];
$objPHPExcel->setActiveSheetIndex(0)
		  	->setCellValue($in, $tema);
$objPHPExcel->getActiveSheet()->getColumnDimension($let[$l])->setWidth(15);
$style = array(
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'wrap' => true
    )
);
$objPHPExcel->getActiveSheet()->getStyle($in)->applyFromArray($style);
		    }



		  }
		 
//fin del encabezado de la tabla


//Comienzo el contenido de la tabla
$sql2="SELECT * FROM cursos c, alumnos a, datos_usuarios d WHERE c.id_curso=a.alum_seccion AND a.alum_usu=d.id_usuario AND c.id_curso=".$id_curso." AND d.esta_user='1'";
$query2=mysqli_query($con,$sql2);
$contador=0;
$l1=12;
$l2=2;

while ($row2=mysqli_fetch_array($query2)) {
	++$contador;
	++$l1;
	$fb="B".$l1;
	$fc="c".$l1;

	$est=$row2['apell_user']." ".$row2['nomb_user'];
	$estid=$row2['id_usuario'];

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($fb, $contador)
            ->setCellValue($fc, $est);

        $sql4="SELECT * FROM unidad WHERE uni_est='1'";
	    $query4=mysqli_query($con,$sql4);
	    while ($row4=mysqli_fetch_array($query4)) {
		  	$idu=$row4['id_unidad'];
		  	$sql5="SELECT * FROM unidad u, tema t WHERE u.id_unidad=t.Id_unidad AND u.id_unidad='$idu' AND uni_est='1'";
		    $query5=mysqli_query($con,$sql5);
		    while ($row5=mysqli_fetch_array($query5)) {
		    	++$l2;
		    	$in2=$let[$l2].$l1;
		    	$idt=$row5['id_tema'];
		    	$cant=0;
		    	$sum=0;
		    	$prom=0;
		    	$sql6="SELECT * FROM alumno_taller a, taller t WHERE t.id_taller=a.id_taller AND a.id_alumno='$estid' AND t.tema_taller='$idt' AND a.est_taller='2'";
		    	$query6=mysqli_query($con,$sql6);
		    	while ($row6=mysqli_fetch_array($query6)) {
		    			++$cant;
		    			$nota=$row6['prom_taller'];
		    			$sum=$sum+$nota;
		    		}
		    		$prom=doubleval('');
                    if ($sum>0) {
                        $prom = round(($sum/$cant), 1);
                    }else $prom = 0;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($in2, $prom);
$objPHPExcel->getActiveSheet()->getStyle($in2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		  }  

//promedio
			
}
$l2=2;
}
//fin del contenido

//fila de unidades
$sql7="SELECT * FROM unidad WHERE uni_est='1'";
$query7=mysqli_query($con,$sql7);
$x=3;
 while ($row7=mysqli_fetch_array($query7)) {
 	$uni=$row7['uni_nombre'];
 	$start=$let[$x]."11";
 	$id3=$row7['id_unidad'];

		$sql8="SELECT * FROM unidad u, tema t WHERE u.id_unidad=t.Id_unidad AND u.id_unidad='$id3' AND uni_est='1'";
		$query8=mysqli_query($con,$sql8);
		while ($row8=mysqli_fetch_array($query8)) {
			$end=$let[$x]."11";
			++$x;
		}
		$cell=$start.":".$end;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($start, $uni);
$objPHPExcel->getActiveSheet()->getStyle($start)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->mergeCells($cell);
$objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
$objPHPExcel->getActiveSheet()->getStyle($cell)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle($cell)->getFill()->getStartColor()->setARGB('FF052BAB');
$objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);


 }

//fila de promedio general
$y=$l1+1;
$z=13;
$lg=$let[$l].$y;
$lp="B".$y;
 for ($i=3; $i <= $l ; $i++) { 
 	$inpg=$let[$i].$z;
 	$inpe=$let[$i].$l1;
 	$lt=$let[$i].$y;
 	$formg="=AVERAGE(".$inpg.":".$inpe.")";
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($lp, "Promedio general de los temas");
$objPHPExcel->getActiveSheet()->setCellValue($lt, $formg);
 }


//fila de promedio general


//diseno de la tabla
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
$marge=$lp.":".$lg;
$marge1="B12:".$in;
$c=$let[$l].$y;

$objPHPExcel->getActiveSheet()->mergeCells('B2:H2');
//cabezera
$objPHPExcel->getActiveSheet()->getStyle($marge1)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
$objPHPExcel->getActiveSheet()->getStyle($marge1)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle($marge1)->getFill()->getStartColor()->setARGB('FF052BAB');
$objPHPExcel->getActiveSheet()->getStyle($marge1)->getFont()->setBold(true);


//final
$objPHPExcel->getActiveSheet()->getStyle($marge)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
$objPHPExcel->getActiveSheet()->getStyle($marge)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle($marge)->getFill()->getStartColor()->setARGB('FF052BAB');
$objPHPExcel->getActiveSheet()->getStyle($marge)->getFont()->setBold(true);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle($hoja);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.$doc.'');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;