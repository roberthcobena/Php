<?php

    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * from usuario u, datos_usuarios d, docentes o where u.id_usuario=$id AND d.id_usuario=u.id_usuario AND u.id_usuario=o.id_usuario";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $nombre = $row['nomb_user'];        
        $apellido = $row['apell_user'];
        $telefono = $row['telf_user'];
        $correo = $row['correo_user'];
        $titulo = $row['doc_titulo'];
    }
?>
<div class="container-fluid">                
    <div class="row">
        
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Datos de usuario</h1>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <!-- DATOS DE USUARIO -->
                        <form class="form-horizontal" form method="post" id="datos_usuario">
                            <div class="form-group">
                                <label for="nombre" class="col-sm-6 control-label">Nombres</label>

                                <div class="col-sm-12">
                                
                                <input type="text" maxlength="30" class="form-control" name="nombre" onkeypress="return check(event)" value="<?php echo $nombre?>" required>
                                <input type="hidden" class="form-control" name="id_d" value="<?php echo $id?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="apellido" class="col-sm-6 control-label">Apellidos</label>

                                <div class="col-sm-12">
                                <input type="text" maxlength="30" class="form-control" name="apellido" onkeypress="return check(event)" value="<?php echo $apellido?>" required>
                                </div></div>

                            <div class="form-group">
                                <label for="correo" class="col-sm-12 control-label">E-mail</label>

                                <div class="col-sm-12">
                                <input type="E-mail"  class="form-control email-inputmask" name="correo" value="<?php echo $correo?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telefono" class="col-sm-6 control-label">Tel??fono</label>

                                <div class="col-sm-12">
                                <input type="text"  class="form-control cell-inputmask" name="telefono" value="<?php echo $telefono?>" required>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="titulo" class="col-sm-6 control-label col-form-label">Titulo: </label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="titulo" name="titulo"  required>
                                        <option value="<?php echo $titulo?>" selected><?php echo $titulo?></option>
                                        <option value="Licenciado(a)">Licenciado(a)</option>
                                        <option value="Master">Master</option>
                                        <option value="PH">PH</option>
                                        <option value="Ingeniero(a)">Ingeniero(a)</option>
                                    </select>
                                </div>
                            </div>                   
                            
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-12">
                                <button type="submit" class="btn btn-success" id="actualizaUsuario" >Actualizar</button>
                                </div>
                            </div>
                            <div class='col-md-12' id="resultados_ajax_Datos"></div><!-- Carga los datos ajax -->
                        </form>
                    </div>                    
                </div>
            </div>
        

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                <!-- CONTRASE??A DE USUARIO -->
                    <form class="form-horizontal" form method="post" id="contra_usuario">
                        <div class="form-group">
                            <label for="contra_1" class="col-sm-6 control-label">Nueva contrase??a</label>
                            <input type="hidden" class="form-control" name="id_c" value="<?php echo $id?>" required>
                            <div class="col-sm-12">
                            <input type="password" maxlength="100" class="form-control" name="contra_1" required >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contra_2" class="col-sm-6 control-label">Repetir contrase??a</label>

                            <div class="col-sm-12">
                            <input type="password" maxlength="100" class="form-control" name="contra_2" required>
                            </div>
                        </div>
                                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-12">
                            <button type="submit" class="btn btn-success" id="actualizaContra" >Actualizar</button>
                            </div>
                        </div>
                        <div class='col-md-12' id="resultados_ajax_Contra"></div><!-- Carga los datos ajax -->
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>