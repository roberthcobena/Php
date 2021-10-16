<div class="modal fade" id="userInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar informcacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="edita_usuario" name="edita_usuario" enctype="multipart/form-data">

                    <input type="hidden" class="form-control" id="m_id" name="m_id" readonly="">

                    <div class="form-group row">
                        <label for="m_nombre" class="col-sm-3 text-right control-label col-form-label">Nombre: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="m_nombre" name="m_nombre" onkeypress="return check(event)" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_apellido" class="col-sm-3 text-right control-label col-form-label">Apellido: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="m_apellido" name="m_apellido" onkeypress="return check(event)" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_telf" class="col-sm-3 text-right control-label col-form-label">Telefono: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control cell-inputmask"  id="m_telf" name="m_telf" onkeypress="return checknum(event)" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_correo" class="col-sm-3 text-right control-label col-form-label">Correo: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control email-inputmask" id="m_correo" name="m_correo" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_tipo" class="col-sm-3 text-right control-label col-form-label">Tipo usuario: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="m_tipo" name="m_tipo" readonly>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="m_usuario" class="col-sm-3 text-right control-label col-form-label">Usuario: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="m_usuario" name="m_usuario" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_clave" class="col-sm-3 text-right control-label col-form-label">Clave: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="m_clave" name="m_clave" required>
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
                <button type="submit" class="btn btn-primary" id="guarda_User">Guardar</button>
            </div>

            <div id="resultados_ajax"></div>
              </form>
        </div>

    </div>
</div>         