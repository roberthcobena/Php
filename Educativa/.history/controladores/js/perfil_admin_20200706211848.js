//EDITAR PERFIL
$("#datos_usuario").submit(function(event) {
    $('#actualizaUsuario').attr("disabled", true);

    var parametros = $(this).serialize();
    $.ajax({
        type: "POST",
        url: "../funciones/editar_admin_datos.php",
        data: parametros,
        beforeSend: function(objeto) {
            $("#resultados_ajax_Datos").html("Mensaje: Cargando...");
        },
        success: function(datos) {
            $("#resultados_ajax_Datos").html(datos);
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