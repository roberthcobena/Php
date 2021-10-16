<div class="modal fade" id="preguInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informacion de la Pregunta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="edita_pregu" name="edita_pregu" enctype="multipart/form-data">
                    <!-- Variable oculta -->
                    <input type="hidden" class="form-control" id="m_id" name="m_id" readonly="">
                    <input type="hidden" class="form-control" id="m_taller" name="m_taller" readonly="">

                    <div class="form-group row">
                        <label for="m_pregunta" class="col-sm-3 text-right control-label col-form-label">Pregunta: </label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="m_pregunta" name="m_pregunta" required="" placeholder="Escriba la pregunta"></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_op1" class="col-sm-3 text-right control-label col-form-label">Opcion A: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="m_op1" name="m_op1" required="" placeholder="Escriba la respuesta">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_op2" class="col-sm-3 text-right control-label col-form-label">Opcion B: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="m_op2" name="m_op2" required="" placeholder="Escriba la respuesta">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_op3" class="col-sm-3 text-right control-label col-form-label">Opcion C: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="m_op3" name="m_op3" required="" placeholder="Escriba la respuesta">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_op4" class="col-sm-3 text-right control-label col-form-label">Opcion D: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="m_op4" name="m_op4" required="" placeholder="Escriba la respuesta">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_correcta" class="col-sm-3 text-right control-label col-form-label">Respuesta: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="m_correcta" name="m_correcta"  required>
                                <option value="">-- Seleccione la opcion correcta--</option>
                                <option value=1>Opcion A</option>
                                <option value=2>Opcion B</option>
                                <option value=3>Opcion C</option>
                                <option value=4>Opcion D</option> 
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
                            <button type="submit" class="btn btn-primary" id="guarda_pre">Guardar</button>
                        </div>
                    
                    <div id="resultados_ajax"></div>
                </form>
        </div>
    </div>
</div> 