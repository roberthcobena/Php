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
        if ($numrows>0){
            echo mysqli_error($con);
            $resultado=" Conteste las ". $numrows . " preguntas, dentro del tiempo permitido (20 minutos)";
?>
<center><p><b><?php echo $resultado; ?></p></b>       </center>
<div>
<form class="form-horizontal" method="post" id="nueva_tall" name="nueva_tall" enctype="multipart/form-data">

                    <div class="form-group row">
                        <label for="tema" class="col-sm-3 text-right control-label col-form-label">Tema: </label>
                        <div class="col-sm-9">
                            <select class="mi-selector form-control" id="tema" name="tema" style="width: 100%;" required>
                                <option value="">-- Selecciona --</option>
                                <?php
                                    $sql1 = "SELECT t.id_tema, u.uni_nombre, t.te_nombre FROM unidad u, tema t WHERE t.tem_estado=1 AND t.id_unidad=u.id_unidad";
                                    $result1 = $con->query($sql1);
                                    while ($row1 = $result1->fetch_array()) {
                                        echo "<option value='" . $row1[0] . "'>" . $row1[1] .' ('.$row1[2].")"." </option>";
                                    } // while 
                                    ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="curso" class="col-sm-3 text-right control-label col-form-label">Curso: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="curso" name="curso" required>
                                <option value="">-- Selecciona --</option>
                                <?php
                                    $result = $con->query($sql3);
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value='" . $row[0] . "'>" . $row[1] .' "'.$row[2].'" '."(".$row[3].")"."</option>";
                                    } // while 
                                    ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nombre" class="col-sm-3 text-right control-label col-form-label">Nombre: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre del taller" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inicio" class="col-sm-3 text-right control-label col-form-label">Inicio: </label>
                        <div class="col-sm-9 input-group date" id="datetimepicker7" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker7" id="inicio" name="inicio" required="" >
                            <div class="input-group-append" data-target="#datetimepicker7" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fin" class="col-sm-3 text-right control-label col-form-label">Final: </label>
                        <div class="col-sm-9 input-group date" id="datetimepicker8" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker8" id="fin" name="fin" required="">
                            <div class="input-group-append" data-target="#datetimepicker8" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="nuevo_Tall">Guardar</button>
            </div>
            <div id="resultados_ajax_n"></div>
               </form>
</div>
<div class="card-body table-responsive p-0">
    <table id="zero_config" class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Pregunta</th>
            </tr>
            <tr>
                <th>Respuesta</th>
            </tr>
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
