<?php    
    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php");    
    //CARGAMOS ID DE USUARIO LOGEADO
    session_start();
    $id = $_SESSION['id_usuario'];

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
	    $sTable = "doc_curso dc, docentes d, cursos c, jornadas j";
		$sWhere = "";
		$sWhere.=" WHERE d.id_usuario= $id AND c.id_curso=dc.id_curso AND c.jornada=j.id_seccion";
	if ( $_GET['q'] != "" ){
        $sWhere.= " AND  (c.nom_curso LIKE '%$q%' OR c.cod_curso LIKE '%$q%')";
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
                <th>Código</th>
                <th>Curso</th>
                <th style="text-align: center;">Sección</th>
                <th style="text-align: center;">Jornada</th>              
            </tr>
        </thead>
        
        <tbody>
            <?php
                $contador=0;
                while ($row=mysqli_fetch_array($query)){
                    ++$contador;
                    $id=$row['id_curso'];
                    $cod_curso=$row['cod_curso'];
                    $curso=$row['nom_curso'];
                    $seccion=$row['sec_curso'];
                    $paralelo=$row['nom_seccion'];
                    $jornada=$row['jornada'];
                    $estado=$row['est_curso']; 
                    ?>                
            <tr>
                <td><?php echo $contador;?></td>
                <td><?php echo $cod_curso;?></td>        
                <td><?php echo $curso;?></td>        
                <td><?php echo $seccion;?></td>        
                <td><?php echo $paralelo;?></td>  
                <td>
                <center><span class="pull-right">
                        

                        <a href="planificacion.php?id_proyecto=<?php echo $id_proyecto;?>" class='btn btn-success'
                            title='Planificación'><i class="glyphicon glyphicon-check"> Planificación</i>
                        </a>
                    </span></center>
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