<?php	
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../login.php");
		exit;
        }	
	/* Connect To Database*/
	require_once ("../controladores/conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../controladores/conexion/conexion.php");//Contiene funcion que conecta a la base de datos
	$usuario="Administrador | Cursos";
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../recursos/tempad/images/favicon.png">
    <title><?php echo $usuario?></title>
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
                        <h4 class="page-title">Cursos & Jornadas</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="admin.php">Inicio</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Cursos</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="container-fluid">
                <div class="row">                    
                    <div class="col-md-8">                       
                        <div class="card">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Secciones</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"></span> <span class="hidden-xs-down">Jornadas</span></a> </li>
                            </ul>
                        </div> 

                            <div class="tab-content tabcontent-border">
                                <div class="tab-pane active p-20" id="home" role="tabpanel">
                                <div class="p-20 row">
                                    <div class="col-md-2"></div>
                                    <div class=" col-md-8 ">
                                        <?php 
                                        include "../modelos/tablas/curso.php"
                                        ?>
                                    </div>                                    
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-success margin-5" data-toggle="modal" data-target="#Modal1">
                                                Agregar curso
                                        </button>
                                            <br>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                                    
                                </div>
                                
                                <div class="tab-pane  p-20" id="profile" role="tabpanel">
                                    <div class="p-20 row">

                                    <div class="col-md-2"></div>
                                    <div class=" col-md-8 ">
                                        <?php 
                                        include "../modelos/tablas/jorna.php"
                                        ?>
                                    </div>
                                    <div class="col-md-2"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5"></div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-success margin-5" data-toggle="modal" data-target="#Modal2">
                                                Agregar jornada
                                            </button>
                                            <br>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </div>


                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"> </div>
                </div>
                <?php 
                    include "../modelos/modals/modal.php"
                ?>
            </div>            
            <?php
            include "../vistas/admin/footer.php";
            ?>            
        </div>        
    </div>    
    <script src="../recursos/app/vendor/jquery/jquery.min.js"></script>
    <script src="../recursos/app/vendor/popper.js/umd/popper.min.js"></script>
    <script src="../recursos/app/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../recursos/app/vendor/perfect-scrollbar/perfect-scrollbar.jquery.min.js"></script>
    <script src="../recursos/app/vendor/sparkline/sparkline.js"></script>
    <script src="../recursos/tempad/js/waves.js"></script>
    <script src="../recursos/tempad/js/sidebarmenu.js"></script>
    <script src="../recursos/tempad/js/custom.min.js"></script>
    <script src="../recursos/app/vendor/toastr/build/toastr.min.js"></script>
    <script src="../recursos/app/vendor/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="../recursos/tempad/js/pages/mask/mask.init.js"></script>
</body>
</html>