<?php
    $contador=0;                
    $sTable = "cursos c, alumnos a, datos_usuarios dc"; 
    $sWhere = " WHERE c.id_curso=$id_curso AND c.id_curso=a.alum_seccion AND a.alum_usu=dc.id_usuario";
    $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
    $row= mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    $sql="SELECT * FROM  $sTable $sWhere";
    $query = mysqli_query($con, $sql);
?>
<aside class="left-sidebar" data-sidebarbg="skin2">
    <!-- Sidebar scroll-->
    <div class="content-row">
        <h4>Estudiantes registrados: <?php echo $numrows;?></h4>
        <table>
            <tr>
            <?php                
                while ($row = mysqli_fetch_array($query)) {
                    ++$contador;
                    $nom_alumno = $row['nomb_user'];        
                    $ape_alumno = $row['apell_user'];        
            
            ?>
                <th><?php echo $contador ."- " . $nom_alumno . " " . $ape_alumno;?></th>
            </tr>
            <?php }?>
        </table>
        <!-- <img src="../../recursos/img/logo_cole.png" alt="" width=100% height=100% style="border-radius: 8px;border: 1px solid #ddd; border-radius: 4px; padding: 5px;"> -->
        
    </div>            
</aside>