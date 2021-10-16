<!DOCTYPE html>
<html lang="en">
<head>
    <?php
            include "controladores/meta.php";
    ?>
</head>
<body>
<section class="section">
  <div class="container">
    <div class="row">

      <div class="col-lg-10 mx-auto text-center">
        <p class="font-secondary paragraph-lg text-dark">Proyecto realizado por:</p>
        <a href="#" class="btn btn-transparent">Yasmanny Mora</a>
        <a href="#" class="btn btn-transparent">Y los otros</a>
      </div>

      <div class="col-lg-10 mx-auto text-center">
        <p class="font-secondary paragraph-lg text-dark">Materia:</p>
        <a href="#" class="btn btn-transparent">La que sea</a>        
      </div>
    </div>
          <center>
              <input type=button value="Cerrar" class="btn btn-danger" onclick="cerrar()">
          </center>
  </div>
</section>   
</body>
</html>

<script>
    function cerrar(){
    acercade.close()
}
</script>