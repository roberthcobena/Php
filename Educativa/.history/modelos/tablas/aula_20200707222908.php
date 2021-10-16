<?php    

    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php"); 

    session_start();
    $idu = $_SESSION['id_usuario'];
    $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['idcurso'], ENT_QUOTES)));
    $consul = "SELECT * from usuario where id_usuario=$idu";
    $cont = mysqli_query($con, $consul);
    $consul2 = "SELECT * from docentes where id_usuario=$idu";
    $cont2 = mysqli_query($con, $consul2);
    while ($row = mysqli_fetch_array($cont)) { $tipo = $row['u_tipo'];  }       
    while ($row = mysqli_fetch_array($cont2)) {  $cargo = $row['doc_cargo'];  }
  
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        if ($tipo==1 OR $cargo==1) {
            $sTable = "taller t, tema e, unidad u, cursos c, jornadas j";
            $sWhere = "";
            $sWhere.=" WHERE t.esta_taller!='' AND u.id_unidad=e.id_unidad AND e.id_tema=t.tema_taller AND t.curs_taller=c.id_curso AND c.jornada=j.id_seccion";
        }else if ($tipo==2 AND $cargo==2) {
            $sTable = "taller t, tema e, unidad u, cursos c, jornadas j, doc_curso d, docentes o";
            $sWhere = "";
            $sWhere.=" WHERE t.esta_taller!='' AND u.id_unidad=e.id_unidad AND e.id_tema=t.tema_taller AND t.curs_taller=c.id_curso AND c.jornada=j.id_seccion AND c.id_curso=d.id_curso AND d.id_docente=o.id_docente AND o.id_usuario=$idu";
        }
        
    if ( $_GET['q'] != "" ){
        $sWhere.= " AND  (t.nom_taller LIKE '%$q%')";
    }
        $sWhere.=" ORDER BY t.nom_taller DESC ";
        include 'pagination.php';   
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 20;
        $adjacents  = 4;
        $offset = ($page - 1) * $per_page;    
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row= mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows/$per_page);
        $reload = '#';    
        $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);    
        if ($numrows>0){
            echo mysqli_error($con);
            $resultado=" Talleres enviados";
?>
<center><p><b><?php echo $numrows; ?></b><?php echo $resultado; ?></p>       </center>

<div class="card-body table-responsive p-0">
    <table id="zero_config" class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Tema</th>
                <th>Curso</th>
                <th>Taller</th>
                <th>Inicio</th>
                <th>Final</th>
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
                        $msg_estado = "Activo";
                    } elseif ($estado == 2) {
                        $msg_estado = "Inactivo";
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
                <td><?php echo $taller;?></td> 
                <td><?php echo $inicio;?></td>
                <td><?php echo $fin;?></td>        
                <td><span class="label label-<?php echo $estado_color; ?>"><?php echo $msg_estado; ?></span> </td>       
                <td style="text-align: center; white-space: nowrap;">
                    <button type="button" class="btn btn-success" title='Detalles' onclick="detalles('<?php echo $id;?>');" data-toggle="modal" data-target="#talInfo"><i class="nav-icon fas fa-edit"></i> Editar</button>                    
                </td>
            </tr>
            <?php
                }
                ?>            
                <tr>
                    <td colspan=10><span class="pull-right">
                    <?php
                     echo paginate($reload, $page, $total_pages, $adjacents);
                    ?></span></td>
                </tr>
        </tbody>
                                        
                                        
    </table>
</div>
<?php
}
}
?>
