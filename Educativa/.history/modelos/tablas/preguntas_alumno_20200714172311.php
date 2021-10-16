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

            $sql3 = "SELECT * from taller t where t.id_taller=$id_taller";
            $query3 = mysqli_query($con, $sql3);
            while ($row3 = mysqli_fetch_array($query3)) {
                $id_curso=$row3['curs_taller'];            
            }

            $sql4 = "SELECT * from alumno_taller a where a.id_alumno=$id_user and a.id_taller=$id_taller";
            $query4 = mysqli_query($con, $sql4);
            while ($row4 = mysqli_fetch_array($query4)) {
                $inicia=$row4['ini_taller'];            
            }
?>
<center><p><b><?php echo $resultado; ?></p></b>       </center>
<div class="card-body table-responsive p-0">
    <form class="form-horizontal" method="post" id="finTaller" name="finTaller" enctype="multipart/form-data">
        <div id="resultados_fin_2"></div>
        <!-- Variable oculta -->
        <input type="hidden" class="form-control" id="id_alumno" value="<?php echo $id_alumno; ?>" name="id_alumno" readonly="">
        <input type="hidden" class="form-control" id="id_curso" value="<?php echo $id_curso; ?>" name="id_curso" readonly="">
        <input type="hidden" class="form-control" id="id_taller" value="<?php echo $id_taller; ?>" name="id_taller" readonly="">
        <input type="text" class="form-control" id="inicia" value="<?php echo $inicia; ?>" name="inicia" readonly="">
        
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

                <label>Opcion 1: <?php echo $op1; ?></label><br>
                <label>Opcion 2: <?php echo $op2; ?></label><br>                
                <label>Opcion 3: <?php echo $op3; ?></label><br>                
                <label>Opcion 4: <?php echo $op4; ?></label><br> 
                
                <label><b>Respuesta correcta:</label></b><br>

                <?php
                if ($contador==1) {?>
                    <input type="hidden" class="form-control" id="pregu1" name="pregu1" value="<?php echo $id; ?>"  readonly="">
                <select class="mi-selector form-control" id="resp1" name="resp1" style="width: 100%;" required>
                    <option value="0">-- Escoja una opción --</option>
                    <option value="1">Opción 1</option>
                    <option value="2">Opción 2</option>
                    <option value="3">Opción 3</option>
                    <option value="4">Opción 4</option>                    
                </select>   
                <?php }elseif ($contador==2) {?>
                    <input type="hidden" class="form-control" id="pregu2" name="pregu2" value="<?php echo $id; ?>"  readonly="">
                <select class="mi-selector form-control" id="resp2" name="resp2" style="width: 100%;" required>
                    <option value="0">-- Escoja una opción --</option>
                    <option value="1">Opción 1</option>
                    <option value="2">Opción 2</option>
                    <option value="3">Opción 3</option>
                    <option value="4">Opción 4</option>                    
                </select> 
                <?php }elseif ($contador==3) {?>
                    <input type="hidden" class="form-control" id="pregu3" name="pregu3" value="<?php echo $id; ?>"  readonly="">
                <select class="mi-selector form-control" id="resp3" name="resp3" style="width: 100%;" required>
                    <option value="0">-- Escoja una opción --</option>
                    <option value="1">Opción 1</option>
                    <option value="2">Opción 2</option>
                    <option value="3">Opción 3</option>
                    <option value="4">Opción 4</option>                    
                </select> 
                <?php }elseif ($contador==4) {?>
                    <input type="hidden" class="form-control" id="pregu4" name="pregu4" value="<?php echo $id; ?>"  readonly="">
                <select class="mi-selector form-control" id="resp4" name="resp4" style="width: 100%;" required>
                    <option value="0">-- Escoja una opción --</option>
                    <option value="1">Opción 1</option>
                    <option value="2">Opción 2</option>
                    <option value="3">Opción 3</option>
                    <option value="4">Opción 4</option>                    
                </select> 
                <?php }elseif ($contador==5) {?>
                    <input type="hidden" class="form-control" id="pregu5" name="pregu5" value="<?php echo $id; ?>"  readonly="">
                <select class="mi-selector form-control" id="resp5" name="resp5" style="width: 100%;" required>
                    <option value="0">-- Escoja una opción --</option>
                    <option value="1">Opción 1</option>
                    <option value="2">Opción 2</option>
                    <option value="3">Opción 3</option>
                    <option value="4">Opción 4</option>                    
                </select> 
                <?php }elseif ($contador==6) {?>
                    <input type="hidden" class="form-control" id="pregu6" name="pregu6" value="<?php echo $id; ?>"  readonly="">
                <select class="mi-selector form-control" id="resp6" name="resp6" style="width: 100%;" required>
                    <option value="0">-- Escoja una opción --</option>
                    <option value="1">Opción 1</option>
                    <option value="2">Opción 2</option>
                    <option value="3">Opción 3</option>
                    <option value="4">Opción 4</option>                    
                </select> 
                <?php }elseif ($contador==7) {?>
                    <input type="hidden" class="form-control" id="pregu7" name="pregu7" value="<?php echo $id; ?>"  readonly="">
                <select class="mi-selector form-control" id="resp7" name="resp7" style="width: 100%;" required>
                    <option value="0">-- Escoja una opción --</option>
                    <option value="1">Opción 1</option>
                    <option value="2">Opción 2</option>
                    <option value="3">Opción 3</option>
                    <option value="4">Opción 4</option>                    
                </select> 
                <?php }elseif ($contador==8) {?>
                    <input type="hidden" class="form-control" id="pregu8" name="pregu8" value="<?php echo $id; ?>"  readonly="">
                <select class="mi-selector form-control" id="resp8" name="resp8" style="width: 100%;" required>
                    <option value="0">-- Escoja una opción --</option>
                    <option value="1">Opción 1</option>
                    <option value="2">Opción 2</option>
                    <option value="3">Opción 3</option>
                    <option value="4">Opción 4</option>                    
                </select> 
                <?php }elseif ($contador==9) {?>
                    <input type="hidden" class="form-control" id="pregu9" name="pregu9" value="<?php echo $id; ?>"  readonly="">
                <select class="mi-selector form-control" id="resp9" name="resp9" style="width: 100%;" required>
                    <option value="0">-- Escoja una opción --</option>
                    <option value="1">Opción 1</option>
                    <option value="2">Opción 2</option>
                    <option value="3">Opción 3</option>
                    <option value="4">Opción 4</option>                    
                </select> 
                <?php }elseif ($contador==10) {?>
                    <input type="hidden" class="form-control" id="pregu10" name="pregu10" value="<?php echo $id; ?>"  readonly="">
                <select class="mi-selector form-control" id="resp10" name="resp10" style="width: 100%;" required>
                    <option value="0">-- Escoja una opción --</option>
                    <option value="1">Opción 1</option>
                    <option value="2">Opción 2</option>
                    <option value="3">Opción 3</option>
                    <option value="4">Opción 4</option>                    
                </select> 
                <?php }
                 ?>
                
                                              
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
            setTimeout($("#resultados_fin").html("Bien hecho!!"), 2000); //REDIRECCIONAMOS FUERA DE AQUÍ, TIEMPO (1000 = 1 SEGUNDO)
            setTimeout(termina_taller, 2000); //REDIRECCIONAMOS FUERA DE AQUÍ, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})

