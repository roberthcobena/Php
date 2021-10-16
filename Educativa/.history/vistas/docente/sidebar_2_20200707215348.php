<?php
    $sql = "SELECT * from cursos c, alumnos a where c.id_curso=$id_curso AND c.id_curso=a.alum_seccion";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $cargo = $row['doc_cargo'];        
}
?>
<aside class="left-sidebar" data-sidebarbg="skin2">
    <!-- Sidebar scroll-->
    <div class="content-row">
        <h4>Estudiantes registrados</h4>
        <table>
            <thead>
                <th>Hola</th>
            </thead>
        </table>
        <!-- <img src="../../recursos/img/logo_cole.png" alt="" width=100% height=100% style="border-radius: 8px;border: 1px solid #ddd; border-radius: 4px; padding: 5px;"> -->
        
    </div>            
</aside>