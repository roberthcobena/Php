<div class="modal fade" id="asigNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva Asignacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="nueva_asig" name="nueva_asig" enctype="multipart/form-data">

                    <div class="form-group row">
                        <label for="docente" class="col-sm-3 text-right control-label col-form-label">Docente: </label>
                        <div class="col-sm-9">
                            <select class="mi-selector form-control" id="docente" name="docente" style="width: 100%;" required>
                                <option value="" selected="">-- Selecciona --</option>
                                <?php
                                    $sql1 = "SELECT o.id_docente, d.nomb_user, d.apell_user FROM usuario u, datos_usuarios d, docentes o WHERE o.doc_estado=1 AND o.id_usuario=u.id_usuario AND u.id_usuario=d.id_usuario";
                                    $result1 = $con->query($sql1);
                                    while ($row1 = $result1->fetch_array()) {
                                        echo "<option value='" . $row1[0] . "'>" . $row1[1] .' '.$row1[2]."</option>";
                                    } // while 
                                    ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="curso" class="col-sm-3 text-right control-label col-form-label">Curso: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="curso" name="curso" required>
                                <option value="">-- Selecciona --</option>
                                <?php
                                    $sql = "SELECT c.id_curso, c.nom_curso, c.sec_curso, j.nom_seccion, a.anio FROM cursos c, jornadas j, anios_lectivos a WHERE c.est_curso=1 AND c.jornada=j.id_seccion AND a.id=c.an_lec";
                                    $result = $con->query($sql);
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value='" . $row[0] . "'>" . $row[1] .' "'.$row[2].'" '."(".$row[3].") - (".$row[4].")"."</option>";
                                    } // while 
                                    ?>
                            </select>
                        </div>
                    </div>

                    

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="nueva_Asig">Guardar</button>
            </div>
            <div id="resultados_ajax_n"></div>
               </form>
        </div>
    </div>
</div>