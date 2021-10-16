
<div class="modal fade" id="reporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reportes academicos del curso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-10"><h5>Promedio general de los estudiantes</h5></div>
          </div>
         
          <input type="hidden" class="form-control" id="n_id" name="n_id" readonly="">
          <div class="row">
            <div class="col-md-4"><a href="#" class='btn btn-danger' title='Descargar PDF' onclick="captura();"><i class="nav-icon fas fa-file-pdf"></i> Descargar PDF</a> </div>
            <div class="col-md-2"></div>
            <div class="col-md-4"><a href="#" class='btn btn-success' title='Descargar Excel' onclick="captura1();"><i class="nav-icon fas fa-file-excel"></i> Descargar Excel</a> </div>
          </div>

           <hr>

           <div class="row">
            <div class="col-md-10"><h5>Promedios de los estudiantes por temas</h5></div>
          </div>

          <div class="row">
            <div class="col-md-4"><a href="#" class='btn btn-danger' title='Descargar PDF' onclick="captura2();"><i class="nav-icon fas fa-file-pdf"></i> Descargar PDF</a> </div>
            <div class="col-md-2"></div>
            <div class="col-md-4"><a href="#" class='btn btn-success' title='Descargar Excel' onclick="captura3();"><i class="nav-icon fas fa-file-excel"></i> Descargar Excel</a> </div>
          </div>
          
        </div>
      </div>


      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>