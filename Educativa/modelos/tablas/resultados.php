<?php    
    session_start();
    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php"); 
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
        
        $id_taller = mysqli_real_escape_string($con,(strip_tags($_REQUEST['idtaller'], ENT_QUOTES)));
        $curso = "SELECT * FROM taller t WHERE t.id_taller=$id_taller";
        $queryc = mysqli_query($con, $curso);
        while ($rowc = mysqli_fetch_array($queryc)) {
            $id_curso = $rowc['curs_taller'];
            $fin_taller = $rowc['fin_t'];
            $n_taller = $rowc['nom_taller'];
        }      

        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $Table = "alumnos a, usuario u, datos_usuarios d";
		$Where = " WHERE a.alum_seccion=$id_curso AND a.alum_usu=u.id_usuario AND d.id_usuario=u.id_usuario ORDER BY d.apell_user ASC";
        $sql="SELECT * FROM  $Table  $Where";
        $query = mysqli_query($con, $sql);//Agrupa resultados X alumno            
?>

<div class="card-body table-responsive p-0">
<p>Fecha máxima de entrega: <?php echo $fin_taller;?></p>
<table id="zero_config" class="table table-striped table-bordered text-left">
    <thead>
        <tr>
            <th colspan="7" class="bg bg-info" style="color: #ffff;">Participación estudiantil</th>            
        </tr>
        <tr>
            <th>#</th>
            <th>Estudiante</th>
            <th>Observación</th>
            <th>Entrega</th>
            <th>Aciertos</th>            
            <th>Calificación</th>
        </tr>
    </thead>
    <tbody>
    <?php
            $cont_e=0;
            $obs_color="";
            $msg_obs = "";
            $msg_time="";
            while ($row_e= mysqli_fetch_array($query)){
                ++$cont_e;                
                $estudiante=$row_e['apell_user'] . ' ' . $row_e['nomb_user'];
                

                ?>    
        <tr>
            <td><?php echo $cont_e;?></td>
            <td><?php echo $estudiante;?></td>
            <td>
            <?php
                $msg_obs = "";
                $sql2 = "SELECT * FROM alumno_taller t WHERE  t.id_taller=$id_taller AND t.id_alumno=" . $row_e['id_usuario']   ;
                if ($result = mysqli_query($con, $sql2)) {

                    $row_cnt = mysqli_num_rows($result);
                    if (empty($row_cnt)) {
                            $msg_obs = "Enviado";
                            printf("<b>" . $msg_obs . "</b>");
                    }else{
                        $query2 = mysqli_query($con, $sql2);
                        while($row2 = mysqli_fetch_array($query2)) {
                            if ($row2['est_taller']==1) {                                                            
                                $msg_obs = "Realizando";
                                printf("<b>" . $msg_obs . "</b>");
                            }else {
                                $msg_obs = "Finalizado";
                                printf("<b>" . $msg_obs . "</b>");
                            }
                        }}}  
                            ?>        
            </td>
            <td><?php
                $msg_ent = "";
                if ($result2 = mysqli_query($con, $sql2)) {
                    $row_cnt2 = mysqli_num_rows($result2);
                    $sql3="SELECT * FROM taller WHERE id_taller=$id_taller";
                    $consul2=mysqli_query($con, $sql3);
                    while ($rowt = mysqli_fetch_array($consul2)) {
                        $disp=$rowt['acce_taller'];
                    }
                    
                    if (empty($row_cnt2) ) {
                        if ($disp == 1) {
                            $msg_ent = "PENDIENTE";
                            printf("<b>" . $msg_ent . "</b>");
                        }elseif ($disp == 2) {
                            $msg_ent = "Taller perdido";
                            printf("<b>" . $msg_ent . "</b>");
                        }

                            
                    }else{
                        $query3 = mysqli_query($con, $sql2);
                        while($row3 = mysqli_fetch_array($query3)) {
                            if ($row3['fin_taller'] < $fin_taller) {
                                $msg_ent = "Entregó a tiempo ";
                                printf("<b>" . $msg_ent . "</b>");
                            }elseif ($row3['fin_taller'] > $fin_taller ){
                                $msg_ent = "Entregó con atraso ";
                                printf("<b>" . $msg_ent . "</b>");
                            }
                        }}} 
            ?></td>
            <td style="text-align: center;"><?php 
                $contador="";
                $nota=0;
                $sql_p = "SELECT * FROM pregunta p WHERE p.id_taller=$id_taller";
                $query_p = mysqli_query($con, $sql_p);
                while ($row_p = mysqli_fetch_array($query_p)) {
                    ++$contador;
                    $id_p = $row_p['id_pregunta'];
                    $opc_c = $row_p['opc_correcta'];

                    $sql_r = "SELECT * FROM respuesta r, alumnos a WHERE r.id_alumno=a.alum_id AND a.alum_usu = " . $row_e['id_usuario'] . " AND r.id_pregunta= " . $row_p['id_pregunta'] ." AND r.est_resp!='0'";
                    if ($result_r = mysqli_query($con, $sql_r)) {
                        $row_cnt_r = mysqli_num_rows($result_r);
                        if (empty($row_cnt_r)) {
                        }else{                        
                            $query4 = mysqli_query($con, $sql_r);
                            while ($row_preg = mysqli_fetch_array($query4)) {
                                if ($row_preg ['resp_alumno']==$row_p['opc_correcta']) {
                                    ++$nota;                                                                                          
                            }
                        }
                    }
                }
            }    
                echo $nota;
                ?></td>
            <td style="text-align: center;"><?php 
                if ($result3 = mysqli_query($con, $sql2)) {
                    $row_cnt3 = mysqli_num_rows($result3);
                    if (empty($row_cnt3)) {
                            $calif = "0/10";
                            printf("<b>" . $calif . "</b>");
                    }else{
                        $query4 = mysqli_query($con, $sql2);
                        while($row4 = mysqli_fetch_array($query4)) {
                            $calif=$row4['prom_taller'];
                            printf("<b>" . $calif . "/10</b>"); 
                        }}}               
            ?></td>
            
        </tr>
        <?php
            }
        ?>      
    </tbody>
