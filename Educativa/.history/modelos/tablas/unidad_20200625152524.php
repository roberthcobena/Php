<?php    
    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php");    
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
  if($action == 'ajax'){
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
      $sTable = "unidad u";
    $sWhere = "";
    $sWhere.=" WHERE u.uni_est!='' ";
  if ( $_GET['q'] != "" ){
        $sWhere.= " AND  (u.uni_nombre LIKE '%$q%')";
    }
        $sWhere.=" ORDER BY u.uni_nombre DESC ";
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
            $resultado=" Unidades encontradas";
?>
<center><p><b><?php echo $numrows; ?></b><?php echo $resultado; ?></p>       </center>

<div class="card-body table-responsive p-0">
  <table id="zero_config" class="table table-striped table-bordered text-center">
    <thead>
      <tr>
        <th>#</th>
        <th>Unidad</th>
        <th>Descripcion</th>
        <th>Opciones</th>                                      
      </tr>
    </thead>

    <tbody>
      <?php
        $contador=0;
        while ($row=mysqli_fetch_array($query)){
                    ++$contador;
                    $id=$row['id_unidad'];
                    $unidad=$row['uni_nombre'];
                    $descripcion=$row['uni_descripcion'];
                    $imagen=$row['url_img'];
                    $estado=$row['uni_est']; 
      ?>
      <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">  
      <input type="hidden" value="<?php echo $unidad;?>" id="unidad<?php echo $id;?>">  
      <input type="hidden" value="<?php echo $descripcion;?>" id="descripcion<?php echo $id;?>">
      <input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">  
        <tr>
          <td><?php echo $contador;?></td>
          <td><?php echo $unidad;?></td>        
          <td><?php echo $descripcion;?></td>
          <td style="text-align: center; white-space: nowrap;">
                    <button type="button" class="btn btn-success" title='Detalles' onclick="detalles('<?php echo $id;?>');" data-toggle="modal" data-target="#uniInfo"><i class="nav-icon fas fa-edit"></i> Editar</button>                    
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
