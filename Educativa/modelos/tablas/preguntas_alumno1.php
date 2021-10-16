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
        <input type="hidden" class="form-control" id="inicia" value="<?php echo $inicia; ?>" name="inicia" readonly="">
        
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
            <div class="form-group row justify-content-center">
                <label for="pregunta<?php echo $id; ?>" class="col-md-8 h6 bg-info text-white  rounded control-label col-form-label"><?php echo $contador . "- " . $pregunta; ?> </label><br>
                <div class="col-md-8">                

                <?php
                if ($contador==1) {?>
                    <input type="hidden" class="form-control" id="pregu1" name="pregu1" value="<?php echo $id; ?>"  readonly="">
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp1" class="custom-control-input" id="customControlValidation1" value="1" required />
                        <label class="custom-control-label" for="customControlValidation1"><?php echo $op1; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp1" class="custom-control-input" id="customControlValidation2" value="2" />
                        <label class="custom-control-label" for="customControlValidation2"><?php echo $op2; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp1" class="custom-control-input" id="customControlValidation3" value="3" />
                        <label class="custom-control-label" for="customControlValidation3"><?php echo $op3; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp1" class="custom-control-input" id="customControlValidation4" value="4" />
                        <label class="custom-control-label" for="customControlValidation4"><?php echo $op4; ?> </label>
                    </div>  
                <?php }elseif ($contador==2) {?>
                    <input type="hidden" class="form-control" id="pregu2" name="pregu2" value="<?php echo $id; ?>"  readonly="">
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp2" class="custom-control-input" id="customControlValidation5" value="1" required />
                        <label class="custom-control-label" for="customControlValidation5"><?php echo $op1; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp2" class="custom-control-input" id="customControlValidation6" value="2" />
                        <label class="custom-control-label" for="customControlValidation6"><?php echo $op2; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp2" class="custom-control-input" id="customControlValidation7" value="3" />
                        <label class="custom-control-label" for="customControlValidation7"><?php echo $op3; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp2" class="custom-control-input" id="customControlValidation8" value="4" />
                        <label class="custom-control-label" for="customControlValidation8"><?php echo $op4; ?> </label>
                    </div>
                <?php }elseif ($contador==3) {?>
                    <input type="hidden" class="form-control" id="pregu3" name="pregu3" value="<?php echo $id; ?>"  readonly="">
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp3" class="custom-control-input" id="customControlValidation9" value="1" required />
                        <label class="custom-control-label" for="customControlValidation9"><?php echo $op1; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp3" class="custom-control-input" id="customControlValidation10" value="2" />
                        <label class="custom-control-label" for="customControlValidation10"><?php echo $op2; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp3" class="custom-control-input" id="customControlValidation11" value="3" />
                        <label class="custom-control-label" for="customControlValidation11"><?php echo $op3; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp3" class="custom-control-input" id="customControlValidation12" value="4" />
                        <label class="custom-control-label" for="customControlValidation12"><?php echo $op4; ?> </label>
                    </div>
                <?php }elseif ($contador==4) {?>
                    <input type="hidden" class="form-control" id="pregu4" name="pregu4" value="<?php echo $id; ?>"  readonly="">
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp4" class="custom-control-input" id="customControlValidation13" value="1" required />
                        <label class="custom-control-label" for="customControlValidation13"><?php echo $op1; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp4" class="custom-control-input" id="customControlValidation14" value="2" />
                        <label class="custom-control-label" for="customControlValidation14"><?php echo $op2; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp4" class="custom-control-input" id="customControlValidation15" value="3" />
                        <label class="custom-control-label" for="customControlValidation15"><?php echo $op3; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp4" class="custom-control-input" id="customControlValidation16" value="4" />
                        <label class="custom-control-label" for="customControlValidation16"><?php echo $op4; ?> </label>
                    </div> 
                <?php }elseif ($contador==5) {?>
                    <input type="hidden" class="form-control" id="pregu5" name="pregu5" value="<?php echo $id; ?>"  readonly="">
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp5" class="custom-control-input" id="customControlValidation17" value="1" required />
                        <label class="custom-control-label" for="customControlValidation17"><?php echo $op1; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp5" class="custom-control-input" id="customControlValidation18" value="2" />
                        <label class="custom-control-label" for="customControlValidation18"><?php echo $op2; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp5" class="custom-control-input" id="customControlValidation19" value="3" />
                        <label class="custom-control-label" for="customControlValidation19"><?php echo $op3; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp5" class="custom-control-input" id="customControlValidation20" value="4" />
                        <label class="custom-control-label" for="customControlValidation20"><?php echo $op4; ?> </label>
                    </div>
                <?php }elseif ($contador==6) {?>
                    <input type="hidden" class="form-control" id="pregu6" name="pregu6" value="<?php echo $id; ?>"  readonly="">
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp6" class="custom-control-input" id="customControlValidation21" value="1" required />
                        <label class="custom-control-label" for="customControlValidation21"><?php echo $op1; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp6" class="custom-control-input" id="customControlValidation22" value="2" />
                        <label class="custom-control-label" for="customControlValidation22"><?php echo $op2; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp6" class="custom-control-input" id="customControlValidation23" value="3" />
                        <label class="custom-control-label" for="customControlValidation23"><?php echo $op3; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp6" class="custom-control-input" id="customControlValidation24" value="4" />
                        <label class="custom-control-label" for="customControlValidation24"><?php echo $op4; ?> </label>
                    </div>
                <?php }elseif ($contador==7) {?>
                    <input type="hidden" class="form-control" id="pregu7" name="pregu7" value="<?php echo $id; ?>"  readonly="">
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp7" class="custom-control-input" id="customControlValidation25" value="1" required />
                        <label class="custom-control-label" for="customControlValidation25"><?php echo $op1; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp7" class="custom-control-input" id="customControlValidation26" value="2" />
                        <label class="custom-control-label" for="customControlValidation26"><?php echo $op2; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp7" class="custom-control-input" id="customControlValidation27" value="3" />
                        <label class="custom-control-label" for="customControlValidation27"><?php echo $op3; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp7" class="custom-control-input" id="customControlValidation28" value="4" />
                        <label class="custom-control-label" for="customControlValidation28"><?php echo $op4; ?> </label>
                    </div>
                <?php }elseif ($contador==8) {?>
                    <input type="hidden" class="form-control" id="pregu8" name="pregu8" value="<?php echo $id; ?>"  readonly="">
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp8" class="custom-control-input" id="customControlValidation29" value="1" required />
                        <label class="custom-control-label" for="customControlValidation29"><?php echo $op1; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp8" class="custom-control-input" id="customControlValidation30" value="2" />
                        <label class="custom-control-label" for="customControlValidation30"><?php echo $op2; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp8" class="custom-control-input" id="customControlValidation31" value="3" />
                        <label class="custom-control-label" for="customControlValidation31"><?php echo $op3; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp8" class="custom-control-input" id="customControlValidation32" value="4" />
                        <label class="custom-control-label" for="customControlValidation32"><?php echo $op4; ?> </label>
                    </div>
                <?php }elseif ($contador==9) {?>
                    <input type="hidden" class="form-control" id="pregu9" name="pregu9" value="<?php echo $id; ?>"  readonly="">
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp9" class="custom-control-input" id="customControlValidation33" value="1" required />
                        <label class="custom-control-label" for="customControlValidation33"><?php echo $op1; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp9" class="custom-control-input" id="customControlValidation34" value="2" />
                        <label class="custom-control-label" for="customControlValidation34"><?php echo $op2; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp9" class="custom-control-input" id="customControlValidation35" value="3" />
                        <label class="custom-control-label" for="customControlValidation35"><?php echo $op3; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp9" class="custom-control-input" id="customControlValidation36" value="4" />
                        <label class="custom-control-label" for="customControlValidation36"><?php echo $op4; ?> </label>
                    </div>
                <?php }elseif ($contador==10) {?>
                    <input type="hidden" class="form-control" id="pregu10" name="pregu10" value="<?php echo $id; ?>"  readonly="">
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp10" class="custom-control-input" id="customControlValidation37" value="1" required />
                        <label class="custom-control-label" for="customControlValidation37"><?php echo $op1; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp10" class="custom-control-input" id="customControlValidation38" value="2" />
                        <label class="custom-control-label" for="customControlValidation38"><?php echo $op2; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp10" class="custom-control-input" id="customControlValidation39" value="3" />
                        <label class="custom-control-label" for="customControlValidation39"><?php echo $op3; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp10" class="custom-control-input" id="customControlValidation40" value="4" />
                        <label class="custom-control-label" for="customControlValidation40"><?php echo $op4; ?> </label>
                    </div>
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
    timeout = setTimeout("funcionando()", 1000);
    //indicamos minutos máximos
    if (result == 20) {
        stop();//Detenemos ejecución de función cada segundo
        tiempolimite();
    }    
}
function stop() {
        if (timeout) {
            clearTimeout(timeout);
            timeout = 0;
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
}

function termina_taller() {
    // funciona como una redirección HTTP
    var id_curso = $("#id_curso").val();
    window.location.replace("../aula/aula.php?curso="+ id_curso);
}
</script>