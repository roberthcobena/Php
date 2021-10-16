<?php
    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * from usuario where id_usuario=$id";
    $query = mysqli_query($con, $sql);
    $sql2 = "SELECT * from docentes where id_usuario=$id";
    $query2 = mysqli_query($con, $sql2);
    while ($row = mysqli_fetch_array($query)) { $tipo = $row['u_tipo'];  }       
    while ($row = mysqli_fetch_array($query2)) {  $cargo = $row['doc_cargo'];  } 
if ($tipo==1 OR $cargo==1) {
    $sql3 = "SELECT c.id_curso, c.nom_curso, c.sec_curso, j.nom_seccion, a.anio FROM cursos c, jornadas j, anios_lectivos a WHERE c.est_curso=1 AND c.jornada=j.id_seccion AND a.id=c.an_lec";
}else if ($tipo==2 AND $cargo==2) {
    $sql3 = "SELECT c.id_curso, c.nom_curso, c.sec_curso, j.nom_seccion FROM cursos c, jornadas j, doc_curso d, docentes o, usuario u WHERE c.jornada=j.id_seccion AND c.id_curso=d.id_curso AND d.id_docente=o.id_docente AND o.id_usuario=u.id_usuario AND u.id_usuario=$id";
}
?>
<div class="modal fade" id="talInfo1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informacion del taller</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="edita_tall1" name="edita_tall1" enctype="multipart/form-data">
                    <!-- Variable oculta -->
                    <input type="hidden" class="form-control" id="n_id" name="n_id" readonly="">

                    <div class="form-group row">
                        <label for="n_tema" class="col-sm-3 text-right control-label col-form-label">Tema: </label>
                        <div class="col-sm-9">
                            <select class="mi-selector form-control" id="n_tema" name="n_tema" style="width: 100%;" required>
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

                    <div class="form-group row">
                        <label for="n_curso" class="col-sm-3 text-right control-label col-form-label">Curso: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="n_curso" name="n_curso" required>
                                <option value="">-- Selecciona --</option>
                                <?php
                                    $result = $con->query($sql3);
                                    while ($row = $result->fetch_array()) {
                                        echo "<option value='" . $row[0] . "'>" . $row[1] .' "'.$row[2].'" '."(".$row[3].") - (".$row[4].")"."</option>";
                                    } // while 
                                    ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="n_nombre" class="col-sm-3 text-right control-label col-form-label">Nombre: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="n_nombre" name="n_nombre" placeholder="nombre del taller" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="n_cant" class="col-sm-3 text-right control-label col-form-label">Cantidad de preguntas: </label>
                        <div class="col-sm-9">
                            <select class="mi-selector form-control" id="n_cant" name="n_cant" style="width: 100%;" required>
                                <option value="5">5 preguntas</option>
                                <option value="10">10 preguntas</option>
                                <option value="15">15 preguntas</option>                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="n_acceso" class="col-sm-3 text-right control-label col-form-label">Disponivilidad del taller: </label>
                        <div class="col-sm-9">
                            <select class="mi-selector form-control" id="n_acceso" name="n_acceso" style="width: 100%;" required>
                                <option value="1">Permitir realizar con atraso</option>
                                <option value="2">Bloquear despues el limite</option>                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="n_inicio" class="col-sm-3 text-right control-label col-form-label">Inicio: </label>
                        <div class="col-sm-9 input-group date" id="datetimepicker3" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker7" id="n_inicio" name="n_inicio" required="" onkeydown="return false;">
                            <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker" >
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="n_fin" class="col-sm-3 text-right control-label col-form-label">Final: </label>
                        <div class="col-sm-9 input-group date" id="datetimepicker4" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker8" id="n_fin" name="n_fin" required="" onkeydown="return false;">
                            <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="n_estado" class="col-sm-3 text-right control-label col-form-label">Estado: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="n_estado" name="n_estado"  required>
                                <option value="">-- Seleccione --</option>
                                <option value=3>Gestion</option>
                            </select>
                        </div>
                    </div>

                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="guarda_Tall1">Guardar</button>
                        </div>
                    
                    <div id="resultados_ajax1"></div>
                </form>
        </div>
    </div>
</div> 