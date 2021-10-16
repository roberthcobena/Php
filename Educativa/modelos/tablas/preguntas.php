<?php    

    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php"); 

    session_start();
    $id_taller = mysqli_real_escape_string($con,(strip_tags($_REQUEST['idtaller'], ENT_QUOTES)));  
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $sTable = "pregunta";
		$sWhere = "";
		$sWhere.=" WHERE est_pregu!='' AND id_taller=$id_taller";
	if ( $_GET['q'] != "" ){
        $sWhere.= " AND  (des_pregunta LIKE '%$q%')";
    }
        $sWhere.=" ORDER BY id_pregunta ASC ";            
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];        
        $sql="SELECT * FROM  $sTable $sWhere";
        $query = mysqli_query($con, $sql);

        $consul0 = mysqli_query($con, "SELECT count(*) AS activos FROM pregunta WHERE est_pregu='1' AND id_taller=$id_taller");
        $row0 = mysqli_fetch_array($consul0);
        $act = $row0['activos'];

        $consult = mysqli_query($con, "SELECT cant_taller FROM taller WHERE id_taller=$id_taller");
        $row2 = mysqli_fetch_array($consult);
        $canti = $row2['cant_taller'];
        if($act < $canti){
            $color = "danger";
            $resultado = "El taller cuenta con ".$act."/".$canti." cree o active las preguntas restantes para completar el taller";
        }else if($act > $canti){
            $color = "danger";
            $act = "El taller cuenta con ".$act."/".$canti." desactive las preguntas sobrantes para completar el taller";
        }else if($act==$canti){
            $color = "success";
            $resultado = "El taller cuenta con ".$act."/".$canti." el taller esta habilitado";
        }

        if ($numrows>0){
            echo mysqli_error($con);

?>
<center><p class="label label-<?php echo $color; ?>"><b><?php echo $resultado; ?></b> </p></center>

<div class="card-body table-responsive p-0">
    <table id="zero_config" class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Pregunta</th>
                <th>Opcion 1</th>
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

                     $consul="SELECT * FROM pregunta p, taller t WHERE p.id_taller=t.id_taller AND t.id_taller = '$id_taller' AND p.est_pregu='1'";
                     $count=mysqli_query($con,$consul);
                     while ($row1= mysqli_fetch_array($count)){
                        $cant=$row1['cant_taller'];
                     }
                     $cont=mysqli_num_rows($count);
                     if ($cont == $cant) {
                         $consul2="UPDATE taller SET esta_taller='1' WHERE id_taller='$id_taller'";
                         $count2=mysqli_query($con,$consul2);
                     }else{
                         $consul2="UPDATE taller SET esta_taller='3' WHERE id_taller='$id_taller'";
                         $count2=mysqli_query($con,$consul2);
                     }

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
