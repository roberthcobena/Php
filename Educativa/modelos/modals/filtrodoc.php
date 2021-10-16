<?php
    $id_curso= $_GET['curso'];
    $sql = "SELECT t.id_tema, u.uni_nombre, t.te_nombre FROM unidad u, tema t WHERE t.tem_estado=1 AND t.id_unidad=u.id_unidad";
    $query = mysqli_query($con, $sql);

    $sql1 = "SELECT u.id_usuario, d.apell_user, d.nomb_user FROM usuario u, datos_usuarios d, alumnos a, cursos c WHERE u.id_usuario=d.id_usuario AND a.alum_usu=u.id_usuario AND a.alum_seccion=c.id_curso AND u.u_estado=1 AND c.id_curso=$id_curso ORDER BY d.apell_user ASC";
    $query1 = mysqli_query($con, $sql1);
?>
<div class="modal fade" id="filtrodoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reporte de promedios por temas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="filtro" name="edita_tall1" enctype="multipart/form-data">
                    <!-- Variable oculta -->

                    <div class="form-group row">
                        <label for="tema" class="col-sm-3 text-right control-label col-form-label">Tema: </label>
                        <div class="col-sm-9">
                            <select class="mi-selector form-control" id="tema" name="tema" style="width: 100%;" required>
                                <option value="0">-- Todos los temas --</option>
                                <?php                                  
                                    
                                    while ($row1 = $query->fetch_array()) {
                                        echo "<option value='" . $row1[0] . "'>" . $row1[1] .' ('.$row1[2].")"." </option>";
                                    } // while 
                                    ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alumno" class="col-sm-3 text-right control-label col-form-label">Estudiante: </label>
                        <div class="col-sm-9">
                            <select class="select2 form-control m-t-15" id="alumno" name="alumno" multiple="multiple" style="height: 36px;width: 100%;" required>
                                <option value="">-- Selecciona --</option>
                                <?php
                                    while ($row = $query1->fetch_array()) {
                                        echo "<option value='" . $row[0] . "'>" . $row[1] .' '.$row[2]."</option>";
                                    } // while 
                                    ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="archivo" class="col-sm-3 text-right control-label col-form-label">Formato: </label>
                        <div class="col-sm-9">
                            <select class="mi-selector form-control" id="archivo" name="archivo" style="width: 100%;" required>
                                <option value="1">.PDF</option>
                                <option value="2">.Excel</option>                              
                            </select>
                        </div>
                    </div>

                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="guarda_Tall1">Guardar</button>
                        </div>
                    
                    <div id="resultados_ajax1"></div>
                </form>
        </div>
    </div>
</div> 