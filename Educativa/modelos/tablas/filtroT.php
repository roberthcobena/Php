<div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Reporte de promedios por temas</h5>

                                <form action="#" method="post" id="promediot" name="promediot" enctype="multipart/form-data">
                                <div class="row mb-3">
                                     <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id_curso; ?>" readonly="">
                                    <div class="col-lg-4 border-right border-primary temas">
                                        <label>Temas disponibles:</label>

                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" class="custom-control-input all" id="temaA">
                                            <label class="custom-control-label" for="temaA">---- Todos ----</label>
                                        </div>

                                        <?php
                                        $sql = "SELECT t.id_tema, u.uni_nombre, t.te_nombre, u.id_unidad FROM unidad u, tema t WHERE t.tem_estado=1 AND t.id_unidad=u.id_unidad ORDER BY u.id_unidad ASC";
                                        $query = mysqli_query($con, $sql);
                                        $t=0;
                                        while ($row = $query->fetch_array()) {
                                            ++$t;
                                         ?>
                                         <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" class="custom-control-input" id="tema<?php echo $t; ?>" name="tema[]" value="<?php echo $row[0]; ?>" >
                                            <label class="custom-control-label" for="tema<?php echo $t; ?>"><?php echo $row[1] .' '.$row[2]; ?></label>
                                        </div>
                                         <?php
                                         }
                                         ?>
                                    </div>
                                    <div class="col-lg-4 border-right border-primary estudiantes">
                                        <label>Estudiantes del curso:</label>
                                        
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" class="custom-control-input all" id="estA">
                                            <label class="custom-control-label" for="estA">---- Todos ----</label>
                                        </div>

                                        <?php
                                        $sql1 = "SELECT u.id_usuario, d.apell_user, d.nomb_user FROM usuario u, datos_usuarios d, alumnos a, cursos c WHERE u.id_usuario=d.id_usuario AND a.alum_usu=u.id_usuario AND a.alum_seccion=c.id_curso AND u.u_estado=1 AND c.id_curso=$id_curso ORDER BY d.apell_user ASC";
                                        $query1 = mysqli_query($con, $sql1);
                                        $e=0;
                                        while ($row1 = $query1->fetch_array()) {
                                            ++$e;
                                         ?>
                                         <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" class="custom-control-input" id="est<?php echo $e; ?>" name="est[]" value="<?php echo $row1[0]; ?>" >
                                            <label class="custom-control-label" for="est<?php echo $e; ?>"><?php echo $row1[1] .' '.$row1[2]; ?></label>
                                        </div>
                                         <?php
                                         }
                                         ?>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Tipo de archivo:</label>
                                        
                                        <select class="mi-selector form-control" id="archivo" name="archivo" style="width: 100%;" required>
                                            <option value="1">.Formato PDF</option>
                                            <option value="2">.Formato Excel</option>                              
                                        </select>
                                    </div>

                                    <div class="col-lg-2">
                                        <button type="submit" class="btn btn-primary" id="descargar" name="descargar"><i class="fas fa-download"></i> Descargar
                                        </button>
                                    </div>

                                </div>
                                <div id="resultados_ajax_t"></div>
                                </form>
                                
                                
                            </div>
                        </div>
