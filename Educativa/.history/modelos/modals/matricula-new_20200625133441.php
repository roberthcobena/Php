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
                <form class="form-horizontal" method="post" id="nuevo_curso" name="nuevo_curso" enctype="multipart/form-data">
                    <div class="form-group row">
                            <label for="m_cod" class="col-sm-3 text-right control-label col-form-label">Código: </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="m_cod" name="m_cod" >                            
                            </div>
                        </div>                    
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="nuevo_Curso">Registrar</button>
                        </div>
                    
                    <div id="resultados_ajax_n"></div>
                </form>
        </div>
    </div>
</div> 