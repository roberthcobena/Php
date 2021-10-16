<?php   
    session_start();
    $id = $_SESSION['id_usuario'];
    
    if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../login.php");
        exit;
        }   
    /* Connect To Database*/
    require_once ("../../controladores/conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../../controladores/conexion/conexion.php");//Contiene funcion que conecta a la base de datos

    $sql = "SELECT * from usuario u, datos_usuarios d where u.id_usuario=$id AND d.id_usuario=u.id_usuario";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($query)) {
            $estudiante = $row['apell_user'] . " " .$row['nomb_user'];        
}

    $id_taller= $_GET['id_taller'];
    $sql = "SELECT * FROM taller t, tema e, unidad u WHERE t.id_taller=$id_taller AND t.tema_taller=e.id_tema AND e.Id_unidad=u.id_unidad";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $taller = $row['nom_taller'];
        $tema = $row['te_nombre']." / ".$row['uni_nombre'];
        $id_curso = $row['curs_taller'];
    }
    
    $usuario="taller | " . $taller;
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

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
    <link href="../../recursos/tempad/css/stile.css" rel="stylesheet">
    <script src="../../recursos/app/vendor/jquery/jquery.min.js"></script>
    <link href="../../recursos/app/vendor/datetimepicker/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">
</head>

<body>    
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
                        <h4 class="page-title"><?php echo $taller ." (". $tema .")" ;  ?></h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Aula</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Curso</li>
                                    <li class="breadcrumb-item active" aria-current="page">Taller</li>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-tools">                            
                                <H2>RESULTADOS OBTENIDOS</H2><button type="button" class="btn btn-tool" title="Refrescar" onclick="load(1);"><i class="fas fa-sync-alt"></i> Actualizar</button>                                                  
                            </div>
                            <div class="card-body">                                
                                    <form class="form-horizontal" role="form" id="usuarios">                                    
                                            <div class="form-group row">
                                                <!-- <label for="q" class="col-md-2 control-label">Buscar x Pregunta</label> -->
                                                <div class="col-md-7">
                                                    <input type="hidden" style="border: 2px solid blue;" class="form-control" id="q" placeholder="Escriba pregunta" onkeyup='load(1);'>
                                                    <input type="hidden" value="<?php echo $id_taller;?>" id="idtaller">
                                                </div>
                                                <div class="col-md-3">                      
                                                    <span id="loader"></span>
                                                </div>
                                            </div>                                    
                                    </form>
                                    <div id="resultados"></div><!-- Carga los datos ajax -->
                                    <div class='outer_div'></div><!-- Carga los datos ajax -->
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
    <script type="text/javascript" src="../../controladores/js/resultados_alumno.js"></script>

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
    <script type="text/javascript">
    $(function () {
    

        $('#datetimepicker7').datetimepicker({ 
        locale: 'es',
        icons: {
                    time: "fas fa-clock",
                },
        format: 'YYYY-MM-DD HH:mm:ss'
         });
        $('#datetimepicker8').datetimepicker({
            locale: 'es',
            icons: {
                    time: "fas fa-clock",
                    },
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false

        });
        $("#datetimepicker7").on("change.datetimepicker", function (e) {
            $('#datetimepicker8').datetimepicker('minDate', e.date);
        });
        $("#datetimepicker8").on("change.datetimepicker", function (e) {
            $('#datetimepicker7').datetimepicker('maxDate', e.date);
        });

        $('#datetimepicker1').datetimepicker({ 
        locale: 'es',
        icons: {
                    time: "fas fa-clock",
                },
        format: 'YYYY-MM-DD HH:mm:ss'
         });
        $('#datetimepicker2').datetimepicker({
            locale: 'es',
            icons: {
                    time: "fas fa-clock",
                    },
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false

        });
        $("#datetimepicker1").on("change.datetimepicker", function (e) {
            $('#datetimepicker2').datetimepicker('minDate', e.date);
        });
        $("#datetimepicker2").on("change.datetimepicker", function (e) {
            $('#datetimepicker1').datetimepicker('maxDate', e.date);
        });
    });
</script>

</body>

</html>