<style type="text/css">
/*  */
table { vertical-align: top; }
tr    { vertical-align: top; }
td    { vertical-align: top; }
.midnight-blue{
	background:#2c3e50;
	padding: 4px 4px 4px;
	color:white;
	font-weight:bold;
	font-size:12px;
}
.verticalText {
writing-mode: vertical-lr;
transform: rotate(180deg);
}
.silver{
	background:white;
	padding: 3px 4px 3px;
}
.clouds{
	background:#ecf0f1;
	padding: 3px 4px 3px;
}
.border-top{
	border-top: solid 1px #bdc3c7;
	
}
.border-left{
	border-left: solid 1px #bdc3c7;
}
.border-right{
	border-right: solid 1px #bdc3c7;
}
.border-bottom{
	border-bottom: solid 1px #bdc3c7;
}
table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
}


</style>
<page backtop="15mm" backbottom="15mm" backleft="15mm" backright="15mm" style="font-size: 12pt; font-family: arial" >
        <page_footer>
        <table class="page_footer">
            <tr>

                <td style="width: 50%; text-align: left">
                    P&aacute;gina [[page_cu]]/[[page_nb]]
                </td>
                <td style="width: 50%; text-align: right">
                    &copy; <?php echo "Unidad eduactiva Ciuda de Cuenca "; echo  $anio=date('Y'); ?>
                </td>
            </tr>
        </table>
    </page_footer>
	<?php include("encabezado_reporte.php");?>
    <br>
    

	
    <table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        
		<tr>
           <td style="width:50%;" >
			<?php 
			   $sql1="SELECT * FROM cursos c, jornadas j, anios_lectivos a, docentes d, doc_curso o, datos_usuarios u WHERE c.jornada=j.id_seccion AND a.id=c.an_lec AND c.id_curso=o.id_curso AND o.id_docente=d.id_docente AND d.id_usuario=u.id_usuario AND c.id_curso=".$id_curso."";
	            $query=mysqli_query($con, $sql1);
	            $row1=mysqli_fetch_array($query);
				echo "Docente: ";
				echo $row1['apell_user']." ".$row1['nomb_user'];
				echo "<br> Curso: ";
				echo $row1['nom_curso'];
				echo "<br> Seccion: ";
				echo $row1['sec_curso'];
				echo "<br> Jornada: ";
				echo $row1['nom_seccion'];
				echo "<br> Año lectivo: ";
				echo $row1['anio'];
			?>
			
		   </td>
        </tr>
        
   
    </table>
    
       <br>
		<table cellspacing="0" style="width: 100%; text-align: left; font-size: 11pt;">
        <tr>
           <td style="width:5%;" class='midnight-blue' >N°</td>
		  <td style="width:20%;" class='midnight-blue' >ESTUDIANTES</td>
		  <?php
		  $consul="SELECT * FROM unidad WHERE uni_est='1'";
		  $query2=mysqli_query($con,$consul);
	
		  while ($row2=mysqli_fetch_array($query2)) {
		  	$id=$row2['id_unidad'];

		  	$consul1="SELECT * FROM unidad u, tema t WHERE u.id_unidad=t.Id_unidad AND u.id_unidad='$id' AND uni_est='1'";
		    $query3=mysqli_query($con,$consul1);
		    while ($row3=mysqli_fetch_array($query3)) {
		    	$tema=$row3['te_nombre'];
		    	$uni=$row3['uni_nombre'];
		    	?>
		    	<td class='midnight-blue' style="width:10%; text-align: center;"><?php echo $tema;?></td>
		    	<?php
		    }
		  
		  	?>
		  <?php
		  }
		  ?>
        </tr>

                	<?php
        	$consul2="SELECT * FROM cursos c, alumnos a, datos_usuarios d WHERE c.id_curso=a.alum_seccion AND a.alum_usu=d.id_usuario AND c.id_curso=".$id_curso." AND d.esta_user='1'";
			$query4=mysqli_query($con,$consul2);
			$contador=0;
			while ($row2=mysqli_fetch_array($query4)) {
				++$contador;

				$est=$row2['apell_user']." ".$row2['nomb_user'];
				$estid=$row2['id_usuario'];
        	?>
        	<tr>
			<td style="width:5%; text-align: center;"><?php echo $contador;?></td>
			<td style="width:20%;"><?php echo $est;?></td>
			<?php
			$consul3="SELECT * FROM unidad WHERE uni_est='1'";
		  $query5=mysqli_query($con,$consul3);
	
		  while ($row5=mysqli_fetch_array($query5)) {
		  	$id2=$row5['id_unidad'];

		  	$consul4="SELECT * FROM unidad u, tema t WHERE u.id_unidad=t.Id_unidad AND u.id_unidad='$id2' AND uni_est='1'";
		    $query6=mysqli_query($con,$consul4);
		    while ($row6=mysqli_fetch_array($query6)) {
		    	$idt=$row6['id_tema'];
		    	$cant=0;
		    	$sum=0;
		    	$prom=0;
		    	$consul5="SELECT * FROM alumno_taller a, taller t WHERE t.id_taller=a.id_taller AND a.id_alumno='$estid' AND t.tema_taller='$idt' AND a.est_taller='2'";
		    	$query7=mysqli_query($con,$consul5);		    	
		    		while ($row7=mysqli_fetch_array($query7)) {
		    			++$cant;
		    			$nota=$row7['prom_taller'];
		    			$sum=$sum+$nota;
		    		}
		    		$prom=doubleval('');
                    if ($sum>0) {
                        $prom = round(($sum/$cant), 1);
                    }else $prom = 0;
                    ?>
                    <td style="width:10%; text-align: center;"><?php echo $prom;?></td>
                    
                    <?php
 
		    }
		  }
		  ?>
		  </tr>
		  <?php

		}
		?>

        

		
		
        
   
    </table>

	
	
	
	  

</page>

