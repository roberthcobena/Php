<div class="modal fade" id="cursoNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Curso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Curso: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="fname" value="7mo" readonly="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nueva seccion: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="m_estado" name="m_estado" data-validation="required" data-validation-error-msg="Seleccione el estado de la Tarea">
                                <option value="">-- Selecciona --</option>
                                <option value=1>Habilitado</option>
                                <option value=2>Inhabilitado</option>                    
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>            