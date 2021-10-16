
<?php    

    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php");    
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $sTable = "usuario u, datos_usuarios d, tipo_usuario t";
        $sWhere = "";
        $sWhere.=" WHERE u.u_estado!='' AND u.id_usuario=d.id_usuario AND u.u_tipo=t.id_tipo_usuario AND u.u_tipo!=1";
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
                <th>Telefono</th>
                <th>Correo</th>
                <th>Tipo</th>
                <th>Usuario</th>
                <th>Clave</th>
                <th>operaciones</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $contador=0;
                while ($row= mysqli_fetch_array($query)){
                    ++$contador;
                    $id=$row['id_usuario'];
                    $nombre=utf8_encode($row['nomb_user']);
                    $apellido=$row['apell_user'];
                    $telf=$row['telf_user'];
                    $correo=utf8_encode($row['correo_user']);
                    $cuenta=$row['nombre_tipo'];
                    $tipo=$row['id_tipo_usuario'];
                    $usuario=utf8_encode($row['u_usuario']);
                    $clave=$row['u_contra'];
                    $estado=$row['u_estado'];                   
                    ?>
                <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">    
                <input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id;?>">  
                <input type="hidden" value="<?php echo $apellido;?>" id="apellido<?php echo $id;?>">  
                <input type="hidden" value="<?php echo $telf;?>" id="telf<?php echo $id;?>">  
                <input type="hidden" value="<?php echo $correo;?>" id="correo<?php echo $id;?>">
                <input type="hidden" value="<?php echo $cuenta;?>" id="cuenta<?php echo $id;?>">    
                <input type="hidden" value="<?php echo $usuario;?>" id="usuario<?php echo $id;?>">  
                <input type="hidden" value="<?php echo $clave;?>" id="clave<?php echo $id;?>">  
                <input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">    
            <tr>
                <td><?php echo $contador;?></td>
                <td><?php echo $nombre;?></td>        
                <td><?php echo $apellido;?></td>        
                <td><?php echo $telf;?></td> 
                <td><?php echo $correo;?></td>
                <td><?php echo $cuenta;?></td>        
                <td><?php echo $usuario;?></td>        
                <td><?php echo $clave;?></td>        
                <td style="text-align: center; white-space: nowrap;">
                    <button type="button" class="btn btn-success" title='Detalles' onclick="detalles('<?php echo $id;?>');" data-toggle="modal" data-target="#userInfo"><i class="nav-icon fas fa-edit"></i> Editar</button>                    
                </td>
            </tr>
            <?php
                }
                ?>            
                <tr>
                    <td colspan=9><span class="pull-right">
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
