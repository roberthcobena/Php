
<div class="modal fade" id="talInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Informacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="edita_tall" name="edita_tall" enctype="multipart/form-data">
                    <!-- Variable oculta -->
                    <input type="hidden" class="form-control" id="m_id" name="m_id" readonly="">

                    <div class="form-group row">
                        <label for="m_tema" class="col-sm-3 text-right control-label col-form-label">Tema: </label>
                        <div class="col-sm-9">
                            <select class="mi-selector form-control" id="m_tema" name="m_tema" style="width: 100%;" required>
                                <option value="">-- Selecciona --</option>
                                <?php
                                    $sql1 = "SELECT t.id_tema, u.uni_nombre, t.te_nombre FROM unidad u, tema t WHERE t.tem_estado=1 AND t.id_unidad=u.id_unidad";
                                    $result1 = $con->query($sql1);
                                    while ($row1 = $result1->fetch_array()) {
                                        echo "<option value='" . $row1[0] . "'>" . $row1[1] .' ('.$row1[2].")"." </option>";
                                    } // while 
                                    ?>
                            </select>
                        </div>
                    </div>

                
                    
                    <input type="hidden" class="form-control" id="m_curso" name="m_curso" readonly="">

                    <div class="form-group row">
                        <label for="m_nombre" class="col-sm-3 text-right control-label col-form-label">Nombre: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="m_nombre" name="m_nombre" placeholder="nombre del taller" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_cant" class="col-sm-3 text-right control-label col-form-label">Cantidad de preguntas: </label>
                        <div class="col-sm-9">
                            <select class="mi-selector form-control" id="m_cant" name="m_cant" style="width: 100%;" required>
                                <option value="5">5 preguntas</option>
                                <option value="10">10 preguntas</option>
                                <option value="15">15 preguntas</option>                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_acceso" class="col-sm-3 text-right control-label col-form-label">Disponivilidad del taller: </label>
                        <div class="col-sm-9">
                            <select class="mi-selector form-control" id="m_acceso" name="m_acceso" style="width: 100%;" required>
                                <option value="1">Permitir realizar con atraso</option>
                                <option value="2">Bloquear despues el limite</option>                                
                            </select>
                        </div>
                    </div>
                    

                    <div class="form-group row">
                        <label for="m_inicio" class="col-sm-3 text-right control-label col-form-label">Inicio: </label>
                        <div class="col-sm-9 input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker7" id="m_inicio" name="m_inicio" required="" onkeydown="return false;">
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker" >
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_fin" class="col-sm-3 text-right control-label col-form-label">Final: </label>
                        <div class="col-sm-9 input-group date" id="datetimepicker2" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker8" id="m_fin" name="m_fin" required="" onkeydown="return false;">
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
                                <option value=1>Enviado</option>
                                <option value=2>Cancelado</option> 
                            </select>
                        </div>
                    </div>


                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="guarda_Tall">Guardar</button>
                        </div>
                    
                    <div id="resultados_ajax"></div>
                </form>
        </div>
    </div>
</div>

