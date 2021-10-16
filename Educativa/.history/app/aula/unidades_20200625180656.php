<?php	
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../login.php");
		exit;
        }	
	/* Connect To Database*/
	require_once ("../../controladores/conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../../controladores/conexion/conexion.php");//Contiene funcion que conecta a la base de datos
    $usuario="Estudiante | Cursos";
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../../recursos/tempad/images/favicon.png">
    <title><?php echo $usuario?></title>
    <link href="../../recursos/tempad/css/style.min.css" rel="stylesheet"> 
    <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>   
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
        include "../../vistas/alumno/header.php";        
        include "../../vistas/alumno/sidebar.php";
        ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Unidades</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin.php">Inicio</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Unidades</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>            
            <!-- CONTENIDO PRINCIPAL -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">                            
                        <div class="card">                        
                            
                            <div class="card-tools">
                                <?php $id = $_SESSION['id_usuario'];?>                                
                                <button type="button" class="btn btn-tool" title="Refrescar" onclick="load(1);"><i class="fas fa-sync-alt"></i> Actualizar</button>                  
                            </div>

                            <div class="card-body">
                                <?php
                                    include("../../modelos/modals/alumno-unidad.php");                                    
                                ?>
                                
                                <form class="form-horizontal" role="form" id="cursos">
                                 
                                </form>
                                
                                <div id="resultados"></div><!-- Carga los datos ajax -->
                                <div class='outer_div'></div><!-- Carga los datos ajax -->

                            </div>
                        </div>
                    </div>
                </div>                
            </div>            
            <?php
            include "../../vistas/alumno/footer.php";
            ?>            
        </div>        
    </div>
    <!-- Javascript para carga de tabla-->
    <script type="text/javascript" src="../../controladores/js/unidad_alumno.js"></script>    
    
    <!-- scripts del template -->
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
    <script>        
        $('#zero_config').DataTable();
    </script>
</body>
</html>