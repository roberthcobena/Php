<?php    

    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php");    
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $sTable = "usuario u, datos_usuarios d, alumnos a, cursos c, jornadas j";
        $sWhere = "";
        $sWhere.=" WHERE u.u_estado!=''  AND u.id_usuario=d.id_usuario AND u.id_usuario=a.alum_usu AND c.id_curso=a.alum_seccion AND  c.jornada=j.id_seccion GROUP BY u.id_usuario";
    if ( $_GET['q'] != "" ){
        $sWhere.= " AND  (d.nomb_user LIKE '%$q%')";
    }
        $sWhere.=" ORDER BY d.nomb_user DESC ";
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
            $resultado=" Cursos encontrados";
?>
<center><p><b><?php echo $numrows; ?></b><?php echo $resultado; ?></p>       </center>
<div class="card-body table-responsive p-0">
    <table id="zero_config" class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Curso</th>
                <th>Paralelo</th>
                <th>Jornada</th>
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
                    $id=$row['alum_id'];
                    $idcurs=$row['id_curso'];
                    $jor=$row['id_seccion'];
                    //campos
                    $nombre=$row['nomb_user'];
                    $apellido=$row['apell_user'];
                    $curso=$row['nom_curso'];
                    $seccion=$row['sec_curso'];
                    $jornada=$row['nom_seccion'];
                    $estado=$row['u_estado'];
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
                <input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id;?>">  
                <input type="hidden" value="<?php echo $apellido;?>" id="apellido<?php echo $id;?>">  
                <input type="hidden" value="<?php echo $idcurs;?>" id="idcurs<?php echo $id;?>">
                <input type="hidden" value="<?php echo $seccion;?>" id="seccion<?php echo $id;?>">
                <input type="hidden" value="<?php echo $jor;?>" id="jor<?php echo $id;?>">    
                <input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">    
            <tr>
                <td><?php echo $contador;?></td>
                <td><?php echo $nombre;?></td>        
                <td><?php echo $apellido;?></td>        
                <td><?php //cursos del estudiante
                    $sql3 = "SELECT * FROM cursos c, alumnos a WHERE a.alum_usu = " . $row['alum_id'] . " AND a.alum_seccion=c.id_curso";
                    if ($result = mysqli_query($con, $sql3)) {
                        $row_cnt = mysqli_num_rows($result);
                        if ($row_cnt > 0) {
                            $query3 = mysqli_query($con, $sql3);
                            while ($row_respon = mysqli_fetch_array($query3)) {
                                printf($row_respon['doc_nombre'] . "; ");
                            }
                        } else {
                            printf("<b>SIN INVESTIGADORES DESIGNADO</b>\n", $row_cnt);
                        }
                    }
                    echo $curso;
                ?></td> 
                <td><?php echo $seccion;?></td>
                <td><?php echo $jornada;?></td>
                <td><span class="label label-<?php echo $estado_color; ?>"><?php echo $msg_estado; ?></span> </td>                        
                <td style="text-align: center; white-space: nowrap;">
                    <button type="button" class="btn btn-success" title='Detalles' onclick="detalles('<?php echo $id;?>');" data-toggle="modal" data-target="#estInfo"><i class="nav-icon fas fa-edit"></i> Editar</button>                    
                </td>
            </tr>
            <?php
                }
                ?>            
                <tr>
                    <td colspan=8><span class="pull-right">
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