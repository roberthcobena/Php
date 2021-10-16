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
           <td style="width:5%;" class='midnight-blue'>N°</td>
		  <td style="width:35%;" class='midnight-blue'>ESTUDIANTES</td>
		  <?php
		  $sql3="SELECT * FROM cursos c, taller t WHERE c.id_curso=t.curs_taller AND c.id_curso=".$id_curso." AND t.esta_taller='1'";
		  $query3=mysqli_query($con,$sql3);
		  $ct=0;
		  $idt[]="";
		  while ($row3=mysqli_fetch_array($query3)) {
		  	++$ct;
		  	$idt[$ct]=$row3['id_taller'];
		  	$tall=$row3['nom_taller'];
		  	?>
		  	<td class='midnight-blue' style="width:10%; text-align: center;"><?php echo $tall;?></td>
		  <?php
		  }
		  ?>
		   <td class='midnight-blue' style="width:10%; text-align: center;">Promedio General</td>
        </tr>

		
			<?php
			$sg=0;
			$pg=0;
			$sql2="SELECT * FROM cursos c, alumnos a, datos_usuarios d WHERE c.id_curso=a.alum_seccion AND a.alum_usu=d.id_usuario AND c.id_curso=".$id_curso." AND d.esta_user='1' ORDER BY d.apell_user ASC";
			$query2=mysqli_query($con,$sql2);
			$contador=0;
			
			while ($row2=mysqli_fetch_array($query2)) {
				++$contador;

				$est=$row2['apell_user']." ".$row2['nomb_user'];
				$estid=$row2['id_usuario'];
				$si=0;
			    $pi=0;

			?>
			<tr>
			<td style="width:5%; text-align: center;"><?php echo $contador;?></td>
			<td style="width:35%;"><?php echo $est;?></td>
			<?php
			for ($i=1; $i <= $ct; $i++) { 
				$sql4="SELECT * FROM alumno_taller WHERE id_taller=".$idt[$i]." AND id_alumno=".$estid." AND est_taller='2'";
				$query4=mysqli_query($con,$sql4);
				$row4=mysqli_fetch_array($query4);
				$v = mysqli_num_rows($query4);
				if(!empty($v)){
					$si=$si+$row4['prom_taller'];
					?>
					<td style="width:10%; text-align: center;"><?php echo $row4['prom_taller'];?></td>
					<?php
				}else{
					?>
					<td style="width:10%; text-align: center;">0</td>
					<?php
				}
			}
			$pi=doubleval('');
                if ($si>0) {
                        $pi = round(($si/$ct), 1);
                    }else $pi = 0;
                ?>
                <td style="width:10%; text-align: center;"><?php echo $pi;?></td>
                </tr>
                <?php
                $sg=$sg+$pi;
			}
			
			$pg=doubleval('');
                if ($sg>0) {
                        $pg = round(($sg/$contador), 1);
                    }else $pg = 0;

            $colp=$ct+2;
			?>
		   
        
        
        <tr>
        	<td class='midnight-blue' colspan="<?php echo $colp; ?>"> Promedio general del curso</td>
                    <td class='midnight-blue' style="text-align: center;"><?php echo $pg; ?></td>
        	
        </tr>
		
        
   
    </table>

	
	
	
	  

</page>

