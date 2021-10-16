<div class="modal fade" id="asigInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar informcacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="edita_asig" name="edita_asig" enctype="multipart/form-data">

                    <input type="hidden" class="form-control" id="m_id" name="m_id" readonly="">

                    <div class="form-group row">
                        <label for="m_docente" class="col-sm-3 text-right control-label col-form-label">Docente: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="m_docente" name="m_docente"  required>
                                <option value="">-- Selecciona --</option>
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
                        <label for="m_curso" class="col-sm-3 text-right control-label col-form-label">Curso: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="m_curso" name="m_curso" readonly>
                                <option value="">-- Selecciona --</option>
                                <?php
                                    $sql = "SELECT c.id_curso, c.nom_curso, c.sec_curso, j.nom_seccion FROM cursos c, jornadas j WHERE c.est_curso=1 AND c.jornada=j.id_seccion";
                                    $result = $con->query($sql);
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value='" . $row[0] . "'>" . $row[1] .' "'.$row[2].'" '."(".$row[3].")"."</option>";
                                    } // while 
                                    ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_estado" class="col-sm-3 text-right control-label col-form-label">Estado: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="m_estado" name="m_estado"  required>
                                <option value="">-- Seleccione --</option>
                                <option value=1>Activo</option>
                                <option value=2>Inactivo</option> 
                            </select>
                        </div>
                    </div>

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="guarda_Asig">Guardar</button>
            </div>
            <div id="resultados_ajax"></div>
               </form>
        </div>
    </div>
</div>