$(document).ready(function() {
    load(1);

    //LIMPIA MODALES CUANDO SE OCULTAN
    $('#uniInfo').on('hidden.bs.modal', function(e) { //ID DEL MODAL
        $('#edita_uni').trigger("reset"); //ID DEL FORM
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
    $('#guarda_Unidad').attr("disabled", true);
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "../controladores/funciones/nueva_unidad.php",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#guarda_Unidad').attr("disabled", true);
            $("#resultados_ajax_n").html("Realizando cambios, por favor espere...");
        },
        success: function(datos) {
            $("#resultados_ajax_n").html(datos);
            $('#guarda_Unidad').attr("disabled", false);
            load(1);
            setTimeout(esconde_modal_n, 2000);
        }
    });
    event.preventDefault();
})

function esconde_modal_n() {
    $('#uniNew').modal('hide');
    $("#resultados_ajax_n").html("");
}

//EDITAR UNIDAD (ENVIO DE DATOS Y ARCHIVOS)
$("#edita_uni").submit(function(event) {
    $('#edita_Unidad').attr("disabled", true);
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "../controladores/funciones/editar_unidad.php",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#edita_Unidad').attr("disabled", true);
            $("#resultados_ajax_i").html("Realizando cambios, por favor espere...");
        },
        success: function(datos) {
            $("#resultados_ajax_i").html(datos);
            $('#edita_Unidad').attr("disabled", false);
            load(1);
            setTimeout(esconde_modal_i, 2000);
        }
    });
    event.preventDefault();
})

function esconde_modal_i() {
    $('#uniInfo').modal('hide');
    $("#resultados_ajax_i").html("");
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