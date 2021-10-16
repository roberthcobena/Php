$(document).ready(function() {
    load(1);
    
    $('#temaInfo').on('hidden.bs.modal', function(e) { //ID DEL MODAL
        $('#edita_tema').trigger("reset"); //ID DEL FORM
    })

    $('#temaNew').on('hidden.bs.modal', function(e) {
        $('#nuevo_tema').trigger("reset");
    })
});

function load(page) {
    var q = $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url: '../modelos/tablas/tema.php?action=ajax&page=' + page + '&q=' + q,
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
    var unidad = $("#uni" + id).val();
    var tema = $("#tema" + id).val();
    var descripcion = $("#descripcion" + id).val();
    var estado = $("#estado" + id).val();

    $("#m_id").val(id);
    $("#m_unidad").val(unidad);
    $("#m_tema").val(tema);
    $("#m_descripcion").val(descripcion);
    $("#m_estado").val(estado);
}

$("#edita_tema").submit(function(event) { //NOMBRE DEL FORM
    $('#guarda_tema').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT    
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "../controladores/funciones/editar_tema.php", //ARCHIVO CON SQL DE EDICIÓN
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#guarda_tema').attr("disabled", true); //DESACTIVAMOS BOTÓN MIENTRAS SE EJECUTA ORDEN 
            $("#resultados_ajax").html("Realizando cambios, por favor espere..."); //MENSAJES DE ESPERA, ÉXITO O ERROR
        },
        success: function(datos) {
            $("#resultados_ajax").html(datos);
            $('#guarda_tema').attr("disabled", false);
            load(1); //Recarga la tabla detrás del modal
            setTimeout(esconde_modal_edicion, 2000); //LLAMAMOS A FUNCIÓN QUE ESCONDE MODAL, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})

function esconde_modal_edicion() {
    $('#temaInfo').modal('hide'); //ESCONDEMOS MODAL SEGÚN SU NOMBRE
    $("#resultados_ajax").html(""); //LIMPIAMOS MENSAJES
}


$("#nuevo_tema").submit(function() { //NOMBRE DEL FORM
    $('#nuevo_Tema').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT
    $.ajax({
        type: "POST",
        url: "../controladores/funciones/nuevo_tema.php", //ARCHIVO CON SQL DE REGISTRO
        data: $(this).serialize(),
        beforeSend: function() {
            $('#nuevo_Tema').attr("disabled", true); //DESACTIVAMOS BOTÓN MIENTRAS SE EJECUTA ORDEN 
            $("#resultados_ajax_n").html("Realizando cambios, por favor espere..."); //MENSAJES DE ESPERA, ÉXITO O ERROR
        },
        success: function(datos) {
            $("#resultados_ajax_n").html(datos);
            $('#nuevo_Tema').attr("disabled", false);
            load(1); //Recarga la tabla detrás del modal
            setTimeout(esconde_modal_nuevo, 2000); //LLAMAMOS A FUNCIÓN QUE ESCONDE MODAL, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})

function esconde_modal_nuevo() {
    $('#temaNew').modal('hide'); //ESCONDEMOS MODAL SEGÚN SU NOMBRE
    $("#resultados_ajax_n").html(""); //LIMPIAMOS MENSAJES
}