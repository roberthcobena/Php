<?php    

    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php"); 

    session_start();    
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
            $resultado=" Talleres enviados";
?>
<center><p><b><?php echo $numrows; ?></b><?php echo $resultado; ?></p>       </center>

<div class="card-body table-responsive p-0">
    <table id="zero_config" class="table table-striped table-bordered text-center">
        <thead>
            <tr class="bg bg-blue">
                <th colspan=3>Detalles</th>
                <th colspan=2>Plazo</th>
                <th colspan=3>Asignación</th>
            </tr>            

            <tr>
                <th>#</th>
                <th>Taller</th>
                <th>Unidad/tema</th>                                
                <th>Desde</th>
                <th>Hasta</th>
                <th>Estado</th>
                <th>Observación</th>
                <th>Opciones</th>
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
                        $estado_color = "success";
                    } elseif ($estado == 2) {
                        $estado_color = "danger";
                    }
                    //para mensaje por estado                                        
                    if ($estado == 1) {
                        $msg_estado = "Enviado";
                    } elseif ($estado == 2) {
                        $msg_estado = "Finalizado";
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
                <td><?php echo $tema;?></td>        
                <td><?php echo $curso;?></td>        
                <td><?php echo $taller; ?></td>
                <td><?php echo $inicio;?></td>
                <td><?php echo $fin;?></td>        
                <td><span class="label label-<?php echo $estado_color; ?>"><?php echo $msg_estado; ?></span> </td>       
                <td style="text-align: center; white-space: nowrap;">
                    <?php
                        if ($estado==1) {                        
                    ?>
                        <a href="gestion_taller.php?id_taller=<?php echo $id;?>" class='btn btn-success' title='Gestionar taller'><i class="nav-icon fas fa-edit"> Gestionar</i></a>
                    <?php
                        } elseif ($estado==2) {
                    ?>
                        <a href="resultado_taller.php?id_taller=<?php echo $id;?>" class='btn btn-danger' title='Resultados del taller'><i class="nav-icon fas fa-check"> Ver resultados</i></a>
                    <?php
                        }
                    ?>
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
