<?php
    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * from usuario u, datos_usuarios d where u.id_usuario=$id AND d.id_usuario=u.id_usuario";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $nombre = $row['nomb_user'];        
        $apellido = $row['apell_user'];
}
?>
<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <ul class="navbar-nav float-left mr-auto">
                <a class="dropdown-item" href="perfil.php"><i class="ti-user m-r-5 m-l-5"></i> < Regresar </a>
            </ul>
            <ul class="navbar-nav float-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $nombre . " " . $apellido." ";?><img src="../../recursos/tempad/images/1.jpg" alt="user" class="rounded-circle" width="31"></a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        
                        <a class="dropdown-item" href="perfil.php"><i class="ti-user m-r-5 m-l-5"></i> Mi Perfil</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../../login.php?logout"><i class="fa fa-power-off m-r-5 m-l-5"></i> Cerrar sesion</a>
                        
                        
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>