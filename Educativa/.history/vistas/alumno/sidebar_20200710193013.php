<?php
    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * from alumnos where alum_usu = $id and alum_estado=1 ";
    $query = mysqli_query($con, $sql);
    $chek=mysqli_num_rows($query);
?>
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <?php 
                if($chek > 0){
                ?>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="estudiante.php" aria-expanded="false"><i class="mdi mdi-home"></i><span class="hide-menu">Inicio</span></a></li>               
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="unidades.php" aria-expanded="false"><i class="mdi mdi-book"></i><span class="hide-menu">Unidades</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" aria-expanded="false"><i class="mdi mdi-seal"></i><span class="hide-menu">Notas</span></a></li>
                <?php 
            }else{
                ?>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="estudiante.php" aria-expanded="false"><i class="mdi mdi-home"></i><span class="hide-menu">Inicio</span></a></li>               
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="inscri.php" aria-expanded="false"><i class="mdi mdi-chair-school"></i><span class="hide-menu">Inscripcion</span></a></li>
                <?php 
            }
                ?>
            </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>