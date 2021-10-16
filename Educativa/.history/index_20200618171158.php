<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Info de la pagina y complementos del sitio -->
    <?php
        include "controladores/meta.php";
    ?>
    <!-- /Navbar principal -->  
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