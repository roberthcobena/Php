<?php    
    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php");    
    //CARGAMOS ID DE USUARIO LOGEADO
    session_start();
    $id = $_SESSION['id_usuario'];

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
	    $sTable = "cursos c, jornadas j, alumnos a, taller t, tema te, unidad u";
		$sWhere = "";
		$sWhere.=" WHERE c.est_curso!='' AND c.jornada=j.id_seccion AND a.alum_seccion=c.id_curso AND t.curs_taller=c.id_curso AND te.id_tema=t.tema_taller AND te.Id_unidad=u.id_unidad";
	if ( $_GET['q'] != "" ){
        $sWhere.= " AND  (u.uni_nombre LIKE '%$q%')";
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
            $resultado=" Unidad encontrada";
?>
<center><p><b><?php echo $numrows; ?></b><?php echo $resultado; ?></p>       </center>

<div class="card-body table-responsive p-0">    
    <table id="zero_config" class="table table-striped table-bordered text-center">       
        <tbody>
            <?php
                $contador=0;
                $estado_color="";
                $msg_estado = "";
                while ($row=mysqli_fetch_array($query)){
                    ++$contador;
                    $id=$row['id_curso'];
                    $cod_curso=$row['cod_curso'];
                    $curso=$row['nom_curso'];
                    $seccion=$row['sec_curso'];
                    $paralelo=$row['nom_seccion'];
                    $jornada=$row['jornada'];
                    $estado=$row['est_curso']; 
                    
                    //para colores por estado                    
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
                    }

                    $portada=$row['url_img']
                    ?>                
            <tr>
                <td><img src="<?php echo $portada?>" alt=""></td>
                <td><span class="label label-<?php echo $estado_color; ?>"><?php echo $msg_estado; ?></span>                
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