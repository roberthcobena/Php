<?php    

    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php");

    $id_curso = mysqli_real_escape_string($con,(strip_tags($_REQUEST['idcurso'], ENT_QUOTES)));    
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){
        $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $sTable = "usuario u, datos_usuarios d, alumnos a, cursos c, jornadas j";
        $sWhere = "";
        $sWhere.=" WHERE u.u_estado='1' AND c.id_curso=$id_curso  AND u.id_usuario=d.id_usuario AND u.id_usuario=a.alum_usu AND c.id_curso=a.alum_seccion AND  c.jornada=j.id_seccion ";
    if ( $_GET['q'] != "" ){
        $sWhere.= " AND  (d.nomb_user LIKE '%$q%' OR d.apell_user LIKE '%$q%')";
    }
        $sWhere.=" ORDER BY d.apell_user ASC ";
        include 'pagination.php';   
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 60;
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
            $resultado=" alumnos matriculados";

    $consul1="SELECT * FROM taller t, cursos c WHERE c.id_curso=t.curs_taller AND t.curs_taller='$id_curso' AND t.esta_taller='1'";
    $conx1= mysqli_query($con,$consul1);
    $t=0;
    $n=0;
    $num=0;
    while ($cont1= mysqli_fetch_array($conx1)) {
        ++$t;
        $tall=$cont1['id_taller'];
        $cur=$cont1['id_curso'];
        $consul2="SELECT * FROM taller t, alumno_taller n, cursos c, alumnos a, usuario u WHERE n.id_taller='$tall' AND c.id_curso=$cur AND u.u_estado='1' AND u.id_usuario=a.alum_usu AND a.alum_seccion=c.id_curso AND c.id_curso=t.curs_taller AND t.id_taller=n.id_taller AND n.id_alumno=u.id_usuario  ";
        $conx2= mysqli_query($con,$consul2);
        while ( $cont2= mysqli_fetch_array($conx2)) {
            $n=$n+$cont2['prom_taller'];
        }

    }

    $consulp="SELECT * FROM taller t, cursos c WHERE c.id_curso=t.curs_taller AND t.curs_taller='$id_curso'";
    $conxp= mysqli_query($con,$consulp);
    while ($contp= mysqli_fetch_array($conxp)) {
        ++$num;
    }

    $prome=doubleval('');
    if ($n>0) {
        $prome = round((($n/$t)/$num), 1);
    }else $prome = 0;

?>
<center><p><b><?php echo $numrows; ?></b><?php echo $resultado; ?></p>       </center>

<div class="card-body table-responsive p-0">
    <table id="zero_config" class="table  table-striped text-center">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Apellido</th>
                <th scope="col">Nombre</th>
                <th scope="col">Promedio</th>
            </tr>
        </thead>

        <tbody>
            <?php
                $contador=0;
                $pg=0;

                while ($row= mysqli_fetch_array($query)){
                    ++$contador;
                    //ids
                    $id=$row['alum_id'];
                    $idusu=$row['id_usuario'];

                    //campos
                    $nombre=$row['nomb_user'];
                    $apellido=$row['apell_user'];
                    $cu=0;
                    $pu=0;
                    
                    $consul4="SELECT * FROM alumno_taller a, usuario u WHERE a.id_alumno=$idusu AND a.id_alumno=u.id_usuario AND u.u_estado='1'";  
                    $conx4= mysqli_query($con,$consul4);
                    while ( $cont4= mysqli_fetch_array($conx4)) {
                        $cu=$cu+$cont4['prom_taller'];
                    }
                    $pu=doubleval('');
                    if ($cu>0) {
                        $pu = round(($cu/$t), 1);
                    }else $pu = 0;

                    $pg=$pg+$pu;                
                    ?> 

            <tr>
                <td scope="row"><?php echo $contador;?></td>
                <td><?php echo $apellido;?></td>
                <td><?php echo $nombre;?></td>             
                <td><?php echo $pu;?></td>                                       
                
            </tr>
            <?php
                }
                $prome1=doubleval('');
                if ($pg>0) {
                        $prome1 = round(($pg/$contador), 1);
                    }else $prome1 = 0;
                ?>            
                <tr class="table-info">
                    <td colspan=3><span class="pull-right">
                    Promedio general del curso</span></td>
                    <td><?php echo $prome1; ?></td>
                </tr>
        </tbody>
                                        
                                        
    </table>
</div>
        



<?php
}
}
?>
