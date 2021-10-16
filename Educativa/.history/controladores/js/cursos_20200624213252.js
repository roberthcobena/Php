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
$("#edita_curso").submit(function(event) { //NOMBRE DEL FORM
    $('#guarda_Curso').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT
    alert("Funciona?");
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "../controladores/funciones/editar_curso.php", //ARCHIVO CON SQL DE EDICIÓN
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