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
    document.getElementById("m_portada").src = $("#imagen" + id).val();
    $("#m_estado").val(estado);
}

//ALMACENAR FOTO Y DATOS (VALIDACIÓN DE ARCHIVO)
$("#portada_u").change(function() {
    var file = this.files[0];
    var imagefile = file.type;
    var match = ["image/jpeg", "image/png", "image/jpg"];
    if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
        alert('Solo se aceptan los siguientes formatos de imagen: (JPEG/JPG/PNG).');
        $("#portada_u").val('');
        return false;
    }
});

$("#portada_info").change(function() {
    var file = this.files[0];
    var imagefile = file.type;
    var match = ["image/jpeg", "image/png", "image/jpg"];
    if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
        alert('Solo se aceptan los siguientes formatos de imagen: (JPEG/JPG/PNG).');
        $("#portada_info").val('');
        return false;
    }
});