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
                        <label for="curso" class="col-sm-3 text-right control-label col-form-label">Curso: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="curso" name="curso" value="7mo" readonly="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="seccion" class="col-sm-3 text-right control-label col-form-label">Seccion: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="seccion" name="seccion" data-validation="required" data-validation-error-msg="Seleccione el estado de la Tarea">
                                <option value="">-- Seleccione --</option>
                                <option value=A>A</option>
                                <option value=B>B</option>                    
                                <option value=C>C</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jornada" class="col-sm-3 text-right control-label col-form-label">Jornada: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="jornada" name="jornada" data-validation="required" data-validation-error-msg="Seleccione el estado de la Tarea">
                                <option value="">-- Seleccione --</option>
                                <option value=1>Matutina</option>
                                <option value=2>Vespertina</option>                    
                                <option value=3>Nocturna</option>
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