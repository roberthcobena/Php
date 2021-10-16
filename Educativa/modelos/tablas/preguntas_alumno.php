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
                $cant_taller=$row3['cant_taller'];            
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
        <input type="hidden" class="form-control" id="cant_taller" value="<?php echo $cant_taller; ?>" name="cant_taller" readonly="">
        <input type="hidden" class="form-control" id="inicia" value="<?php echo $inicia; ?>" name="inicia" readonly="">
        
        <?php
            $contador=0;
            $val=0;
            $val1=0;
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


                    <input type="hidden" class="form-control" id="pregu<?php echo $contador; ?>" name="pregu<?php echo $contador; ?>" value="<?php echo $id; ?>"  readonly="">
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp<?php echo $contador; ?>" class="custom-control-input" id="customControlValidation<?php echo ++$val; ?>" value="1" required />
                        <label class="custom-control-label" for="customControlValidation<?php echo ++$val1; ?>"><?php echo $op1; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp<?php echo $contador; ?>" class="custom-control-input" id="customControlValidation<?php echo ++$val; ?>" value="2" />
                        <label class="custom-control-label" for="customControlValidation<?php echo ++$val1; ?>"><?php echo $op2; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp<?php echo $contador; ?>" class="custom-control-input" id="customControlValidation<?php echo ++$val; ?>" value="3" />
                        <label class="custom-control-label" for="customControlValidation<?php echo ++$val1; ?>"><?php echo $op3; ?> </label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" name="resp<?php echo $contador; ?>" class="custom-control-input" id="customControlValidation<?php echo ++$val; ?>" value="4" />
                        <label class="custom-control-label" for="customControlValidation<?php echo ++$val1; ?>"><?php echo $op4; ?> </label>
                    </div>  
                
                    
                
                                              
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
        url: "../../controladores/funciones/finaliza_taller1.php", //ARCHIVO CON SQL DE REGISTRO
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
var cant = $("#cant_taller").val();

//PREGUNTAS

//RESPUESTAS

    $.ajax({
        type: "POST",
        url: "../../controladores/funciones/finaliza_taller_tardio1.php?id_c=" + curso + "&id_t=" + taller + "&id_a=" + alumno
        + "&cant=" + cant, //ARCHIVO CON SQL DE REGISTRO
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