function funcionando() {
    var fecha = $("#inicia").val();
    var inicio = new Date(fecha);
    // obtenemos la fecha actual
    var actual = new Date().getTime();
    // obtenemos la diferencia entre la fecha actual y la de inicio
    var diff = new Date(actual - inicio);
    var result = LeadingZero(diff.getUTCMinutes());  
    // Indicamos que se ejecute esta función nuevamente dentro de 1 segundo
    console.log(result);
    timeout = setTimeout("funcionando2()", 1000);
    //indicamos minutos
    if (result == 3) {
        tiempolimite()
    }
}

/* Funcion que pone un 0 delante de un valor si es necesario */
function LeadingZero(Time) {
    return (Time < 10) ? "0" + Time : +Time;
}


function tiempolimite() {
//TALLER Y CURSO       
var curso = $("#id_curso").val();
var taller = $("#id_taller").val();
var alumno = $("#id_alumno").val();

//PREGUNTAS
var p1 = $("#pregu1").val();
var p2 = $("#pregu2").val();
var p3 = $("#pregu3").val();
var p4= $("#pregu4").val();
var p5= $("#pregu5").val();
var p6= $("#pregu6").val();
var p7= $("#pregu7").val();
var p8= $("#pregu8").val();
var p9= $("#pregu9").val();
var p10 = $("#pregu10").val();

//RESPUESTAS
var r1 = $("#resp1").val();
var r2 = $("#resp2").val();
var r3 = $("#resp3").val();
var r4 = $("#resp4").val();
var r5 = $("#resp5").val();
var r6 = $("#resp6").val();
var r7 = $("#resp7").val();
var r8 = $("#resp8").val();
var r9 = $("#resp9").val();
var r10 = $("#resp10").val();
    alert("El tiempo se acabó"); 
    $.ajax({
        type: "POST",
        url: "../../controladores/funciones/finaliza_taller_tardio.php?id_c=" + curso + "&id_t=" + taller + "&id_a=" + alumno
        + "&p1=" + p1 + "&p2=" + p2 + "&p3=" + p3 + "&p4=" + p4 + "&p5=" + p5 + "&p6=" + p6 + "&p7=" + p7 + "&p8=" + p8 + "&p9=" + p9 + "&p10=" + p10
        + "&r1=" + r1 + "&r2=" + r2 + "&r3=" + r3 + "&r4=" + r4 + "&r5=" + r5 + "&r6=" + r6 + "&r7=" + r7 + "&r8=" + r8 + "&r9=" + r9 + "&r10=" + r10, //ARCHIVO CON SQL DE REGISTRO
        data: $(this).serialize(),
        beforeSend: function() {
            $('#fin_taller').attr("disabled", true); //DESACTIVAMOS BOTÓN MIENTRAS SE EJECUTA ORDEN 
            $("#resultados_fin").html("SE HA TERMINADO EL TIEMPO"); //MENSAJES DE ESPERA, ÉXITO O ERROR
            $("#resultados_fin_2").html("SE HA TERMINADO EL TIEMPO"); //MENSAJES DE ESPERA, ÉXITO O ERROR
        },
        success: function(datos) {
            setTimeout($("#resultados_fin").html("FINALIZANDO TALLER!!"), 2000); //REDIRECCIONAMOS FUERA DE AQUÍ, TIEMPO (1000 = 1 SEGUNDO)
            setTimeout($("#resultados_fin_2").html("FINALIZANDO TALLER!!"), 2000); //REDIRECCIONAMOS FUERA DE AQUÍ, TIEMPO (1000 = 1 SEGUNDO)
            setTimeout(termina_taller, 2000); //REDIRECCIONAMOS FUERA DE AQUÍ, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault(); 
      
}

function termina_taller() {
    // funciona como una redirección HTTP
    var id_curso = $("#id_curso").val();
    window.location.replace("../aula/aula.php?curso="+ id_curso);
}
</script>