//EDITAR CON MODAL
$("#edita_curso").submit(function(event) { //NOMBRE DEL FORM
    $('#guarda_Curso').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "funciones/editar_curso.php", //ARCHIVO CON SQL DE EDICIÓN
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#guarda_Curso').attr("disabled", true); //DESACTIVAMOS BOTÓN MIENTRAS SE EJECUTA ORDEN 
            $("#resultados_ajax").html("Realizando cambios, por favor espere..."); //MENSAJES DE ESPERA, ÉXITO O ERROR
        },
        success: function(datos) {
            $("#resultados_ajax").html(datos);
            $('#guarda_Curso').attr("disabled", false);
            load(1);
            setTimeout(esconde_modal, 2000); //LLAMAMOS A FUNCIÓN QUE ESCONDE MODAL, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})

function esconde_modal() {
    $('#cursoInfo').modal('hide'); //ESCONDEMOS MODAL SEGÚN SU NOMBRE
    $("#resultados_ajax").html(""); //LIMPIAMOS MENSAJES
}