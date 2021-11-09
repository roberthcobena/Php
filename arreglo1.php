    <?php
        $MyArray= array();
        $MyArray=['1','52','12','32'];
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Número mayor en arreglo</title>
    </head>
    <body>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">      
         <label for="array">Arreglo: <?php print_r($MyArray);?></label></br>
         <input type="submit" name="submit" value="Imprimir número mayor"><br>
        </form>
    </body>
    </html>

    <?php
if(isset($_POST['submit']))

{ 
    echo max($MyArray);
    
}
//Función
