<?php	
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../login.php");
		exit;
        }	
	/* Connect To Database*/
	require_once ("../controladores/conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../controladores/conexion/conexion.php");//Contiene funcion que conecta a la base de datos
	$usuario="Administrador | Colegio Cuenca";
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

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
            include "../vistas/admin/header.php";        
            include "../vistas/admin/sidebar.php";
            ?>        
        <div class="page-wrapper">            
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Inicio</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin.php">Inicio</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>            
            <?php
            //CONTENIDO DE LA SECCIÓN
            include "../vistas/info.php";

            include "../vistas/admin/footer.php";
            ?>            
        </div>        
    </div>
    
    <script src="../recursos/app/vendor/jquery/jquery.min.js"></script>
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
</body>

</html>