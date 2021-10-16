<?php    

    require_once ("../../controladores/conexion/db.php");
    require_once ("../../controladores/conexion/conexion.php");

    $id_curso = mysqli_real_escape_string($con,(strip_tags($_REQUEST['idcurso'], ENT_QUOTES)));    
    
    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    if($action == 'ajax'){
        $sTable = "usuario u, datos_usuarios d, alumnos a, cursos c, jornadas j";
        $sWhere = "";
        $sWhere.=" WHERE u.u_estado='1' AND c.id_curso=$id_curso  AND u.id_usuario=d.id_usuario AND u.id_usuario=a.alum_usu AND c.id_curso=a.alum_seccion AND  c.jornada=j.id_seccion ";

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
            $resultado=" Matriculas encontrados";

    $consul1="SELECT * FROM taller t, cursos c WHERE c.id_curso=t.curs_taller AND t.curs_taller='$id_curso' AND t.esta_taller='1'";
    $conx1= mysqli_query($con,$consul1);
    $t=0;
    $n=0;
    while ($cont1= mysqli_fetch_array($conx1)) {
        ++$t;
        $tall=$cont1['id_taller'];
        $cur=$cont1['id_curso'];
        $consul2="SELECT * FROM taller t, alumno_taller n, cursos c, alumnos a, usuario u WHERE n.id_taller='$tall' AND c.id_curso=$cur AND u.u_estado='1' AND u.id_usuario=a.alum_usu AND a.alum_seccion=c.id_curso AND c.id_curso=t.curs_taller AND t.id_taller=n.id_taller AND n.id_alumno=u.id_usuario AND u.u_estado='1' ";
        $conx2= mysqli_query($con,$consul2);
        while ( $cont2= mysqli_fetch_array($conx2)) {
            $n=$n+$cont2['prom_taller'];
        }

    }

    $prome=doubleval('');
    if ($n>0) {
        $prome = round((($n/$t)/$numrows), 1);
    }else $prome = 0; 

    
?>


        <figure class="highcharts-figure">
            <div id="container"></div>
            <p class="highcharts-description">
                Haga <b>"Click"</b> en los nombres de cada unidad para ver el promedio individual de cada uno de los <b>Temas</b> que se encuentran dentro de cada unidad.
            </p>
        </figure>



<?php
}
}
?>
<script type="text/javascript">
// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Promedio general de las unidades y sus subtemas'
    },
    // subtitle: {
    //     text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
    // },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total del promedio'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> de Promedio<br/>'
    },

    series: [
        {

            name: "Unidad",
            colorByPoint: true,
            data: [
            <?php
            $consul3="SELECT * FROM unidad WHERE uni_est='1'";
            $conx3= mysqli_query($con,$consul3);
            while ( $cont3= mysqli_fetch_array($conx3)) {
                $idu=$cont3['id_unidad'];
                
                $cu=0;
                $pu=0;
                $ct=0;
                

                $consul4="SELECT * FROM taller t, alumno_taller n, cursos c, alumnos a, usuario u, unidad d , tema e WHERE d.id_unidad=$idu  AND c.id_curso=$id_curso AND t.esta_taller='1' AND u.u_estado='1' AND u.id_usuario=a.alum_usu AND a.alum_seccion=c.id_curso AND c.id_curso=t.curs_taller AND t.id_taller=n.id_taller AND n.id_alumno=u.id_usuario AND t.tema_taller=e.id_tema AND e.id_unidad=d.id_unidad ";
                $conx4= mysqli_query($con,$consul4);
                while ( $cont4= mysqli_fetch_array($conx4)) {
                    $cu=$cu+$cont4['prom_taller'];
                }

                $consul8="SELECT * FROM tema e, unidad u WHERE u.id_unidad=$idu AND e.id_unidad=u.id_unidad ";
                $conx8= mysqli_query($con,$consul8);
                while ( $cont8= mysqli_fetch_array($conx8)) {
                    ++$ct;
                }

                $pu=doubleval('');
                if ($cu>0) {
                    $pu = round((($cu/$ct)/$numrows), 1);
                }else $pu = 0; 

               
                ?>
                {
                    name: <?php echo "'".$cont3['uni_nombre']."',"; ?>
                    y: <?php echo $pu ?>,
                    drilldown: <?php echo "'".$cont3['uni_nombre']."',"; ?>
                },
                
            <?php
            }
            ?>
            ]
        }
    ],

    drilldown: {
        series: [
        <?php
        $consul5="SELECT * FROM unidad  WHERE uni_est='1' ";
        $conx5= mysqli_query($con,$consul5);
        while ( $cont5= mysqli_fetch_array($conx5)) {
            $uni=$cont5['id_unidad'];
        ?>
            {
                name: <?php echo "'".$cont5['uni_nombre']."',"; ?>
                id: <?php echo "'".$cont5['uni_nombre']."',"; ?>
                data: [                
                <?php
                $consul6="SELECT * FROM unidad u, tema t  WHERE u.uni_est='1' AND u.id_unidad='$uni' AND t.id_unidad=u.id_unidad ";
                $conx6= mysqli_query($con,$consul6);
                while ( $cont6= mysqli_fetch_array($conx6)) {
                    $ct=0;
                    $pt=0;
                    $idtem=$cont6['id_tema'];

                    $consul7="SELECT * FROM taller t, alumno_taller n, cursos c, alumnos a, usuario u, unidad d , tema e WHERE  e.id_tema=$idtem  AND c.id_curso=$id_curso AND t.esta_taller='1' AND u.u_estado='1' AND u.id_usuario=a.alum_usu AND a.alum_seccion=c.id_curso AND c.id_curso=t.curs_taller AND t.id_taller=n.id_taller AND n.id_alumno=u.id_usuario AND t.tema_taller=e.id_tema AND e.id_unidad=d.id_unidad ";
                    $conx7= mysqli_query($con,$consul7);
                    while ( $cont7= mysqli_fetch_array($conx7)) {
                        $ct=$ct+$cont7['prom_taller'];
                    }
                    $pt=doubleval('');
                    if ($ct>0) {
                        $pt = round(($ct/$numrows), 1);
                    }else $pt = 0; 
                ?>
                    [
                        <?php echo "'".$cont6['te_nombre']."'";?>,
                        <?php echo $pt; ?>
                    ],
                <?php
                }
                ?>
                       
                ]
            },
            <?php
            }
            ?>         
        ]
    }

});

    
        </script>
