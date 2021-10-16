<?php    
    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php");    
    //CARGAMOS ID DE USUARIO LOGEADO
    session_start();
    $id = $_SESSION['id_usuario'];
    $consul = "SELECT * from docentes where id_usuario=$id";
    $cont = mysqli_query($con, $consul);
    while ($row = mysqli_fetch_array($cont)) {
        $iddoc = $row['id_docente'];        
}

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $sTable = "doc_curso dc, docentes d, cursos c, jornadas j, anios_lectivos a";
        $sWhere = "";
        $sWhere.=" WHERE dc.id_docente= $iddoc AND d.id_docente=dc.id_docente AND c.id_curso=dc.id_curso AND c.jornada=j.id_seccion AND c.an_lec=a.id AND c.est_curso !='2'";
    if ( $_GET['q'] != "" ){
        $sWhere.= " AND  (c.nom_curso LIKE '%$q%' OR c.cod_curso LIKE '%$q%')";
    }
        $sWhere.=" ORDER BY c.est_curso ASC ";
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
                <th style="text-align: center;">Año lectivo</th>
                <th style="text-align: center;">Estado</th>               
                <th style="text-align: center;">Administrar</th>
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
                    $lectivo=$row['anio'];


                    if ($estado == 1) {
                        $estado_color = "success";
                    } elseif ($estado == 3) {
                        $estado_color = "primary";
                    }
                    //para mensaje por estado                                        
                    if ($estado == 1) {
                        $msg_estado = "Activo";
                    } elseif ($estado == 3) {
                        $msg_estado = "Finalizado";
                    } 
                    ?>                
            <tr>
                <td><?php echo $contador;?></td>
                <td><?php echo $cod_curso;?></td>        
                <td><?php echo $curso;?></td>        
                <td><?php echo $seccion;?></td>        
                <td><?php echo $paralelo;?></td>
                <td><?php echo $lectivo;?></td>
                <td><span class="label label-<?php echo $estado_color; ?>"><?php echo $msg_estado; ?></span></td>     
                <td>
                <center><span class="pull-right">
                        

                        <a href="calificaciones.php?curso=<?php echo $id;?>" class='btn btn-success'
                            title='Ver Curso'><i class="glyphicon glyphicon-check"> Ir al curso</i>
                        </a>
                    </span></center>
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