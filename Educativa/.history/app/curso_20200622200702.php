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
            <!-- CONTENIDO PRINCIPAL -->
            <div class="container-fluid">
                <div class="row">                    
                    <div class="col-md-12">                       
                        <div class="card">
                            <div class="card-tools">
                                <button style="display:<?php echo $aut_rol; ?>;" type="button" class="btn btn-tool" title='Añadir' onclick="nuevo();" data-toggle="modal" data-target="#new-contratista"><i class="nav-icon fas fa-plus"></i> Añadir </button>
                                <button type="button" class="btn btn-tool" title="Refrescar" onclick="load(1);"><i class="fas fa-sync-alt"></i> Refrescar</button>                  
                            </div>
                        </div> 

                    <div class="card-body table-responsive p-0" ></br>
                    <?php
                        include("../../modelos/modals/curso-new.php");
                        include("../../modelos/modals/curso-info.php");                  
                    ?>                
                <form class="form-horizontal" role="form" id="cursos">
                <center>
                <div class="form-group row"> 
                  <label for="q" class="col-md-2 control-label">Buscar</label>                                     
                    <div class="col-md-7">
                      <input type="text" class="form-control" id="q" placeholder="" onkeyup='load(1);'>
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
                    <div class="col-md-2"> </div>
                </div>                
            </div>            
            <?php
            include "../vistas/admin/footer.php";
            ?>            
        </div>        
    </div>
    <!-- Javascript-->
    <script type="text/javascript" src="../controladores/js/cursos.js"></script>    
    <!-- Otros scripts -->
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