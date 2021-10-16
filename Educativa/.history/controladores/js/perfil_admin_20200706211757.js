//EDITAR PERFIL
$("#datos_usuario").submit(function(event) {
    $('#actualizaUsuario').attr("disabled", true);

    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "ajax/editar_perfil_invest.php",
        data: parametros,
        beforeSend: function(objeto) {
            $("#resultados_ajax_I").html("Mensaje: Cargando...");
        },
        success: function(datos) {
            $("#resultados_ajax_I").html(datos);
            $('#actualizaUsuario').attr("disabled", false);
            setTimeout(refrescar, 1000);
        }
    });
    event.preventDefault();
})

//FUNCIÓN PARA RECARGAR LA PÁGINA
function refrescar() {
    location.reload();
}