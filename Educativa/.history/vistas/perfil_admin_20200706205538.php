<?php

    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * from usuario u, datos_usuarios d where u.id_usuario=$id AND d.id_usuario=u.id_usuario";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $nombre = $row['nomb_user'];        
        $apellido = $row['apell_user'];
        $telefono = $row['telf_user'];
        $correo = $row['correo_user'];
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
                            <label for="nombre_inv" class="col-sm-6 control-label">Nombres</label>

                            <div class="col-sm-12">
                            
                            <input type="text" maxlength="30" class="form-control" name="nombre_inv" value="<?php echo $nombre?>" required>
                            <input type="hidden" class="form-control" name="id_i" value="<?php echo $id_i?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apellido_inv" class="col-sm-6 control-label">Apellidos</label>

                            <div class="col-sm-12">
                            <input type="text" maxlength="30" class="form-control" name="apellido_inv" value="<?php echo $apellido?>" required>
                            </div>

                        <div class="form-group">
                            <label for="correo_inv" class="col-sm-12 control-label">E-mail</label>

                            <div class="col-sm-12">
                            <input type="E-mail" maxlength="50" data-validation="email" data-validation-error-msg="Ingrese un correo válido" class="form-control" name="correo_inv" value="<?php echo $correo?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="grado_inv" class="col-sm-6 control-label">Teléfono</label>

                            <div class="col-sm-12">
                            <input type="text" maxlength="100" class="form-control" name="grado_inv" value="<?php echo $telefono?>" required>
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
                <!-- CONTRASEÑA DE USUARIO -->
                    <form class="form-horizontal" form method="post" id="contra_usuario">
                        <div class="form-group">
                            <label for="contra_1" class="col-sm-6 control-label">Nueva contraseña</label>

                            <div class="col-sm-12">
                            <input type="password" maxlength="100" class="form-control" name="contra_1" required >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contra_2" class="col-sm-6 control-label">Repetir contraseña</label>

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