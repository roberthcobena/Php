<div class="modal fade" id="userNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="nuevo_usuario" name="nuevo_usuario" enctype="multipart/form-data">


                    <div class="form-group row">
                        <label for="nombre" class="col-sm-3 text-right control-label col-form-label">Nombre: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nombre" name="nombre" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="apellido" class="col-sm-3 text-right control-label col-form-label">Apellido: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="apellido" name="apellido" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telf" class="col-sm-3 text-right control-label col-form-label">Telefono: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="telf" name="telf" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="correo" class="col-sm-3 text-right control-label col-form-label">Correo: </label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="correo" name="correo" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tipo" class="col-sm-3 text-right control-label col-form-label">Tipo de usuario: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="tipo" name="tipo"  required>
                                <option value="">-- Selecciona --</option>
                                <?php
                                    $sql = "SELECT t.id_tipo_usuario, t.nombre_tipo FROM tipo_usuario t WHERE t.estado_tipo=1 and t.id_tipo_usuario != 1";
                                    $result = $con->query($sql);
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value='" . $row[0] . "'>" . htmlspecialchars($row[1], ENT_QUOTES, 'UTF-8') . "</option>";
                                    } // while 
                                    ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="usuario" class="col-sm-3 text-right control-label col-form-label">Usuario: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="usuario" name="usuario" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="clave" class="col-sm-3 text-right control-label col-form-label">Clave: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="clave" name="clave" required="">
                        </div>
                    </div>

                    

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="guarda_Unidad">Guardar</button>
            </div>
        </div>
    </div>
</div>         