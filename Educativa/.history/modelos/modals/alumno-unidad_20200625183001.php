<div class="modal fade" id="TodoUnidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles de Unidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="edita_curso" name="edita_curso" enctype="multipart/form-data">
                    <!-- Variable oculta -->
                    <input type="hidden" class="form-control" id="m_id_unidad" name="m_id_unidad" readonly="">

                    <div class="form-group row">                        
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="m_curso" name="m_curso" readonly>                            
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_cod" class="col-sm-3 text-right control-label col-form-label">Código: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="m_cod" name="m_cod" readonly="">                            
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_seccion" class="col-sm-3 text-right control-label col-form-label">Seccion: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="m_seccion" name="m_seccion"  required>
                                <option value="">-- Seleccione --</option>
                                <option value=A>A</option>
                                <option value=B>B</option>                    
                                <option value=C>C</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_jornada" class="col-sm-3 text-right control-label col-form-label">Jornada: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="m_jornada" name="m_jornada"  required>
                                <option value="">-- Selecciona --</option>
                                <?php
                                    $sql = "SELECT j.id_seccion, j.nom_seccion FROM jornadas j WHERE j.est_seccion=1";
                                    $result = $con->query($sql);
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value='" . $row[0] . "'>" . htmlspecialchars($row[1], ENT_QUOTES, 'UTF-8') . "</option>";
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
                            <button type="submit" class="btn btn-primary" id="guarda_Curso">Guardar</button>
                        </div>
                    
                    <div id="resultados_ajax"></div>
                </form>
        </div>
    </div>
</div> 