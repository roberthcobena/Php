<?php
    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * from usuario u, datos_usuarios d, docentes o where u.id_usuario=$id AND d.id_usuario=u.id_usuario AND u.id_usuario=o.id_usuario";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $nombre = $row['nomb_user'];        
        $apellido = $row['apell_user'];
        $cargo = $row['doc_cargo'];
}
?>
<header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="docente.php">
                        <!-- Logo icon -->
                        <b class="logo-icon p-l-10">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../../recursos/tempad/images/logo-icon.png" alt="homepage" class="light-logo" />
                           
                        </b>
                        <!--End Logo icon -->
                         <!-- Logo text -->
                        <span class="logo-text">
                             <!-- dark Logo text -->
                             <img src="../../recursos/tempad/images/logo-text.png" alt="homepage" class="light-logo" />
                            
                        </span>
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon"> -->
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <!-- <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->
                            
                        <!-- </b> -->
                        <!--End Logo icon -->
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                      
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                      
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $nombre . " " . $apellido." ";?><img src="../../recursos/tempad/images/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                
                                <a class="dropdown-item" href="perfil.php"><i class="ti-user m-r-5 m-l-5"></i> Mi Perfil</a>
                                <?php 
                                    if ($cargo==1) {
                                ?>
                                <a class="dropdown-item" href="../../recursos/archivos/Manual - sistema web director.pdf"  target="_blank"><i class="fa fa-question m-r-5 m-l-5"></i> Ayuda</a>
                                <?php
                                    }if ($cargo==2) {
                                ?>
                                <a class="dropdown-item" href="../../recursos/archivos/Manual - sistema web docente.pdf"  target="_blank"><i class="fa fa-question m-r-5 m-l-5"></i> Ayuda</a>
                            <?php } ?>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../../login.php?logout"><i class="fa fa-power-off m-r-5 m-l-5"></i> Cerrar sesion</a>
                                
                                
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>