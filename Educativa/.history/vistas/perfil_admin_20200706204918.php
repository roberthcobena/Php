<?php

    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * from usuario u, datos_usuarios d where u.id_usuario=$id AND d.id_usuario=u.id_usuario";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($query)) {
        $nombre = $row['nomb_user'];        
        $apellido = $row['apell_user'];
        $telefono = $row['telf_user'];
        $correo = $row['correo_user'];
    }
?>
<div class="container-fluid">                
    <div class="row">
        
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Datos de usuario</h1>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">MISIÓN INSTITUCIONAL</h5>
                                <p>La Institución Ciudad de Cuenca forma a los estudiantes de manera íntegra, con una mentalidad creadora, solidaria; conduciéndolos en el aprendizaje para todos, enseñanza significativa y aprendizaje perdurable; regulando su propio aprendizaje, desarrollando el pensamiento con suavidad y firmeza desde y para la vida individualizada, valorando el ecosistema, protegiéndolos en su diario vivir siendo incluyentes y diversos en la calidad y calidez educativa.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">VISIÓN INSTITUCIONAL</h5>
                                <p>La Institución Educativa fortalecerá y potenciará la enseñanza responsiva, logrando desarrollar la comunicación asertiva, el pensamiento crítico, la autoestima entre los educandos, participando activamente logrando promover los valores fundamentales como la justicia, innovación y solidaridad, siendo gestores de la educación de calidad y calidez promoviendo y preservando la convivencia armónica para el desarrollo integral de la persona, la familia y la comunidad.</p>
                            </div>
                        </div>
                    </div>

    </div>
</div>