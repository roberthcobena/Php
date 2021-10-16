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
    $sql = "SELECT * FROM cursos c WHERE c.id_curso=$id_curso";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $curso = $row['nom_curso'];                
    }
    
    $usuario="Curso | " . $curso;
?>
<!DOCTYPE html>
<html lang="en">

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
    <link href="../../recursos/tempad/css/style.min.css" rel="stylesheet">
    <script src="../../recursos/app/vendor/jquery/jquery.min.js"></script>
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
        <?php
            include "../../vistas/docente/sidebar_2.php";
        ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title"><?php echo $curso ?></h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="docente.php">Aula</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Curso</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" title='Añadir' data-toggle="modal" data-target="#asigNew"><i class="nav-icon fas fa-plus"></i> Añadir taller</button>
                                <button type="button" class="btn btn-tool" title="Refrescar" onclick="load(1);"><i class="fas fa-sync-alt"></i> Actualizar</button>                  
                            </div>

                            <div class="card-body">
                                <?php
                                include("../modelos/modals/taller-new.php");
                                include("../modelos/modals/taller-info.php");
                                ?>
                                <form class="form-horizontal" role="form" id="usuarios">
                                    <center>
                                        <div lass="form-group row">
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
                        
                    </div>

                </div>
            <?php
            include "../../vistas/admin/footer.php";
            ?>
        </div>
    </div>
    <script type="text/javascript" src="../../controladores/js/aula.js"></script> 

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
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        
    </script>

</body>

</html>