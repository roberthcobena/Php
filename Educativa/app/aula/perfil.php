<?php   
    session_start();
    if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../login.php");
        exit;
        }   
    /* Connect To Database*/
    require_once ("../../controladores/conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../../controladores/conexion/conexion.php");//Contiene funcion que conecta a la base de datos
    $usuario="Estudiante | Perfil";
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
    <link href="../../recursos/tempad/css/style.min.css" rel="stylesheet">
    <link href="../../recursos/tempad/css/icons/font-awesome/css/fontawesome.css" rel="stylesheet">
    <script src="../../recursos/app/vendor/jquery/jquery.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php
        include "../../vistas/alumno/header.php";
        ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php
            include "../../vistas/alumno/sidebar.php";
        ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Perfil</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="estudiante.php">Inicio</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php
            include "../../vistas/alumno/perfil_alumno.php";
            include "../../vistas/alumno/footer.php";
            ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../../controladores/js/perfil_alumno.js"></script>
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
    <script src="../../recursos/app/vendor/datetimepicker/moment-with-locales.min.js"></script>
    <script src="../../recursos/app/vendor/datetimepicker/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="../../recursos/app/vendor/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="../../recursos/tempad/js/pages/mask/mask.init.js"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>

</body>

</html>