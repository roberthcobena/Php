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
            setTimeout(redireccion, 1000); //LLAMAMOS A FUNCIÓN QUE NOS REDIRECCIONA, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})

function redireccion() {
    alert("SU REGISTRO SE HA COMPLETADO, YA PUEDE ACCEDER"); //AVISO
    window.location = "login.php"; //REDIRECCIONAMOS
}

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