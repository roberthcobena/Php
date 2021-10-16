<div class="modal fade" id="añoInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Curso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="edita_año" name="edita_año" enctype="multipart/form-data">

                    <input type="hidden" class="form-control" id="m_id" name="m_id" readonly="">

                    <div class="form-group row">
                        <label for="año" class="col-sm-3 text-right control-label col-form-label">Año: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control lectivo-inputmask" id="m_año" name="m_año" placeholder="Ingrese año" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_desde" class="col-sm-3 text-right control-label col-form-label">Inicio: </label>
                        <div class="col-sm-9 input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker7" id="m_desde" name="m_desde" required="" onkeydown="return false;">
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker" >
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="m_hasta" class="col-sm-3 text-right control-label col-form-label">Final: </label>
                        <div class="col-sm-9 input-group date" id="datetimepicker2" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker8" id="m_hasta" name="m_hasta" required="" onkeydown="return false;">
                            <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="m_estado" class="col-sm-3 text-right control-label col-form-label">Estado: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="m_estado" name="m_estado"  required>
                                <option value="">-- Seleccione --</option>
                                <option value=1>Activo</option>
                                <option value=2>Inactivo</option>
                                <option value=3>Finalizado</option>  
                            </select>
                        </div>
                    </div>

                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="guarda_Año">Guardar</button>
                        </div>
                    
                    <div id="resultados_ajax"></div>
                </form>
        </div>
    </div>
</div> 