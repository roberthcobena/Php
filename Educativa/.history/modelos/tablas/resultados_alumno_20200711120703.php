<?php    

    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php"); 

    session_start();
    $id_usuario = $_SESSION['id_usuario'];
    $id_taller = mysqli_real_escape_string($con,(strip_tags($_REQUEST['idtaller'], ENT_QUOTES)));  
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $Table = "pregunta p, taller t";
		$Where = " WHERE p.id_taller=$id_taller AND t.id_taller = p.id_taller";        
        $Where2=" GROUP BY p.id_pregunta";	
        $Where3=" ORDER BY p.id_pregunta DESC ";
        $sql="SELECT * FROM  $Table  $Where  $Where2  $Where3";
        $query = mysqli_query($con, $sql);
            $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $Table  $Where2  $Where3");
            $row= mysqli_fetch_array($count_query);
            $numpreguntas = $row['numrows'];            
?>

<div class="card-body table-responsive p-0">
<table id="zero_config" class="table table-striped table-bordered text-left">
    <thead>
        <tr>
            <th colspan="8" class="bg bg-cyan">Respuestas registradas</th>            
        </tr>
        <tr>
            <th>#</th>
            <th>Pregunta</th>            
            <th>Opcion 1</th>
            <th>Opcion 2</th>
            <th>Opcion 3</th>
            <th>Opcion 4</th>
            <th>Opcion contestada</th>
            <th>Correcto</th>
            <th>Acierto</th>
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
                $estado_taller=$row_e['est_taller'];                
                if (isset($row_e['ini_taller'])) {
                    $fec_ini = $row_e['ini_taller'];
                    /* Almacenamos la marca de tiempo (timestamp) como variable */
                    $timestamp = strtotime(str_replace('/', '-', $fec_ini));
                    /* Comprobamos su contenido para saber si se convirtió la fecha correctamente */
                    if ($timestamp !== false) {
                      /* En caso positivo generamos la fecha */
                      $fec_ini=date('d-M-Y H:i:s',strtotime($row_e['ini_taller']));
                    } else {
                      /* En caso negativo hacemos algo con la cadena o lanzamos un error */
                      $fec_ini = 'ERROR EN FECHA';
                    }
                  } else {
                    $fec_ini = "PENDIENTE";
                  }

                if (isset($row_e['fin_taller'])) {
                    $fec_fin = $row_e['fin_taller'];
                    /* Almacenamos la marca de tiempo (timestamp) como variable */
                    $timestamp = strtotime(str_replace('/', '-', $fec_fin));
                    /* Comprobamos su contenido para saber si se convirtió la fecha correctamente */
                    if ($timestamp !== false) {
                      /* En caso positivo generamos la fecha */
                      $fec_fin=date('d-M-Y H:i:s',strtotime($row_e['fin_taller']));
                    } else {
                      /* En caso negativo hacemos algo con la cadena o lanzamos un error */
                      $fec_fin = 'ERROR EN FECHA';
                    }
                  } else {
                    $fec_fin = "PENDIENTE";
                  }

                //color estado
                if ($estado_taller == 1) {
                    $obs_color = "warning";
                } elseif ($estado_taller == 2) {
                    $obs_color = "success";
                }
                //para mensaje por estado                                        
                if ($estado_taller == 2) {
                    $msg_obs = "Finalizado";
                } elseif ($estado_taller == 1) {
                    $msg_obs = "Pendiente";
                }if($estado_taller)
                
                //tiempo de entrega                                        
                if ($row_e['fin_taller'] < $row_e['fin_t']) {
                    $msg_time = "Entregó a tiempo";
                } elseif ($row_e['fin_taller'] > $row_e['fin_t']) {
                    $msg_time = "Entregó con atraso";
                }else($msg_time = "Falta entrega");                  

                $nota="";
                if (empty($row_e['prom_taller'])){
                    $nota=0;
                }else
                    $nota=$row_e['prom_taller'];

                $result=doubleval('');
                if ($nota > 0) {$result = round((($nota / $numpreguntas) * 100), 1);
                }else $result = 0;                    
                ?>
        <tr>
            <td><?php echo $cont_e;?></td>
            <td><?php echo $estudiante;?></td>        
            <td><?php echo $fec_ini;?></td>                       
            <td><?php echo $fec_fin;?></td>
            <td style="text-align: center; white-space: nowrap;"><span class="label label-<?php echo $obs_color; ?>"><?php echo $msg_obs; ?></span> </td>
            <td><?php echo $msg_time;?></td>
            <td style="text-align: center;"><?php echo $nota;?></td>
            <td style="text-align: center;"><?php echo $result . ' %';?></td>
        </tr>
        <?php
            }            
            ?>      
    </tbody>
</table>
    <!-- <table id="zero_config" class="table table-striped table-bordered text-center">
        <thead>
        <tr>
            <th colspan="9" class="bg bg-cyan">Respuestas por estudiante</th>            
        </tr>
            <tr>
                <th>#</th>
                <th>Estudiante</th>
                <th>Pregunta</th>
                <th>Opcion 2</th>
                <th>Opcion 3</th>
                <th>Opcion 4</th>
                <th>Respuesta</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody> -->
            <?php
                // $contador=0;
                // $estado_color="";
                // $msg_estado = "";
                // while ($row= mysqli_fetch_array($query2)){
                //     ++$contador;
                //     //ids
                //     $id=$row['id_pregunta'];
                //     //nombres
                //     $pregunta=$row['des_pregunta'];
                //     $op1=$row['opc_1'];
                //     $op2=$row['opc_2'];
                //     $op3=$row['opc_3'];
                //     $op4=$row['opc_4'];
                //     $correcta=$row['opc_correcta'];
                //     $estado=$row['est_pregu'];

                //     //color estado
                //     if ($estado == 1) {
                //         $estado_color = "success";
                //     } elseif ($estado == 2) {
                //         $estado_color = "danger";
                //     }
                //     //para mensaje por estado                                        
                //     if ($estado == 1) {
                //         $msg_estado = "Activo";
                //     } elseif ($estado == 2) {
                //         $msg_estado = "Inactivo";
                //     }if($estado)                   
                    ?>
                <!-- <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">    
                <input type="hidden" value="<?php echo $id_taller;?>" id="id_taller<?php echo $id;?>">  
                <input type="hidden" value="<?php echo $pregunta;?>" id="pregunta<?php echo $id;?>">  
                <input type="hidden" value="<?php echo $op1;?>" id="op1<?php echo $id;?>">  
                <input type="hidden" value="<?php echo $op2;?>" id="op2<?php echo $id;?>">
                <input type="hidden" value="<?php echo $op3;?>" id="op3<?php echo $id;?>">
                <input type="hidden" value="<?php echo $op4;?>" id="op4<?php echo $id;?>">
                <input type="hidden" value="<?php echo $correcta;?>" id="correcta<?php echo $id;?>">    
                <input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">     -->
            <!-- <tr>
                <td><?php echo $contador;?></td>
                <td><?php echo $pregunta;?></td>        
                <td><?php echo $op1;?></td>                       
                <td><?php echo $op2;?></td>
                <td><?php echo $op3;?></td>
                <td><?php echo $op4;?></td> 
                <td><?php echo "Opcion: ".$correcta;?></td>         
                <td><span class="label label-<?php echo $estado_color; ?>"><?php echo $msg_estado; ?></span> </td>                
                
            </tr> -->
            <?php
                // }
                ?>                            
        <!-- </tbody>
                                        
                                        
    </table> -->
</div>
<?php
}
?>
