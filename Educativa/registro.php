<?php  
  require_once ("controladores/conexion/db.php");
  require_once ("controladores/classes/Login.php");
  $login = new Login();
  list($true,$user_perfil) = $login->isUserLoggedIn();
  if ($true == 1 && $user_perfil == 1) {      
    header("location: app/admin.php");  
  } else if ($true == 1 && $user_perfil == 2) {      
   header("location: app/docente.php");  
  } else if ($true == 1 && $user_perfil == 3) {      
   header("location: app/aula/estudiante.php");  
  } else{    
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>INGRESAR</title>
<link href="recursos/login/css/logn.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
<link rel="icon" href="recursos/template/images/favicon.ico" type="image/x-icon">
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
</head>

<body>
   <div class="signin">
   <center>
      <p class="login-box-msg">NUEVO ESTUDIANTE</p>
   </center>   
   <form method="post" accept-charset="utf-8" id="nuevoUsuario" name="nuevoUsuario" enctype="multipart/form-data">
      <input type="text" class="form-control" placeholder="Nombres" onkeypress="return check(event)" name="new_name" id="new_name" required></br></br>
      <input type="text" class="form-control" placeholder="Apellidos" onkeypress="return check(event)" name="new_apell" id="new_apell" required></br></br>
      <input type="text" class="form-control" placeholder="Usuario" name="new_user" id="new_user" required></br></br>
      <input type="password" class="form-control" placeholder="Contraseña" name="new_pass" id="new_pass"  required></br></br>
      
	  <button type="submit" class="button" name="registro" id="registro">REGISTRARME</button></br></br>
	  
      <a href="index.php">Regresar a página principal</a></br></br>
	  ¿Tienes una cuenta?<a href="login.php" style="font-family:'Play', sans-serif;"></br>INICIAR SESIÓN</a></br>
	  <div id="resultados_registro"></div>
   </form>
</div>
</body>
<!-- Javascript para registro-->
<script type="text/javascript" src="controladores/js/registro.js"></script>  
</html>
<?php
  } 