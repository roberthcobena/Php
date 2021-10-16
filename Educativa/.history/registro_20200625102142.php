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
</head>

<body>
   <div class="signin">
   <center>
      <p class="login-box-msg">NUEVO ESTUDIANTE</p>
   </center>
   <form method="post" accept-charset="utf-8" name="registro" autocomplete="off" role="form" >
      <input type="text" class="form-control" placeholder="Usuario" name="new_user" required></br></br>
      <input type="password" class="form-control" placeholder="Contraseña" name="new_pass" required></br></br>
      
	  <button type="submit" class="button" name="login" id="submit">REGISTRARME</button></br></br>
	  
      <a href="index.php">Regresar a página principal</a></br></br></br></br></br>
      ¿Tienes una cuenta?<a href="login.php" style="font-family:'Play', sans-serif;"></br>INICIAR SESIÓN</a>
   </form>
</div>
</body>
</html>
<?php
  } 