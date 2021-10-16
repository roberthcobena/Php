$(document).ready(function() {
    load(1);
});

function load(page) {
    var q = $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url: '../modelos/tablas/curso.php?action=ajax&page=' + page + '&q=' + q,
        beforeSend: function(objeto) {
            $('#loader').html('<img src="././../recursos/img/loader.gif"> Cargando...');
        },
        success: function(data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
}

function detalles(id) {
    var id = $("#id" + id).val();
    var curso = $("#curso" + id).val();
    var seccion = $("#seccion" + id).val();
    var jornada = $("#jornada" + id).val();
    var estado = $("#estado" + id).val();

    $("#m_id").val(id);
    $("#m_curso").val(curso);
    $("#m_seccion").val(seccion);
    $("#m_jornada").val(jornada);
    $("#m_estado").val(estado);
}

//EDITAR CON MODAL
$("#editar_fase").submit(function(event) { //NOMBRE DEL FORM
    $('#actualiza_fase').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "ajax/editar_fase.php", //ARCHIVO CON SQL DE EDICIÓN
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#actualiza_fase').attr("disabled", true); //DESACTIVAMOS BOTÓN MIENTRAS SE EJECUTA ORDEN 
            $("#resultados_ajax4").html("Realizando cambios, por favor espere..."); //MENSAJES DE ESPERA, ÉXITO O ERROR
        },
        success: function(datos) {
            $("#resultados_ajax4").html(datos);
            $('#actualiza_fase').attr("disabled", false);
            load(1);
            setTimeout(esconde_modal, 2000); //LLAMAMOS A FUNCIÓN QUE ESCONDE MODAL, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})

function esconde_modal() {
    $('#myModal7').modal('hide'); //ESCONDEMOS MODAL SEGÚN SU NOMBRE
    $("#resultados_ajax4").html(""); //LIMPIAMOS MENSAJES
}