<div class="modal fade" id="preguNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Pregunta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="nuevo_pregu" name="nuevo_pregu" enctype="multipart/form-data">

                    <input type="hidden" class="form-control" id="taller" name="taller" readonly="" value="<?php echo $id_taller ?>">
                    
                    <div class="form-group row">
                        <label for="pregunta" class="col-sm-3 text-right control-label col-form-label">Pregunta: </label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="pregunta" name="pregunta" required="" placeholder="Escriba la pregunta"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="op1" class="col-sm-3 text-right control-label col-form-label">Opcion A: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="op1" name="op1" required="" placeholder="Escriba la respuesta">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="op2" class="col-sm-3 text-right control-label col-form-label">Opcion B: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="op2" name="op2" required="" placeholder="Escriba la respuesta">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="op3" class="col-sm-3 text-right control-label col-form-label">Opcion C: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="op3" name="op3" required="" placeholder="Escriba la respuesta">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="op4" class="col-sm-3 text-right control-label col-form-label">Opcion D: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="op4" name="op4" required="" placeholder="Escriba la respuesta">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="correcta" class="col-sm-3 text-right control-label col-form-label">Respuesta: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="correcta" name="correcta"  required>
                                <option value="">-- Seleccione la opcion correcta--</option>
                                <option value=1>Opcion A</option>
                                <option value=2>Opcion B</option>
                                <option value=3>Opcion C</option>
                                <option value=4>Opcion D</option> 
                            </select>
                        </div>
                    </div>

                    

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="nuevo_pre">Guardar</button>
            </div>
            <div id="resultados_ajax_n"></div>
                </form>
        </div>
    </div>
</div>            