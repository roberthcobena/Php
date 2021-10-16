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

    <!-- Scripts necesarios -->
    <?php
        include "controladores/scripts.php";
    ?>
    <!-- /Scripts necesarios --> 

</body>

</html>