</table>    

<figure class="highcharts-figure">
        <div id="container"></div>
        
    </figure>
</div>

<script>

Highcharts.chart('container', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'Notas optenidas de los estudiantes'
  },
  xAxis: {
    type: 'category',
    labels: {
      rotation: -45,
      style: {
        fontSize: '13px',
        fontFamily: 'Verdana, sans-serif'
      }
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Notas obtenidas del taller'
    }
  },
  legend: {
    enabled: false
  },
  tooltip: {
    pointFormat: 'Obtuvo un total de <b>{point.y:.1f} puntos</b>'
  },
  series: [{
    name: 'Notas',
    data: [
    <?php
            $consul1="SELECT * FROM alumno_taller n, usuario u, datos_usuarios d, taller t WHERE d.id_usuario=u.id_usuario AND n.id_alumno=u.id_usuario AND n.id_taller=t.id_taller AND t.id_taller=$id_taller AND u.u_estado='1' AND n.est_taller='2' ORDER BY d.apell_user ASC ";
            $conx1= mysqli_query($con,$consul1);
            while ( $cont1= mysqli_fetch_array($conx1)){
                $nombre=$cont1['nomb_user']." ".$cont1['apell_user'];
                $not=$cont1['prom_taller'];
            ?>
      [<?php echo "'".$nombre."', ".$not;?>],
      <?php } ?> 
    ],
    dataLabels: {
      enabled: true,
      rotation: -90,
      color: '#FFFFFF',
      align: 'right',
      format: '{point.y:.1f}', // one decimal
      y: 10, // 10 pixels down from the top
      style: {
        fontSize: '13px',
        fontFamily: 'Verdana, sans-serif'
      }
    }
  }]
});
</script>
<?php
}
?>
