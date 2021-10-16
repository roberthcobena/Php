<?php    
    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php");    
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
	    $sTable = "cursos c";
		$sWhere = "";
		$sWhere.=" WHERE c.est_curso!=''";
	if ( $_GET['q'] != "" ){
        $sWhere.= " AND  (c.nom_curso LIKE '%$q%')";
    }
        $sWhere.=" ORDER BY c.nom_curso DESC ";
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
                <th>Curso</th>
                <th style="text-align: center;">Sección</th>
                <th style="text-align: center;">Jornada</th>
                <th style="text-align: center;">Opciones</th>
            </tr>
        </thead>
        
        <tbody>
            <?php
                $contador=0;
                while ($row=mysqli_fetch_array($query)){
                    ++$contador;
                    $id=$row['id_curso'];
                    $curso=$row['nom_curso'];
                    $seccion=$row['sec_curso'];
                    $jornada=$row['jornada'];
                    $estado=$row['est_curso'];                   
                    ?>
                <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">	
                <input type="hidden" value="<?php echo $curso;?>" id="curso<?php echo $id;?>">	
                <input type="hidden" value="../app/<?php echo $seccion;?>" id="seccion<?php echo $id;?>">	
                <input type="hidden" value="../app/<?php echo $jornada;?>" id="jornada<?php echo $id;?>">	
                <input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">	
            <tr>
                <td><?php echo $contador;?></td>
                <td><?php echo $curso;?></td>        
                <td><?php echo $seccion;?></td>        
                <td><?php echo $jornada;?></td>        
                <td style="text-align: center; white-space: nowrap;">
                    <button type="button" class="btn btn-success" title='Detalles' onclick="detalles('<?php echo $id;?>');" data-toggle="modal" data-target="#cursoInfo"><i class="nav-icon fas fa-edit"></i> Editar</button>
                    <button style="display:<?php echo $aut_rol; ?>;" type="button" class="btn btn-danger" title='Eliminar' onclick="eliminar('<?php echo $id; ?>');"><i class="nav-icon fas fa-trash"></i> Eliminar</button>                   
                </td>
            </tr>
            <?php
                }
                ?>            
                <tr>
                    <td colspan=5><span class="pull-right">
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