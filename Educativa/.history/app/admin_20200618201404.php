<?php	
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: ../login.php");
		exit;
        }	
	/* Connect To Database*/
	require_once ("../controladores/conexion/db.php");//Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../controladores/conexion/conexion.php");//Contiene funcion que conecta a la base de datos
	$header="Administrador | Colegio Cuenca";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("../vistas/head.php");?>
  </head>

  <body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">
      <!-- Main -->
        <div id="main">
          <div class="inner">

            <!-- Header -->
            <header id="header">
              <div class="logo">
                <a href="javascript:window.location.href=window.location.href"><?php echo $header;?></a>
                <ul>
                <li><a href="login.php?logout"><i class='glyphicon glyphicon-off'></i> Salir</a></li>
                </ul>
              </div>
            </header>

            <!-- Page Heading -->
            <div class="page-heading">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <h1><center>Escuela "Ciudad de Cuenca"</center></h1>
                    <p><strong>MISIÓN INSTITUCIONAL</strong> </p>
                    <p>La Institución Ciudad de Cuenca forma a los estudiantes de manera íntegra, con una mentalidad creadora, solidaria; conduciéndolos en el aprendizaje para todos, enseñanza significativa y aprendizaje perdurable; regulando su propio aprendizaje, desarrollando el pensamiento con suavidad y firmeza desde y para la vida individualizada, valorando el ecosistema, protegiéndolos en su diario vivir siendo incluyentes y diversos en la calidad y calidez educativa.</p>
                    <p><strong>VISIÓN INSTITUCIONAL</strong> </p>
                    <p>La Institución Educativa fortalecerá y potenciará la enseñanza responsiva, logrando desarrollar la comunicación asertiva, el pensamiento crítico, la autoestima entre los educandos, participando activamente logrando promover los valores fundamentales como la justicia, innovación y solidaridad, siendo gestores de la educación de calidad y calidez promoviendo y preservando la convivencia armónica para el desarrollo integral de la persona, la familia y la comunidad.</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Simple Post -->
            <section class="simple-post">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-12">
                    <img src="assets/images/simple-post.jpg" alt="">
                    <div class="down-content">
                      <p><strong>Director Manuel...</strong> </p>
                      <p>Mauris aliquam ipsum nibh, id scelerisque leo congue vel. Vivamus ornare, eros et ornare consectetur, ipsum ipsum sollicitudin libero, at condimentum risus nulla non enim. Quisque sodales vestibulum arcu porttitor finibus. Phasellus dictum nisl id augue ornare, vel interdum nibh mollis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>
                      
                    </div>
                  </div>
                </div>
                
               
                
              </div>
            </section>
            
            <section class="simple-post">
              <div class="container-fluid">
              
               <div class="row"></div>
                
              </div>
              </section>
              
              <section class="simple-post">
              <div class="container-fluid">
              
               <div class="row">
                  <div class="col-lg-4">
						<h2>First Column</h2>
                      <p>Aliquam sit amet gravida tellus. Phasellus id erat nec mi ullamcorper viverra. Quisque vitae pharetra sem. Maecenas sit amet velit ultrices, malesuada quam id, porta nisl.</p>
                      <br>

                  </div>
                  <div class="col-lg-4">
						<h2>Second Column</h2>
                      <p>Donec et massa at dolor condimentum ornare nec non lorem. Maecenas non egestas metus, sed ultricies lectus. Aliquam sit amet gravida tellus. Phasellus id erat nec mi ullamcorper viverra.</p>
                      <br>

                  </div>
                  <div class="col-lg-4">
						<h2>Third Column</h2>
                      <p>Quisque sodales vestibulum arcu porttitor finibus. Phasellus dictum nisl id augue ornare, vel interdum nibh mollis. Aliquam sit amet gravida tellus.</p>

                  </div>
                </div>
                
              </div>
              </section>

            <!-- Contact Form -->
            <section class="contact-form">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6">
                    <form id="contact" action="" method="post">
                      <div class="row"></div>
                    </form> 
                  </div>
                  <div class="col-md-6">
                    <div id="map">
                    <!-- How to change your own map point
                           1. Go to Google Maps
                           2. Click on your location point
                           3. Click "Share" and choose "Embed map" tab
                           4. Copy only URL and paste it within the src="" field below
                    -->

                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1197183.8373802372!2d-1.9415093691103689!3d6.781986417238027!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdb96f349e85efd%3A0xb8d1e0b88af1f0f5!2sKumasi+Central+Market!5e0!3m2!1sen!2sth!4v1532967884907" width="100%" height="420px" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                  </div>
                </div>
              </div>
            </section>

          </div>
        </div>

      <!-- Sidebar -->
        <div id="sidebar">

          <div class="inner">

            <!-- Search Box -->
            <section id="search" class="alt">
              <form method="get" action="#">
                <input type="text" name="search" id="search" placeholder="Search..." />
              </form>
            </section>
              
            <!-- Menu -->
            <nav id="menu">
              <ul>
                <li><a href="index.html">UNIDADES</a></li>
                <li><a href="simple_page.html">ALUMNOS</a></li>
                <li><a href="shortcodes.html">DOCENTES</a></li>
                <li>
                <li><a href="shortcodes.html">CERRAR SESIÓN</a></li>
                <li>
                 
             
              </ul>
            </nav>

            <!-- Featured Posts -->
            <div class="featured-posts">
              <div class="heading">
                <h2>Featured Posts</h2>
              </div>
              <div class="owl-carousel owl-theme">
                <a href="#">
                  <div class="featured-item">
                    <img src="assets/images/featured_post_01.jpg" alt="featured one">
                    <p>Aliquam egestas convallis eros sed gravida. Curabitur consequat sit.</p>
                  </div>
                </a>
                <a href="#">
                  <div class="featured-item">
                    <img src="assets/images/featured_post_01.jpg" alt="featured two">
                    <p>Donec a scelerisque massa. Aliquam non iaculis quam. Duis arcu turpis.</p>
                  </div>
                </a>
                <a href="#">
                  <div class="featured-item">
                    <img src="assets/images/featured_post_01.jpg" alt="featured three">
                    <p>Suspendisse ac convallis urna, vitae luctus ante. Donec sit amet.</p>
                  </div>
                </a>
              </div>
            </div>

            <!-- Footer -->
            <footer id="footer">
              <p class="copyright">Copyright &copy; 2019 Company Name
              <br>Designed by <a rel="nofollow" href="https://www.facebook.com/templatemo">Template Mo</a></p>
            </footer>
            
          </div>
        </div>

    </div>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/custom.js"></script>
</body>


  </body>

</html>
