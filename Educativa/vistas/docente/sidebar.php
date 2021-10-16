<?php
    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * from usuario u, docentes d where d.id_usuario=$id AND d.id_usuario=u.id_usuario";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $cargo = $row['doc_cargo'];        
}
?>
<aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="docente.php" aria-expanded="false"><i class="mdi mdi-home"></i><span class="hide-menu">Inicio</span></a></li>
                        <?php 
                        if ($cargo==2) {
                        ?>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="docest.php" aria-expanded="false"><i class="mdi  mdi-school"></i><span class="hide-menu">Cursos</span></a></li>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="promedio.php" aria-expanded="false"><i class="mdi  mdi-chart-line"></i><span class="hide-menu">Promedios</span></a></li>                       

                        <?php 
                        }if ($cargo==1) {
                        
                        ?>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi  mdi-bank"></i><span class="hide-menu">Administrar Cursos</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"> 
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="año_lectivo.php" aria-expanded="false">
                                <i class="mdi  mdi-bank"></i>
                                <span class="hide-menu">Años lectivos</span>
                            </a>
                        </li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="doccurso.php" aria-expanded="false"><i class="mdi  mdi-bank"></i><span class="hide-menu">Cursos Existentes</span></a></li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"href="docasig.php" aria-expanded="false"><i class="mdi  mdi-bank"></i><span class="hide-menu">Asignar Curso</span></a></li>
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-database"></i><span class="hide-menu">Administrar Usuarios </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="directorest.php" class="sidebar-link"><i class="mdi mdi-chair-school"></i><span class="hide-menu"> Estudiantes Registrados </span></a></li>
                                <li class="sidebar-item"><a href="docent.php" class="sidebar-link"><i class="mdi mdi-school"></i><span class="hide-menu"> Docentes Registrados </span></a></li>
                            </ul>
                        </li> 
                        <?php 
                    }
                        ?>   
                        
                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>