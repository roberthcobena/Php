<?php    

    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php"); 

    session_start();
    $id_al = $_SESSION['id_usuario'];
    $id_taller = mysqli_real_escape_string($con,(strip_tags($_REQUEST['idtaller'], ENT_QUOTES)));  
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $Table = "pregunta p, taller t";
		$Where = " WHERE p.id_taller=$id_taller AND t.id_taller = p.id_taller";                
        $Where3=" ORDER BY p.id_pregunta ASC ";
        $sql="SELECT * FROM  $Table  $Where  $Where3";
        $query = mysqli_query($con, $sql);
            $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $Table $Where $Where3");
            $row= mysqli_fetch_array($count_query);
            $numpreguntas = $row['numrows'];     
            $resultado=" Preguntas tomadas";       
?>
<center><p><b><?php echo $numpreguntas; ?></b><?php echo $resultado; ?></p>       </center>
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
            <th>Acierto</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $cont_e=0;
        $contes="No Contestada";
        $corec="";
        $nota=0;
        while ($row_e= mysqli_fetch_array($query)){
            ++$cont_e;                    
            $id_pregunta=$row_e['id_pregunta'];
            $de_pregunta=$row_e['des_pregunta'];
            $op_1=$row_e['opc_1'];
            $op_2=$row_e['opc_2'];
            $op_3=$row_e['opc_3'];
            $op_4=$row_e['opc_4'];                
    ?>
        <tr>
            <td><?php echo $cont_e;?></td>
            <td><?php echo $de_pregunta;?></td>        
            <td><?php echo $op_1;?></td>                       
            <td><?php echo $op_2;?></td>                       
            <td><?php echo $op_3;?></td>                       
            <td><?php echo $op_4;?></td>                       
            <td><?php 
                $respuesta_dada="";
                $sql2 = "SELECT * FROM respuesta r, alumnos a WHERE r.id_alumno=a.alum_id AND a.alum_usu = " . $id_al . " AND r.id_pregunta= " . $row_e['id_pregunta'] ." AND r.est_resp!='0'";
                if ($result = mysqli_query($con, $sql2)) {
                    $row_cnt = mysqli_num_rows($result);
                    if (empty($row_cnt)) {
                            printf("<b>" . $contes . "</b>");
                    }else{                        
                        $query2 = mysqli_query($con, $sql2);
                        while ($row_preg = mysqli_fetch_array($query2)) {
                            $respuesta_dada=$row_preg['resp_alumno'];                                                                                                
                            printf("<b> Opción ". $respuesta_dada . "</b>");
                         
                ?>
            </td>
            <td><?php 
                    if ($row_preg ['resp_alumno']==$row_e['opc_correcta']) {
                        $corec="Si";
                        ++$nota;                                                        
                    }else{
                        $corec="No";
                    }                        
                    printf("<b>" . $corec . "</b>");
                ?>
            </td>
        </tr>
        <?php
            }}}} 
            ?>

        <tfoot>
            <tr>
                <th colspan="9" style="text-align: right;">NOTA OBTENIDA EN EL TALLER: <?php echo $nota ."/". $numpreguntas?></th>
            </tr>      
        </tfoot>
    </tbody>
</table>
</div>
<?php
}
?>
