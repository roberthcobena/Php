$(document).ready(function() {
    load(1);

    //LIMPIA MODALES CUANDO SE OCULTAN
    $('#cursoInfo').on('hidden.bs.modal', function(e) { //ID DEL MODAL
        $('#edita_curso').trigger("reset"); //ID DEL FORM
    })

    $('#uniNew').on('hidden.bs.modal', function(e) {
        $('#nueva_unidad').trigger("reset");
    })
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
//ALMACENAR UNIDAD (ENVIO DE DATOS Y ARCHIVOS)
$("#nueva_unidad").submit(function(event) {
    $('#guardar_ef').attr("disabled", true);
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "../controladores/funciones/nuevo_curso.php",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#guardar_ef').attr("disabled", true);
            $("#resultados_ajax6").html("Realizando cambios, por favor espere...");
        },
        success: function(datos) {
            $("#resultados_ajax6").html(datos);
            $('#guardar_ef').attr("disabled", false);
            load(1);
            setTimeout(esconde_modal_n, 2000);
        }
    });
    event.preventDefault();
})

function esconde_modal_n() {
    $('#entregableFase').modal('hide');
    $("#resultados_ajax6").html("");
}

//VALIDACIÓN DE PORTADA NUEVA UNIDAD
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
//VALIDACIÓN DE PORTADA INFO UNIDAD
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