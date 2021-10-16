<?php   
    session_start();
    if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../../login.php");
        exit;
        }   
    /* Connect To Database*/
    require_once ("../../controladores/conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../../controladores/conexion/conexion.php");//Contiene funcion que conecta a la base de datos
    $usuario="Docente | Sistema académico";
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
        include "../../vistas/alumno/header.php";
        ?>        
        <?php
            include "../../vistas/alumno/sidebar.php";
        ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Curso actual</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Curso</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-9">
                        <div class="card">
                            
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" title="Refrescar" onclick="load(1);"><i class="fas fa-sync-alt"></i> Actualizar</button>                  
                            </div>

                            <div class="card-body">
                                
                                <form class="form-horizontal" role="form" id="usuarios">
                                    <center>
                                        <div lass="form-group row">                                           

                                            <div class="col-md-7">
                                                <input type="hidden" class="form-control" id="q" placeholder="" onkeyup='load(1);'>
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

                    <div class="col-md-3">
                    <div class="card">
                            <div class="card-body">
                                <?php
                                    $contador=0;                
                                    $sTable = "cursos c, docentes d, datos_usuarios du, doc_curso dc, usuario u, cargos cr"; 
                                    $sWhere = " WHERE c.id_curso=dc.id_curso AND dc.id_docente=d.id_docente AND d.id_usuario=u.id_usuario AND d.doc_cargo=cr.id_cargo AND du.id_usuario=u.id_usuario";                                    
                                    $sql="SELECT * FROM  $sTable $sWhere";
                                    $query = mysqli_query($con, $sql);
                                ?>
                                <h5 class="card-title">Docente:</h5>
                                <table>
                                    <tr>
                                    <?php                
                                        while ($row = mysqli_fetch_array($query)) {
                                            ++$contador;
                                            $tit_docente = $row['doc_titulo'];        
                                            $nom_docente = $row['nomb_user'];        
                                            $ape_docente = $row['apell_user'];        
            
                                    ?>
                                        <th><?php echo $tit_docente ." " . $nom_docente . " " . $ape_docente;?></th>
                                    </tr>
                                    <?php }?>
                                </table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <?php
                                    $contador=0;                
                                    $sTable = "cursos c, alumnos a, datos_usuarios dc"; 
                                    $sWhere = " WHERE a.alum_usu!=$id AND c.id_curso=a.alum_seccion AND a.alum_usu=dc.id_usuario";
                                    $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
                                    $row= mysqli_fetch_array($count_query);
                                    $numrows = $row['numrows'];
                                    $sql="SELECT * FROM  $sTable $sWhere";
                                    $query = mysqli_query($con, $sql);
                                ?>
                                <h5 class="card-title">Usuarios: <?php echo $numrows;?></h5>
                                <table>
                                    <tr>
                                    <?php                
                                        while ($row = mysqli_fetch_array($query)) {
                                            ++$contador;
                                            $nom_alumno = $row['nomb_user'];        
                                            $ape_alumno = $row['apell_user'];        
            
                                    ?>
                                        <th><?php echo $contador ."- " . $nom_alumno . " " . $ape_alumno;?></th>
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
    <script type="text/javascript" src="../../controladores/js/alumest.js"></script> 
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
    <script src="../../recursos/app/vendor/DataTables/datatables.min.js"></script>

    <script src="../../recursos/app/vendor/toastr/build/toastr.min.js"></script>

</body>

</html>