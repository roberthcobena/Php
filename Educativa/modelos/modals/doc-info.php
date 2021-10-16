<div class="modal fade" id="docInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar informcacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="edita_doc" name="edita_doc" enctype="multipart/form-data">

                    <input type="hidden" class="form-control" id="m_id" name="m_id" readonly="">

                    
                    <div class="form-group row">
                        <label for="m_cedula" class="col-sm-3 text-right control-label col-form-label">Cedula: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control cedula-inputmask" id="m_cedula" name="m_cedula"  required="" readonly="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_nombre" class="col-sm-3 text-right control-label col-form-label">Nombre: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="m_nombre" name="m_nombre" onkeypress="return check(event)" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_apellido" class="col-sm-3 text-right control-label col-form-label">Apellido: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="m_apellido" name="m_apellido" onkeypress="return check(event)" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_titulo" class="col-sm-3 text-right control-label col-form-label">Titulo: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="m_titulo" name="m_titulo"  required>
                                <option value="">-- Seleccione --</option>
                                <option value="Licenciado(a)">Licenciado(a)</option>
                                <option value="Master">Master</option>
                                <option value="PH">PH</option>
                                <option value="Ingeniero(a)">Ingeniero(a)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_cargo" class="col-sm-3 text-right control-label col-form-label">Cargo: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="m_cargo" name="m_cargo"  required>
                                <option value="">-- Selecciona --</option>
                                <?php
                                    $sql = "SELECT c.id_cargo, c.nom_cargo FROM cargos c WHERE c.est_cargo=1";
                                    $result = $con->query($sql);
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value='" . $row[0] . "'>" . $row[1] ."</option>";
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
                <button type="submit" class="btn btn-primary" id="guarda_Doc">Guardar</button>
            </div>
            <div id="resultados_ajax"></div>
               </form>
        </div>
    </div>
</div>