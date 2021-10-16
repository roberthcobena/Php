$(document).ready(function() {
    load(1);
});

function load(page) {
    var q = $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url: '../modelos/tablas/unidad.php?action=ajax&page=' + page + '&q=' + q,
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
    var unidad = $("#unidad" + id).val();
    var descripcion = $("#descripcion" + id).val();
    var estado = $("#estado" + id).val();

    $("#m_id").val(id);
    $("#m_unidad").val(unidad);
    $("#m_descripcion").val(descripcion);
    document.getElementById("m_logo").src = $("#imagen" + id).val();
    $("#m_estado").val(estado);
}