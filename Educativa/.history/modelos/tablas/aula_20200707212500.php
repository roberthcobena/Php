<?php    

    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php");    
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $sTable = "usuario u, datos_usuarios d, docentes o, doc_curso s, cursos c, jornadas j";
        $sWhere = "";
        $sWhere.=" WHERE s.est_doc_cur!='' AND u.id_usuario=d.id_usuario AND u.id_usuario=o.id_usuario AND o.id_docente=s.id_docente AND s.id_curso=c.id_curso AND c.jornada=j.id_seccion";
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
                <th>Seccion</th>
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
                    //id
                    $id=$row['id_doc_cur'];
                    $doc=$row['id_docente'];
                    $cur=$row['id_curso'];

                    //campos
                    $nombre=$row['nomb_user'];
                    $apellido=$row['apell_user'];
                    $curso=$row['nom_curso'];
                    $seccion=$row['sec_curso'];
                    $jornada=$row['nom_seccion'];
                    $estado=$row['est_doc_cur'];

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
                <input type="hidden" value="<?php echo $doc;?>" id="doc<?php echo $id;?>">  
                <input type="hidden" value="<?php echo $cur;?>" id="cur<?php echo $id;?>">  
                <input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">    
            <tr>
                <td><?php echo $contador;?></td>
                <td><?php echo $nombre;?></td>
                <td><?php echo $apellido;?></td>         
                <td><?php echo $curso;?></td>        
                <td><?php echo $seccion;?></td> 
                <td><?php echo $jornada;?></td>
                <td><span class="label label-<?php echo $estado_color; ?>"><?php echo $msg_estado; ?></span> </td>       
                <td style="text-align: center; white-space: nowrap;">
                    <button type="button" class="btn btn-success" title='Detalles' onclick="detalles('<?php echo $id;?>');" data-toggle="modal" data-target="#asigInfo"><i class="nav-icon fas fa-edit"></i> Editar</button>                    
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
