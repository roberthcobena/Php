//NUEVO REGISTRO
$("#nuevoUsuario").submit(function() { //NOMBRE DEL FORM
    $('#registro').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT
    $.ajax({
        type: "POST",
        url: "controladores/funciones/registro_usuario.php", //ARCHIVO CON SQL DE REGISTRO
        data: $(this).serialize(),
        beforeSend: function() {
            $('#registro').attr("disabled", true); //DESACTIVAMOS BOTÓN MIENTRAS SE EJECUTA ORDEN 
            $("#resultados_registro").html("Realizando registro, por favor espere..."); //MENSAJES DE ESPERA, ÉXITO O ERROR
        },
        success: function(datos) {
            $("#resultados_registro").html(datos);
            $('#registro').attr("disabled", false);
            setTimeout(redireccion, 4000); //LLAMAMOS A FUNCIÓN QUE NOS REDIRECCIONA, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})

function redireccion() {
    alert("SU REGISTRO SE HA COMPLETADO, YA PUEDE ACCEDER"); //AVISO
    window.locationf = "login.php"; //REDIRECCIONAMOS
}