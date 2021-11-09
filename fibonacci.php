    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Serie de Fibonnaci</title>
    </head>
    <body>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        
         <input type="text" name="n"><br>
         <input type="submit" name="submit" value="Calcular Fibonacci"><br>
        </form>
    </body>
    </html>

    <?php
if(isset($_POST['submit']))
$n = $_POST['n'];
{ 
    if (empty($n)) {
        echo "Error: Ingrese un número para calcular";
    }
    else {
        
        $fibonacci  = [0,1];
        
        
        for($i=2;$i<=$n;$i++)
        {
            echo   $fibonacci[] = $fibonacci[$i-1]+$fibonacci[$i-2]. "<br>";
        }
        echo "Total: " . $fibonacci[$n];
    }
        
}
//Función
