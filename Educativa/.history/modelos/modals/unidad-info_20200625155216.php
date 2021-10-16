<div class="modal fade" id="uniInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informacion de la unidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="nuevo_curso" name="nuevo_curso" enctype="multipart/form-data">
                    <!-- Variable oculta -->
                    <input type="hidden" class="form-control" id="m_id" name="m_id" readonly="">

                    
                    <div class="form-group row">
                        <label for="m_unidad" class="col-sm-3 text-right control-label col-form-label">Unidad: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="m_unidad" name="m_unidad" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_descripcion" class="col-sm-3 text-right control-label col-form-label">Descripcion: </label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="m_descripcion" name="m_descripcion" required=""></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_portada" class="col-sm-3 text-right control-label col-form-label">Portada: </label>
                        <div class="col-sm-9">
                            <img id="m_portada" name="m_portada" src="" alt="Sin logo" class="img-responsive" height=auto width=50%>
                            <input type="file" class="form-control" id="portada_info" name="portada_info" required />
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="guarda_Unidad">Guardar</button>
            </div>
        </div>
    </div>
</div> 