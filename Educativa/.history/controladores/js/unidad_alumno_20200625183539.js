$(document).ready(function() {
    load(1);
});

function load(page) {
    var q = $("#q").val(); //q es el "id" de la barra de busqueda
    $("#loader").fadeIn('slow');
    $.ajax({
        url: '../../modelos/tablas/unidad_alumno.php?action=ajax&page=' + page + '&q=' + q, //carga tabla
        beforeSend: function(objeto) {
            $('#loader').html('<img src="././../../recursos/img/loader.gif"> Cargando...'); //circulo de carga
        },
        success: function(data) {
            $(".outer_div").html(data).fadeIn('slow'); //muestra resultados obtenidos
            $('#loader').html(''); //limpia circulo de carga al finalizar

        }
    })
}

function detalles(id) {
    var id_unidad = $("#id_unidad" + id).val(); //asignamos el input escondido de la tabla a una variable Js
    var n_unidad = $("#n_unidad" + id).val();
    var n_descri = $("#n_descri" + id).val();
    var seccion = $("#seccion" + id).val();
    var jornada = $("#jornada" + id).val();
    var estado = $("#estado" + id).val();

    $("#m_id_unidad").val(id_unidad); //Convertimos la variable Js a contenido legible para el modal
    $("#m_n_unidad").val(n_unidad);
    $("#m_n_descri").val(n_descri);
    $("#m_seccion").val(seccion);
    $("#m_jornada").val(jornada);
    $("#m_estado").val(estado);
}