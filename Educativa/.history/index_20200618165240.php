<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cuestionarios en línea</title>
    <!-- estilo responsivo -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!-- ** recursos visuales ** -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="recursos/template/plugins/bootstrap/bootstrap.min.css">
    <!-- slick slider -->
    <link rel="stylesheet" href="recursos/template/plugins/slick/slick.css">
    <!-- themefy-icon -->
    <link rel="stylesheet" href="recursos/template/plugins/themify-icons/themify-icons.css">
    <!-- Main Stylesheet -->
    <link href="recursos/template/css/style.css" rel="stylesheet">
    <!--Favicon-->    
    <link rel="icon" href="recursos/template/images/favicon.ico" type="image/x-icon">

</head>

<body>

    <!-- Navbar principal -->
    <?php
        include "vistas/home/header.php";
    ?>   

    <!-- Contenedor principal -->
    <?php
        include "vistas/home/slide.php";
    ?>      

    <!-- footer -->
    <footer class="bg-dark footer-section">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h5 class="text-light">Email</h5>
                        <p class="text-white paragraph-lg font-secondary">steve.fruits@email.com</p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-light">Phone</h5>
                        <p class="text-white paragraph-lg font-secondary">+880 2544 658 256</p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-light">Address</h5>
                        <p class="text-white paragraph-lg font-secondary">125/A, CA Commercial Area, California, USA</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top text-center border-dark py-2">
            <p class="mb-0 text-light">Copyright ©
                <script>
                    var CurrentYear = new Date().getFullYear()
                    document.write(CurrentYear)
                </script> a theme by <a href="themefisher.com">themefisher.com</a></p>
        </div>
    </footer>
    <!-- /footer -->

    <!-- jQuery -->
    <script src="recursos/template/plugins/jQuery/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="recursos/template/plugins/bootstrap/bootstrap.min.js"></script>
    <!-- slick slider -->
    <script src="recursos/template/plugins/slick/slick.min.js"></script>
    <!-- filter -->
    <script src="recursos/template/plugins/shuffle/shuffle.min.js"></script>

    <!-- Main Script -->
    <script src="js/script.js"></script>

</body>

</html>