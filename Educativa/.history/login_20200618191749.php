<?php
  if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Lo sentimos, Necesita una versión de PHP igual o superior a 5.3.7 !");
  } else if (version_compare(PHP_VERSION, '5.5.0', '<')) {        
  require_once ("controladores/conexion/db.php");
  require_once ("controladores/classes/Login.php");
  $login = new Login();
  list($true,$user_perfil) = $login->isUserLoggedIn();
  if ($true == 1 && $user_perfil != 1) {      
    header("location: app/admin.php");  
  } else if ($true == 1 && $user_perfil != 2) {      
   header("location: app/docente.php");  
  } else if ($true == 1 && $user_perfil != 3) {      
   header("location: app/estudiante.php");  
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
   <form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="form-signin">
      <h2 style="color:#fff;">INGRESAR</h2>
      
      <input type="text" name="username" id="username" placeholder="Ingresar Usuario"/></br></br>
      <input type="password" name="pass" id="pass" placeholder="Ingresar Contraseña" /></br></br>
      <input type="submit" id="entrar" name="entrar" value="Ingresar" class="boton"></br></br>
      <a href="index.php">Regresar a página principal</a></br></br></br></br></br></br>
      ¿No tienes cuenta?<a href="sgnup.php" style="font-family:'Play', sans-serif;">&nbsp;REGISTRATE</a>
   </form>
</div>
</body>
</html>
<?php
  } }