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
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

</head>

<body>

    <?php
        include "vistas/home/header.php";
    ?>   

    <!-- hero area -->
    <section class="hero-area bg-primary" id="parallax">
        <div class="container">
            <div class="row">
                <div class="col-lg-11 mx-auto">
                    <h1 class="text-white font-tertiary">Ciencias<br> Naturales </h1>
                </div>
            </div>
        </div>
        <div class="layer-bg w-100">
            <img class="img-fluid w-100" src="images/illustrations/leaf-bg.png" alt="bg-shape">
        </div>
        <div class="layer" id="l2">
            <img src="images/illustrations/dots-cyan.png" alt="bg-shape">
        </div>
        <div class="layer" id="l3">
            <img src="images/illustrations/leaf-orange.png" alt="bg-shape">
        </div>
        <div class="layer" id="l4">
            <img src="images/illustrations/dots-orange.png" alt="bg-shape">
        </div>
        <div class="layer" id="l5">
            <img src="images/illustrations/leaf-yellow.png" alt="bg-shape">
        </div>
        <div class="layer" id="l6">
            <img src="images/illustrations/leaf-cyan.png" alt="bg-shape">
        </div>
        <div class="layer" id="l7">
            <img src="images/illustrations/dots-group-orange.png" alt="bg-shape">
        </div>
        <div class="layer" id="l8">
            <img src="images/illustrations/leaf-pink-round.png" alt="bg-shape">
        </div>
        <div class="layer" id="l9">
            <img src="images/illustrations/leaf-cyan-2.png" alt="bg-shape">
        </div>
        <!-- social icon -->
        <ul class="list-unstyled ml-5 mt-3 position-relative zindex-1">
            <li class="mb-3"><a class="text-white" href="#"><i class="ti-facebook"></i></a></li>
            <li class="mb-3"><a class="text-white" href="#"><i class="ti-instagram"></i></a></li>
            <li class="mb-3"><a class="text-white" href="#"><i class="ti-dribbble"></i></a></li>
            <li class="mb-3"><a class="text-white" href="#"><i class="ti-twitter"></i></a></li>
        </ul>
        <!-- /social icon -->
    </section>

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