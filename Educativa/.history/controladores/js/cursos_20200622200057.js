$(document).ready(function() {
    load(1);
});

function load(page) {
    var q = $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url: '../modelos/tablas/b_contratistas.php?action=ajax&page=' + page + '&q=' + q,
        beforeSend: function(objeto) {
            $('#loader').html('<img src="././../recursos/dist/img/loader.gif"> Cargando...');
        },
        success: function(data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
}

function detalles(id) {
    var id = $("#id" + id).val();
    var nombre = $("#nombre" + id).val();
    var estado = $("#estado" + id).val();

    $("#m_id").val(id);
    $("#m_nombre").val(nombre);
    document.getElementById("m_logo").src = $("#logo" + id).val();
    $("#m_estado").val(estado);
}