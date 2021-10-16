<?php    

    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php"); 

    session_start();
    $id_user = $_SESSION['id_usuario'];
    $id_taller = mysqli_real_escape_string($con,(strip_tags($_REQUEST['idtaller'], ENT_QUOTES)));  
    $id_curso = mysqli_real_escape_string($con,(strip_tags($_REQUEST['curso'], ENT_QUOTES)));  
    
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
    <form class="form-horizontal" method="post" id="finTaller" name="finTaller" enctype="multipart/form-data">
        <!-- Variable oculta -->
        <input type="hidden" class="form-control" id="id_alumno" value="<?php echo $id_alumno; ?>" name="id_alumno" readonly="">
        <input type="hidden" class="form-control" id="id_curso" value="<?php echo $id_curso; ?>" name="id_curso" readonly="">
        <?php
            $contador=0;
            $estado_color="";
            $msg_estado = "";
            while ($row= mysqli_fetch_array($query)){
                ++$contador;
                $id=$row['id_pregunta'];
                $pregunta=$row['des_pregunta'];
                $op1=$row['opc_1'];
                $op2=$row['opc_2'];
                $op3=$row['opc_3'];
                $op4=$row['opc_4'];            
            ?>
            <div class="form-group row">
                <label for="pregunta<?php echo $id; ?>" class="col-sm-3 text-right control-label col-form-label"><?php echo $contador . "- " . $pregunta; ?> </label>
                <div class="col-sm-9">

            <!-- cambiar por selects -->                
                <label for="opcion_1_pregunta_<?php echo $id; ?>">Opcion 1: <?php echo $op1; ?></label><br>
                <label for="opcion_2_pregunta_<?php echo $id; ?>">Opcion 2: <?php echo $op2; ?></label><br>                
                <label for="opcion_3_pregunta_<?php echo $id; ?>">Opcion 3: <?php echo $op3; ?></label><br>                
                <label for="opcion_4_pregunta_<?php echo $id; ?>">Opcion 4: <?php echo $op4; ?></label><br> 
                
                <label><b>Respuesta correcta:</label></b><br> 

                <select class="mi-selector form-control" id="pregunta<?php echo $id; ?>" name="pregunta<?php echo $id; ?>" style="width: 100%;" required>
                    <option value="0">-- Escoja una opción --</option>
                    <option value="1">Opción 1</option>
                    <option value="2">Opción 2</option>
                    <option value="3">Opción 3</option>
                    <option value="4">Opción 4</option>                    
                </select>                               
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
<script>
//GUARDA RESPUESTAS
$("#finTaller").submit(function() { //NOMBRE DEL FORM
    $('#fin_taller').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT
    $.ajax({
        type: "POST",
        url: "../../controladores/funciones/finaliza_taller.php", //ARCHIVO CON SQL DE REGISTRO
        data: $(this).serialize(),
        beforeSend: function() {
            $('#fin_taller').attr("disabled", true); //DESACTIVAMOS BOTÓN MIENTRAS SE EJECUTA ORDEN 
            $("#resultados_fin").html("Guardando respuestas, generando promedio..."); //MENSAJES DE ESPERA, ÉXITO O ERROR
        },
        success: function(datos) {
            $("#resultados_fin").html(datos);
            $('#fin_taller').attr("disabled", false);
            setTimeout(termina_taller, 2000); //REDIRECCIONAMOS FUERA DE AQUÍ, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})

function termina_taller() {
    $("#resultados_fin").html(""); //LIMPIAMOS MENSAJES
    // funciona como una redirección HTTP
    var id_curso = $("#idtaller").val();
    window.location.replace("../aula.php?curso="+ id_curso);
}
</script>