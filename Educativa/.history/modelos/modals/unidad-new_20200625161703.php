<div class="modal fade" id="uniNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Unidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="nueva_unidad" name="nueva_unidad" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="unidad" class="col-sm-3 text-right control-label col-form-label">Unidad: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="unidad" name="unidad" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="descripcion" class="col-sm-3 text-right control-label col-form-label">Descripcion: </label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="descripcion" name="descripcion" required=""></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="portada_u" class="col-sm-3 control-label">Portada</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="portada_u" name="portada_u" required />
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="guarda_Unidad">Guardar</button>
                </div>
                    
                    <div id="resultados_ajax_n"></div>
                </form>
        </div>
    </div>
</div>            