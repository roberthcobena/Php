<?php    

    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php"); 

    //CARGAMOS ID DE USUARIO LOGEADO
    session_start();
    $id_al = $_SESSION['id_usuario'];   
    $id_curso = mysqli_real_escape_string($con,(strip_tags($_REQUEST['idcurso'], ENT_QUOTES)));  
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $sTable = "taller t, tema e, unidad u, cursos c, jornadas j";
		$sWhere = "";
		$sWhere.=" WHERE t.esta_taller!='' AND u.id_unidad=e.id_unidad AND e.id_tema=t.tema_taller AND t.curs_taller=c.id_curso AND c.jornada=j.id_seccion AND c.id_curso=$id_curso";
	if ( $_GET['q'] != "" ){
        $sWhere.= " AND  (t.nom_taller LIKE '%$q%')";
    }
        $sWhere.=" ORDER BY t.id_taller DESC ";            
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];        
        $sql="SELECT * FROM  $sTable $sWhere";
        $query = mysqli_query($con, $sql);    
        if ($numrows>0){
            echo mysqli_error($con);
            $resultado=" Talleres enviados por el docente";
?>
<center><p><b><?php echo $numrows; ?></b><?php echo $resultado; ?></p>       </center>

<div class="card-body table-responsive p-0">
    <table id="zero_config" class="table table-striped table-bordered text-center">
        <thead>
            <tr class="bg bg-success">
                <th colspan=3>Detalles</th>
                <th colspan=2>Plazo</th>
                <th colspan=2>Asignación</th>
            </tr>            

            <tr>
                <th>#</th>
                <th>Taller</th>
                <th>Unidad/tema</th>                                
                <th>Desde</th>
                <th>Hasta</th>
                <th>Observación</th>
                <th>Opciones</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $contador=0;
                $nota=0;
                $estado_color="";
                $msg_estado = "";
                while ($row= mysqli_fetch_array($query)){
                    ++$contador;
                    //ids
                    $id=$row['id_taller'];
                    $tem=$row['id_tema'];
                    $cur=$row['id_curso'];
                    //nombres
                    $tema=$row['uni_nombre']." (".$row['te_nombre'].") ";
                    $curso=$row['nom_curso'].' "'.$row['sec_curso'].'" ('.$row['nom_seccion'].') ';
                    $taller=$row['nom_taller'];
                    $inicio=$row['inicio_t'];
                    $fin=$row['fin_t'];
                    $estado=$row['esta_taller'];

                    //color estado
                    if ($estado == 1) {
                        $estado_color = "danger";
                    } elseif ($estado == 2) {
                        $estado_color = "success";
                    }
                    //para mensaje por estado                                        
                    if ($estado == 1) {
                        $msg_estado = "Pendiente";
                    } elseif ($estado == 2) {
                        $msg_estado = "Realizado";
                    }if($estado)                   
                    ?>
                <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">    
                <input type="hidden" value="<?php echo $tem;?>" id="tem<?php echo $id;?>">  
                <input type="hidden" value="<?php echo $cur;?>" id="cur<?php echo $id;?>">  
                <input type="hidden" value="<?php echo $taller;?>" id="taller<?php echo $id;?>">  
                <input type="hidden" value="<?php echo $inicio;?>" id="inicio<?php echo $id;?>">
                <input type="hidden" value="<?php echo $fin;?>" id="fin<?php echo $id;?>">    
                <input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">    
            <tr>
                <td><?php echo $contador;?></td>
                <td><?php echo $taller; ?></td>
                <td><?php echo $tema;?></td>        
                <td><?php echo $inicio;?></td>
                <td><?php echo $fin;?></td>        
                <td><?php
                    $msg_time="";                                         
                    $nota="";
                    $sql2 = "SELECT * FROM alumno_taller a WHERE a.id_alumno = " . $id_al . " AND a.id_taller= " . $id ." ";
                    if ($result = mysqli_query($con, $sql2)) {
                        $row_cnt = mysqli_num_rows($result);
                        if (empty($row_cnt)) {
                                printf("<b>PENDIENTE</b>" , $row_cnt);
                        }else{                        
                            $query3 = mysqli_query($con, $sql2);
                            while ($row_tiempo = mysqli_fetch_array($query3)) {
                                $nota=$row_tiempo['prom_taller'];                                                                     
                                //tiempo de entrega                                        
                                if ($row_tiempo['fin_taller'] < $row['fin_t']) {
                                    $msg_time = "Entregó a tiempo";
                                } elseif ($row_tiempo['fin_taller'] > $row['fin_t']) {
                                    $msg_time = "Entregó con atraso";
                                }elseif(empty($row_tiempo['fin_taller'])){
                                    $msg_time = "Falta entrega");
                                }

                                printf("<b>". $msg_time . "</b>");
                            }                            
                        }
                    }                    
                ?></td>
                <td><?php                                         
                    $sql3 = "SELECT * FROM alumno_taller a WHERE a.id_alumno = " . $id_al . " AND a.id_taller= " . $id ." AND a.est_taller!=2 ";
                    if ($result = mysqli_query($con, $sql3)) {
                        $row_cnt = mysqli_num_rows($result);
                        if (empty($row_cnt)) {
                            ?>
                                <a href="#" onclick="hacertaller('<?php echo $id;?>');" class='btn btn-success' title='Realizar taller'><i class="nav-icon fas fa-edit"> Realizar</i></a>
                            <?php
                        }else{                        
                            $query3 = mysqli_query($con, $sql3);
                            while ($row_cursos = mysqli_fetch_array($query3)) {                                                                     
                            }
                            ?>
                                <a href="resultado_taller.php?id_taller=<?php echo $id;?>" class='btn btn-danger' title='Resultados del taller'><i class="nav-icon fas fa-check"> Ver resultados</i></a>
                            <?php
                        }
                    }                    
                ?></td>
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
