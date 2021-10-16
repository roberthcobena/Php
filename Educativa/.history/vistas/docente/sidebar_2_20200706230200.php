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
                <img src="../../recursos/img/logo_cole.png" alt="" width=100% height=100%>
            </div>
            <!-- End Sidebar scroll-->
        </aside>