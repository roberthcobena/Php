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

                    <div class="form-group row">
                        <label for="m_seccion" class="col-sm-3 text-right control-label col-form-label">Seccion: </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="m_seccion" name="m_seccion"  required>
                                <option value="">-- Seleccione --</option>
                                <option value=A>A</option>
                                <option value=B>B</option>                    
                                <option value=C>C</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="m_portada" class="col-sm-3 text-right control-label col-form-label">Portada: </label>
                        <div class="col-sm-9">
                            <img id="m_portada" name="m_portada" src="" alt="Sin logo" class="img-responsive" height=auto width=50%>
                            <input type="file" class="form-control" id="portada_info" name="portada_info"/>
                        </div>
                    </div>
                    
                    </div>
                        <div class="modal-footer">                            
                            <button type="submit" class="btn btn-primary" id="ver_Taller">Talleres</button>
                        </div>
                    
                    <div id="resultados_ajax"></div>
                </form>
        </div>
    </div>
</div> 