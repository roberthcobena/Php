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
                        <label for="curso" class="col-sm-3 text-right control-label col-form-label">Curso: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control curso-inputmask" id="curso" name="curso" placeholder="0(mo)" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="seccion" class="col-sm-3 text-right control-label col-form-label">Seccion: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="seccion" name="seccion"  required>
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
                            <select class="form-control" id="jornada" name="jornada"  required>
                                <option value="">-- Selecciona --</option>
                                <?php
                                    $sql = "SELECT j.id_seccion, j.nom_seccion FROM jornadas j WHERE j.est_seccion=1";
                                    $result = $con->query($sql);
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value='" . $row[0] . "'>" . htmlspecialchars($row[1], ENT_QUOTES, 'UTF-8') . "</option>";
                                    } // while 
                                    ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="año" class="col-sm-3 text-right control-label col-form-label">Año lectivo: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="año" name="año"  required>
                                <option value="">-- Selecciona --</option>
                                <?php
                                    $sql = "SELECT a.id, a.anio FROM anios_lectivos a WHERE a.estado=1";
                                    $result = $con->query($sql);
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value='" . $row[0] . "'>" . htmlspecialchars($row[1], ENT_QUOTES, 'UTF-8') . "</option>";
                                    } // while 
                                    ?>
                            </select>
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