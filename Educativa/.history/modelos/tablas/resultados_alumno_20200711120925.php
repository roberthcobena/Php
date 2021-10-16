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
            <th colspan="9" class="bg bg-cyan">Respuestas registradas</th>            
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
            while ($row_e= mysqli_fetch_array($query)){
                ++$cont_e;                    
                $id_pregunta=$row_e['id_pregunta'];                
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
</div>
<?php
}
?>
