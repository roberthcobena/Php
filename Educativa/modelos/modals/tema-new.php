<div class="modal fade" id="temaNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Tema</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="nuevo_tema" name="nuevo_tema" enctype="multipart/form-data">
                    
                    <div class="form-group row">
                        <label for="unidad" class="col-sm-3 text-right control-label col-form-label">Unidad: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="unidad" name="unidad"  required>
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
                        <label for="tema" class="col-sm-3 text-right control-label col-form-label">Tema: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="tema" name="tema" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="descripcion" class="col-sm-3 text-right control-label col-form-label">Descripcion: </label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="descripcion" name="descripcion" required=""></textarea>
                        </div>
                    </div>

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="nuevo_Tema">Guardar</button>
            </div>
            <div id="resultados_ajax_n"></div>
                </form>
        </div>
    </div>
</div>            