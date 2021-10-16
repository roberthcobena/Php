<div class="modal fade" id="añoNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Año Lectivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="nuevo_año" name="nuevo_año" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="año" class="col-sm-3 text-right control-label col-form-label">Año: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control lectivo-inputmask" id="año" name="año" placeholder="Ingrese año" required="">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="desde" class="col-sm-3 text-right control-label col-form-label">Inicio: </label>
                        <div class="col-sm-9 input-group date" id="datetimepicker9" data-target-input="nearest">
                            <input type="datetime" class="form-control datetimepicker-input" data-target="#datetimepicker9" id="desde" name="desde" required="" placeholder="año-mes-dia" onkeydown="return false;">
                            <div class="input-group-append" data-target="#datetimepicker9" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="hasta" class="col-sm-3 text-right control-label col-form-label">Final: </label>
                        <div class="col-sm-9 input-group date" id="datetimepicker10" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker10" id="hasta" name="hasta" required="" placeholder="año-mes-dia" onkeydown="return false;">
                            <div class="input-group-append" data-target="#datetimepicker10" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>


                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="nuevo_Año">Registrar</button>
                        </div>
                    
                    <div id="resultados_ajax_n"></div>
                </form>
        </div>
    </div>
</div> 