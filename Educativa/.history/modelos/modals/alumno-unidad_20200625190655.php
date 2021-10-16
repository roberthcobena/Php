<div class="modal fade" id="TodoUnidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles de Unidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" id="edita_curso" name="edita_curso" enctype="multipart/form-data">
                    <!-- Variable oculta -->
                    <input type="hidden" class="form-control" id="m_id_unidad" name="m_id_unidad" readonly="">

                    <div class="form-group row">                        
                    <label for="m_n_unidad" class="col-sm-2 text-left control-label col-form-label">Unidad: </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="m_n_unidad" name="m_n_unidad" readonly>                            
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_n_descri" class="col-sm-2 text-left control-label col-form-label">Descripción: </label>
                        <div class="col-sm-12">
                           <textarea style="resize:none" rows="5" type="text" class="form-control" id="m_n_descri" name="m_n_descri" readonly=""></textarea>    
                        </div>
                    </div>
                    <!-- Talleres de unidad -->
                    <div class="form-group row">                   
                    <label for="m_n_unidad" class="col-sm-2 text-left control-label col-form-label">Talleres: </label>
                        <table id="zero_config" class="table table-striped table-bordered text-center">
                            <tr>
                                <th>#</th>                                
                                <th>Taller</th>
                                <th>Desde</th>
                                <th>Hasta</th>                                                                
                                <th>Opciones</th>
                            </tr>
                            <?php 
                                $id = $_SESSION['id_usuario'];
                                $contador_t=0;
                                $sql = "SELECT * from cursos c, taller t WHERE c.est_curso!='' AND t.esta_taller!='' AND  t.curs_taller=c.id_curso ORDER BY t.inicio_t DESC";
                                $query = mysqli_query($con, $sql);
                                while ($row = mysqli_fetch_array($query)) {
                                    ++$contador_t; 
                                    $id_taller=['id_taller'];
                                    $n_taller=['nom_taller'];
                                    $inicio=['inicio_t'];
                            }
                            ?>
                            <tr>
                                <td><?php echo $contador_t?></td>
                                <td><?php echo $n_taller?></td>
                                <td style="text-align: center; white-space: nowrap;">
                                    <button type="button" class="btn btn-success" title='Solucionar' onclick="realizar('<?php echo $id_taller;?>');"></i> Realizar</button>                    
                                </td>
                            </tr>
                            
                        </table>                        
                    </div>

                    </div>
                        <div class="modal-footer">                            
                            <button type="submit" class="btn btn-primary" id="ver_Taller">Talleres</button>
                        </div>                   
                </form>
        </div>
    </div>
</div> 