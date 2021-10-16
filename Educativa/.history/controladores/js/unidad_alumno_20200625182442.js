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