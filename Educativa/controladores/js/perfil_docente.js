function check(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z ñÑ]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
} 

//EDITAR PERFIL
$("#datos_usuario").submit(function(event) {
    $('#actualizaUsuario').attr("disabled", true);

    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "../../controladores/funciones/editar_docente_datos.php",
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
        url: "../../controladores/funciones/editar_docente_contra.php",
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
}