<?php   
    session_start();
    if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../login.php");
        exit;
        }   
    /* Connect To Database*/
    require_once ("../controladores/conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../controladores/conexion/conexion.php");//Contiene funcion que conecta a la base de datos
    $usuario="Administrador | Temas";
?>
<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../recursos/tempad/images/favicon.png">
    <title><?php echo $usuario?></title>
    <!-- Custom CSS -->
    <link href="../recursos/tempad/css/style.min.css" rel="stylesheet">
    <script src="../recursos/app/vendor/jquery/jquery.min.js"></script>
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
        include "../vistas/admin/header.php";
        ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php
            include "../vistas/admin/sidebar.php";
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
                        <h4 class="page-title">Unidades & Temas</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin.php">Inicio</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Temas</li>
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
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btn-primary" title='Añadir' data-toggle="modal" data-target="#temaNew"><i class="nav-icon fas fa-plus"></i> Añadir </button>
                                <button type="button" class="btn btn-tool btn-secondary" title="Refrescar" onclick="load(1);"><i class="fas fa-sync-alt"></i> Actualizar</button>                  
                            </div>

                            <div class="card-body">
                                <?php
                                include("../modelos/modals/tema-new.php");
                                include("../modelos/modals/tema-info.php");
                                ?>
                                <form class="form-horizontal" role="form" id="unidades">
                                    <center>
                                        <div lass="form-group row">
                                            <label for="q" class="col-md-2 control-label">Buscar</label>

                                            <div class="col-md-7">
                                                <input type="text" class="form-control" id="q" placeholder="Ingrese nombre del tema" onkeyup='load(1);'>
                                            </div>

                                            <div class="col-md-3">                      
                                                <span id="loader"></span>
                                            </div>

                                        </div>
                                    </center>
                                </form>

                                <div id="resultados"></div><!-- Carga los datos ajax -->
                                <div class='outer_div'></div><!-- Carga los datos ajax -->

                            </div>

                        </div>
                    </div>
                        
                    </div>

                </div>
                <!-- row -->

                <!-- modal -->
               
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
                     <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php
            include "../vistas/admin/footer.php";
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
    <script type="text/javascript" src="../controladores/js/tema.js"></script> 

    
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../recursos/app/vendor/popper.js/umd/popper.min.js"></script>
    <script src="../recursos/app/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../recursos/app/vendor/perfect-scrollbar/perfect-scrollbar.jquery.min.js"></script>
    <script src="../recursos/app/vendor/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../recursos/tempad/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../recursos/tempad/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../recursos/tempad/js/custom.min.js"></script>

    <script src="../recursos/app/vendor/toastr/build/toastr.min.js"></script>
</body>

</html>