$("#datos_usuario").submit(function(event) {
    $('#actualizaUsuario').attr("disabled", true);

    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "../../controladores/funciones/editar_alumno_datos.php",
        data: parametros,
        beforeSend: function(objeto) {
            $("#resultados_ajax_Datos").html("Mensaje: Cargando...");
        },
        success: function(datos) {
            $("#resultados_ajax_Datos").html(datos);
            $('#actualizaUsuario').attr("disabled", false);
            setTimeout(refrescar, 2000);
        }
    });
    event.preventDefault();
})

//EDITAR CONTRASEÑA
$("#contra_usuario").submit(function(event) {
    $('#actualizaContra').attr("disabled", true);

    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "../../controladores/funciones/editar_alumno_contra.php",
        data: parametros,
        beforeSend: function(objeto) {
            $("#resultados_ajax_Contra").html("Mensaje: Cargando...");
        },
        success: function(datos) {
            $("#resultados_ajax_Contra").html(datos);
            $('#actualizaContra').attr("disabled", false);
            setTimeout(refrescarc, 2000);
        }
    });
    event.preventDefault();
})

//FUNCIÓN 
function refrescarc() {
    $("#resultados_ajax_Contra").html("");
}

function refrescar() {
    $("#resultados_ajax_Datos").html("");
    location.reload(true);
}