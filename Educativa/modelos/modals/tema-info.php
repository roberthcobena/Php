<div class="modal fade" id="temaInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informacion del tema</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="edita_tema" name="edita_tema" enctype="multipart/form-data">
                    <!-- Variable oculta -->
                    <input type="hidden" class="form-control" id="m_id" name="m_id" readonly="">

                    <div class="form-group row">
                        <label for="m_unidad" class="col-sm-3 text-right control-label col-form-label">Unidad: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="m_unidad" name="m_unidad"  required>
                                <option value="">-- Selecciona --</option>
                                <?php
                                    $sql = "SELECT u.id_unidad, u.uni_nombre FROM unidad u WHERE u.uni_est=1";
                                    $result = $con->query($sql);
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value='" . $row[0] . "'>" . htmlspecialchars($row[1], ENT_QUOTES, 'UTF-8') . "</option>";
                                    } // while 
                                    ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="m_unidad" class="col-sm-3 text-right control-label col-form-label">Tema: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="m_tema" name="m_tema" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_descripcion" class="col-sm-3 text-right control-label col-form-label">Descripcion: </label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="m_descripcion" name="m_descripcion" required=""></textarea>
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
                <button type="submit" class="btn btn-primary" id="guarda_tema">Guardar</button>
            </div>
            <div id="resultados_ajax"></div>
               </form>
        </div>
    </div>
</div> 