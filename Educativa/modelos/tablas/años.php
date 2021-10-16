<?php    
    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php");    
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
	    $sTable = "anios_lectivos a";
		$sWhere =" ";
	if ( $_GET['q'] != "" ){
        $sWhere.= " AND a.anio LIKE '%$q%'";
    }
        $sWhere.=" ORDER BY a.desde ASC ";
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
            $resultado=" Años encontrados";
?>
<center><p><b><?php echo $numrows; ?></b><?php echo $resultado; ?></p>       </center>

<div class="card-body table-responsive p-0">
    <table id="zero_config" class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th style="text-align: center;">Año</th>
                <th style="text-align: center;">Inicio</th>
                <th style="text-align: center;">Fin</th>
                <th style="text-align: center;">Estado</th>
                <th style="text-align: center;">Editar</th>
            </tr>
        </thead>
        
        <tbody>
            <?php
                $contador=0;
                $estado_color="";
                $msg_estado = "";
                while ($row=mysqli_fetch_array($query)){
                    ++$contador;
                    $id=$row['id'];
                    $anio=$row['anio'];
                    $desde=$row['desde'];
                    $hasta=$row['hasta'];
                    $estado=$row['estado']; 
                    
                    //para colores por estado                    
                    if ($estado == 1) {
                        $estado_color = "success";
                    } elseif ($estado == 2) {
                        $estado_color = "danger";
                    }elseif ($estado == 3) {
                        $estado_color = "primary";
                    }
                    //para mensaje por estado                                        
                    if ($estado == 1) {
                        $msg_estado = "Activo";
                    } elseif ($estado == 2) {
                        $msg_estado = "Inactivo";
                    }elseif ($estado == 3) {
                        $msg_estado = "Finalizado";
                    }
                    ?>
                <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">	
                <input type="hidden" value="<?php echo $anio;?>" id="anio<?php echo $id;?>">	
                <input type="hidden" value="<?php echo $desde;?>" id="desde<?php echo $id;?>">	
                <input type="hidden" value="<?php echo $hasta;?>" id="hasta<?php echo $id;?>">	
                <input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">	
            <tr>
                <td><?php echo $contador;?></td>
                <td><?php echo $anio;?></td>        
                <td><?php echo $desde;?></td>        
                <td><?php echo $hasta;?></td>        
                <td><span class="label label-<?php echo $estado_color; ?>"><?php echo $msg_estado; ?></span></td>     
                <td style="text-align: center; white-space: nowrap;">
                    <button type="button" class="btn btn-success" title='Detalles' onclick="detalles('<?php echo $id;?>');" data-toggle="modal" data-target="#añoInfo"><i class="nav-icon fas fa-edit"></i> Editar</button>                    
                </td>
            </tr>
            <?php
                }
                ?>            
                <tr>
                    <td colspan=7><span class="pull-right">
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