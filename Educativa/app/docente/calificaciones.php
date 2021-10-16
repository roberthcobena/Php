<?php   
    session_start();
    if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../login.php");
        exit;
        }   
    /* Connect To Database*/
    require_once ("../../controladores/conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../../controladores/conexion/conexion.php");//Contiene funcion que conecta a la base de datos

    $id_curso= $_GET['curso'];
    $sql = "SELECT * FROM cursos c, jornadas j WHERE c.id_curso=$id_curso AND c.jornada=j.id_seccion";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $curso = $row['nom_curso'];
        $jornada = $row['nom_seccion'];
    }
    
    $usuario="Curso | " . $curso;
?>
<!DOCTYPE html>
<html dir="ltr" lang="es">

  <head>
    <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../recursos/tempad/images/favicon.png">
    <title><?php echo $usuario?></title>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../../recursos/app/vendor/select2/dist/css/select2.min.css">
    <style type="text/css">
.highcharts-figure, .highcharts-data-table table {
    min-width: 310px; 
    max-width: 800px;
    margin: 1em auto;
}

#container {
    height: 400px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #EBEBEB;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

</style>
    <link href="../../recursos/tempad/css/stile.css" rel="stylesheet">
    <script src="../../recursos/app/vendor/jquery/jquery.min.js"></script>
    
</head>

<body> 
<script src="../../recursos/app/vendor/highcharts/code/highcharts.js"></script>
<script src="../../recursos/app/vendor/highcharts/code/modules/data.js"></script>
<script src="../../recursos/app/vendor/highcharts/code/modules/drilldown.js"></script>
<script src="../../recursos/app/vendor/highcharts/code/modules/exporting.js"></script>
<script src="../../recursos/app/vendor/highcharts/code/modules/export-data.js"></script>
<script src="../../recursos/app/vendor/highcharts/code/modules/accessibility.js"></script>   
<div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper">
        <?php
        include "../../vistas/docente/header_2.php";
        ?>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title"><?php echo $curso . "-Jornada ". $jornada;  ?></h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="docente.php">Aula</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Calificaciones</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Promedio de Unidad</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Promedio de estudiantes</span></a> </li>
                            </ul>
                            <div class="card-body">
                                <?php
                                    include("../../modelos/modals/filtrodoc.php");
                                    ?>
                                               
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane active" id="home" role="tabpanel">
                                        <form class="form-horizontal" role="form" id="usuarios">                                    
                                            <div class="form-group row">
                                                <button type="button" class="col-md- btn btn-tool btn-secondary" title="Refrescar" onclick="load(1);"><i class="fas fa-sync-alt"></i> Actualizar</button>

                                                <div class="col-md-6">
                                                    <input type="hidden" value="<?php echo $id_curso;?>" id="idcurso">
                                                </div>

                                                <div class="col-md-3">                      
                                                    <span id="loader"></span>
                                                </div>

                                                <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-download"></i> Descargar
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <a class="dropdown-item" href="#" title='Descargar reporte' onclick="imprimir_reporteU('<?php echo $id_curso;?>');"><i class="fas fa-file-pdf"></i> Reporte PDF</a>
                                                <a class="dropdown-item" href="#" title='Descargar reporte' onclick="imprimir_excelU('<?php echo $id_curso;?>');"><i class="fas fa-file-excel"></i> Reporte Excel</a>
                                                </div>
                                                </div>
                                                 <button type="button" class="btn btn-tool btn-primary" title='Imprimir' data-toggle="modal" data-target="#filtrodoc"><i class="nav-icon fas fa-plus"></i> Imprimir reporte</button>

                                                

                                            </div>                                    
                                    </form>

                                    <div id="resultados"></div><!-- Carga los datos ajax -->
                                    <div class='outer_div'></div><!-- Carga los datos ajax -->
                                    <hr>

                                    <?php
                                    include("../../modelos/tablas/filtroT.php");
                                    ?>
                                </div>

                                <!-- TAB2 -->

                                <div class="tab-pane  p-20" id="profile" role="tabpanel">
                                    
                                        <form class="form-horizontal" role="form" id="usuarios">                                    
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                <button type="button" class="col-md- btn btn-tool btn-secondary" title="Refrescar" onclick="carga(1);"><i class="fas fa-sync-alt"></i> Actualizar</button>
                                                </div>
                                                

                                                <div class="col-md-6">
                                                    <div class="row">
                                                    <label for="q" class="col-md-3 control-label">Buscar Alumno:</label>
                                                    <input type="text" class="col-md-7 form-control" id="q" placeholder="Ingrese nombre o apellido del estudiante" onkeyup='carga(1);'>
                                                    <input type="hidden" value="<?php echo $id_curso;?>" id="idcurso">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">                      
                                                    <span id="loader1"></span>
                                                </div>

                                                <div class="btn-group" role="group">
                                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-download"></i> Descargar
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <a class="dropdown-item" href="#" title='Descargar reporte' onclick="imprimir_reporte('<?php echo $id_curso;?>');"><i class="fas fa-file-pdf"></i> Reporte PDF</a>
                                                <a class="dropdown-item" href="#" title='Descargar reporte' onclick="imprimir_excel('<?php echo $id_curso;?>');"><i class="fas fa-file-excel"></i> Reporte Excel</a>
                                                </div>
                                                </div>

                                            </div>                                    
                                        </form>
                                    <div id="resultados"></div><!-- Carga los datos ajax -->
                                    <div class='outer_div1'></div><!-- Carga los datos ajax -->
                                    
                                </div>

                                </div>



                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="card">
                            <div class="card-body">
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
                                <h5 class="card-title">Estudiantes registrados: <?php echo $numrows;?></h5>
                                <table>
                                    <tr>
                                    <?php                
                                        while ($row = mysqli_fetch_array($query)) {
                                            ++$contador;
                                            $nom_alumno = $row['nomb_user'];        
                                            $ape_alumno = $row['apell_user'];        
            
                                    ?>
                                        <th><?php echo $contador ."- " . $ape_alumno . " " . $nom_alumno;?></th>
                                    </tr>
                                    <?php }?>
                                </table>
                            </div>
                        </div>
                    </div>
                    
           
                    
                </div>
            </div>
            <?php
            include "../../vistas/admin/footer.php";
            ?>
        </div>
    </div>
    <script type="text/javascript" src="../../controladores/js/notas.js"></script>
    <script type="text/javascript" src="../../controladores/js/VentanaCentrada.js"></script> 

    <script src="../../recursos/app/vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../recursos/app/vendor/popper.js/umd/popper.min.js"></script>
    <script src="../../recursos/app/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../recursos/app/vendor/perfect-scrollbar/perfect-scrollbar.jquery.min.js"></script>
    <script src="../../recursos/app/vendor/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../../recursos/tempad/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../recursos/tempad/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../../recursos/tempad/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="../../recursos/app/vendor/DataTables/datatables.min.js"></script>
    <script src="../../recursos/app/vendor/toastr/build/toastr.min.js"></script>
    <script src="../../recursos/app/vendor/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="../../recursos/tempad/js/pages/mask/mask.init.js"></script>
    <script src="../../recursos/app/vendor/select2/dist/js/select2.min.js"></script>

    <script src="../../recursos/app/vendor/datetimepicker/moment-with-locales.min.js"></script>
    <script src="../../recursos/app/vendor/datetimepicker/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="../../recursos/app/vendor/checkall/jquery.checkboxall-1.0.min.js"></script>
    <script>
        $(".select2").select2();

        $('.temas').checkboxall();
        
        $('.estudiantes').checkboxall();
    </script>
    

</body>

</html>