<?php    

    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php"); 

    session_start();
    $id_taller = mysqli_real_escape_string($con,(strip_tags($_REQUEST['idtaller'], ENT_QUOTES)));  
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $sTable = "respuesta r, pregunta p, alumnos a, usuario u, datos_usuarios du";
		$sWhere = " WHERE p.est_pregu!='' AND p.id_taller=$id_taller AND p.id_pregunta=r.id_pregunta AND r.id_alumno=a.alum_id AND a.alum_usu=u.id_usuario AND u.id_usuario=du.id_usuario";
		$sWhere.=" GROUP BY p.id_pregunta";
	if ( $_GET['q'] != "" ){
        $sWhere.= " AND  (des_pregunta LIKE '%$q%')";
    }
        $sWhere.=" ORDER BY des_pregunta ASC ";            
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];        
        $sql="SELECT * FROM  $sTable $sWhere";
        $query = mysqli_query($con, $sql);    
        if ($numrows>0){
            echo mysqli_error($con);
            $resultado=" Preguntas tomadas";
?>
<center><p><b><?php echo $numrows; ?></b><?php echo $resultado; ?></p>       </center>

<div class="card-body table-responsive p-0">
<table id="zero_config" class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th colspan="7" class="bg bg-cyan">Calificaciones generales</th>            
        </tr>
        <tr>
            <th>#</th>
            <th>Estudiante</th>
            <th>fecha inicio</th>
            <th>fecha fin</th>
            <th>Observación</th>
            <th>Aciertos</th>            
            <th>Calificación</th>            
        </tr>
    </thead>
</table>
    <table id="zero_config" class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Estudiante</th>
                <th>Pregunta</th>
                <th>Opcion 2</th>
                <th>Opcion 3</th>
                <th>Opcion 4</th>
                <th>Respuesta</th>
                <th>Estado</th>
                <th>operaciones</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $contador=0;
                $estado_color="";
                $msg_estado = "";
                while ($row= mysqli_fetch_array($query)){
                    ++$contador;
                    //ids
                    $id=$row['id_pregunta'];
                    //nombres
                    $pregunta=$row['des_pregunta'];
                    $op1=$row['opc_1'];
                    $op2=$row['opc_2'];
                    $op3=$row['opc_3'];
                    $op4=$row['opc_4'];
                    $correcta=$row['opc_correcta'];
                    $estado=$row['est_pregu'];

                    //color estado
                    if ($estado == 1) {
                        $estado_color = "success";
                    } elseif ($estado == 2) {
                        $estado_color = "danger";
                    }
                    //para mensaje por estado                                        
                    if ($estado == 1) {
                        $msg_estado = "Activo";
                    } elseif ($estado == 2) {
                        $msg_estado = "Inactivo";
                    }if($estado)                   
                    ?>
                <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">    
                <input type="hidden" value="<?php echo $id_taller;?>" id="id_taller<?php echo $id;?>">  
                <input type="hidden" value="<?php echo $pregunta;?>" id="pregunta<?php echo $id;?>">  
                <input type="hidden" value="<?php echo $op1;?>" id="op1<?php echo $id;?>">  
                <input type="hidden" value="<?php echo $op2;?>" id="op2<?php echo $id;?>">
                <input type="hidden" value="<?php echo $op3;?>" id="op3<?php echo $id;?>">
                <input type="hidden" value="<?php echo $op4;?>" id="op4<?php echo $id;?>">
                <input type="hidden" value="<?php echo $correcta;?>" id="correcta<?php echo $id;?>">    
                <input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">    
            <tr>
                <td><?php echo $contador;?></td>
                <td><?php echo $pregunta;?></td>        
                <td><?php echo $op1;?></td>                       
                <td><?php echo $op2;?></td>
                <td><?php echo $op3;?></td>
                <td><?php echo $op4;?></td> 
                <td><?php echo "Opcion: ".$correcta;?></td>         
                <td><span class="label label-<?php echo $estado_color; ?>"><?php echo $msg_estado; ?></span> </td>
                <td style="text-align: center; white-space: nowrap;">
                    <button type="button" class="btn btn-success" title='Detalles' onclick="detalles('<?php echo $id;?>');" data-toggle="modal" data-target="#preguInfo"><i class="nav-icon fas fa-edit"></i> Editar</button>                    
                </td>       
                
            </tr>
            <?php
                }
                ?>                            
        </tbody>
                                        
                                        
    </table>
</div>
<?php
}
}
?>
