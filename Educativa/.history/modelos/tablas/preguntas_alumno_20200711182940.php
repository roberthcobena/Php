<?php    

    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php"); 

    session_start();
    $id_user = $_SESSION['id_usuario'];
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

            $sql2 = "SELECT * from usuario u, alumnos a where a.alum_usu=u.id_usuario AND u.id_usuario=$id_user";
            $query2 = mysqli_query($con, $sql2);
            while ($row2 = mysqli_fetch_array($query2)) {
                $id_alumno=$row2['alum_id'];            
            }
?>
<center><p><b><?php echo $resultado; ?></p></b>       </center>
<div class="card-body table-responsive p-0">
    <form class="form-horizontal" method="post" id="fin_taller" name="fin_taller" enctype="multipart/form-data">
        <!-- Variable oculta -->
        <input type="hidden" class="form-control" id="id_alumno" value="<?php echo $id_alumno; ?>" name="id_alumno" readonly="">
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
        <div class="form-group row">
            <label for="pregunta<?php echo $id; ?>" class="col-sm-3 text-right control-label col-form-label">Tema: </label>
            <div class="col-sm-9">
                <input type="radio" id="male" name="gender" value="male">
                <label for="male">Male</label><br>
                <input type="radio" id="female" name="gender" value="female">
                <label for="female">Female</label><br>
                <input type="radio" id="other" name="gender" value="other">                
                <label for="other">Other</label>               
            </div>
        </div>
        <?php 
        }
        ?>

        <center>
        <div>
            <button type="submit" class="btn btn-primary" id="fin_taller">Finalizar taller</button>
        </div>
        <div id="resultados_fin"></div>
        </center>
</form>
</div>
<?php
}
}
?>
