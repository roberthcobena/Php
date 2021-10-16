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
<div class="login-box">  
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Ingrese a la plataforma con sus credenciales</p>

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
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuario" name="user_name" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="user_password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">          
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" name="login" id="submit">Acceder</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- O -</p>        
        <a href="#" class="btn btn-block btn-danger">
        <i class="fab fa-diaspora mr-2"></i> Recuperar accesos
        </a>
      </div>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
</body>
</html>
<?php
  } }