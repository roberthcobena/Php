<div class="modal fade" id="docNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Docente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="nuevo_doc" name="nuevo_doc" enctype="multipart/form-data">

                    <div class="row">

                    <div class="col-md-6">


                    <div class="form-group row">
                        <label for="cedula" class="col-sm-3 text-right control-label col-form-label">Cedula: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control cedula-inputmask" id="cedula" name="cedula"  required="" placeholder="xxxxxxxxxx">
                            <label id="salida" style="Display:none;color:green;">Cédula Válida</label>
                            <label id="salida2" style="Display:none;color:red;">Cédula InVálida</label>
                        </div>
                    </div>


                    

                    <div class="form-group row">
                        <label for="telf" class="col-sm-3 text-right control-label col-form-label">Telefono: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control cell-inputmask" id="telf" name="telf" onkeypress="return checknum(event)" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="correo" class="col-sm-3 text-right control-label col-form-label">Correo: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control email-inputmask" id="correo" name="correo" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cargo" class="col-sm-3 text-right control-label col-form-label">Cargo: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="cargo" name="cargo"  required>
                                <option value="">-- Selecciona --</option>
                                <?php
                                    $sql = "SELECT c.id_cargo, c.nom_cargo FROM cargos c WHERE c.est_cargo=1";
                                    $result = $con->query($sql);
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value='" . $row[0] . "'>" . $row[1] ."</option>";
                                    } // while 
                                    ?>
                            </select>
                        </div>
                    </div>

                    


                    </div>

                    

                    <div class="col-md-6">

                    
                    <div class="form-group row">
                        <label for="nombre" class="col-sm-3 text-right control-label col-form-label">Nombre: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nombre" name="nombre" onkeypress="return check(event)" required="">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="apellido" class="col-sm-3 text-right control-label col-form-label">Apellido: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="apellido" name="apellido" onkeypress="return check(event)" required="">
                        </div>
                    </div>

                    

                    <div class="form-group row">
                        <label for="titulo" class="col-sm-3 text-right control-label col-form-label">Titulo: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="titulo" name="titulo"  required>
                                <option value="">-- Seleccione --</option>
                                <option value="Licenciado(a)">Licenciado(a)</option>
                                <option value="Master">Master</option>
                                <option value="PH">PH</option>
                                <option value="Ingeniero(a)">Ingeniero(a)</option>
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

                    </div>
                    
                    </div>

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="nuevo_Doc" onclick="validar()" >Guardar</button>
            </div>
            <div id="resultados_ajax_n"></div>
               </form>
        </div>
    </div>
</div>