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
    <!-- /Navbar principal -->   

    <!-- Contenedor principal -->
    <?php
        include "vistas/home/slide.php";
    ?>      
    <!-- /Contenedor principal -->

    <!-- Footer -->
    <?php
        include "vistas/home/footer.php";
    ?> 
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