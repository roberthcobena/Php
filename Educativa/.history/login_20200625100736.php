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
      <p class="login-box-msg">INGRESAR</p>
   </center>
   <form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="form-signin">
   <?php				
				if (isset($login)) {
					if ($login->errors) {
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						    <strong>Error!</strong> 						
						<?php 
						foreach ($login->errors as $error) {
							echo $error;
						}
						?>
						</div>
						<?php
					}
					if ($login->messages) {
						?>
						<div class="alert alert-success alert-dismissible" role="alert">
						    <strong>Aviso!</strong>
						<?php
						foreach ($login->messages as $message) {
							echo $message;
						}
						?>
						</div> 
						<?php 
					}
				}
				?>      
      <input type="text" class="form-control" placeholder="Usuario" name="user_name" required></br></br>
      <input type="password" class="form-control" placeholder="Contraseña" name="user_password" required></br></br>
      <button type="submit" class="btn btn-primary btn-block" name="login" id="submit">ACCEDER</button></br></br>
      <a href="index.php">Regresar a página principal</a></br></br></br></br></br></br>
      ¿No tienes cuenta?<a href="registro.php" style="font-family:'Play', sans-serif;"></br>REGISTRARSE</a>
   </form>
</div>
</body>
</html>
<?php
  } 