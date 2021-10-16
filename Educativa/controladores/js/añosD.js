$(document).ready(function() {
    load(1);

    //LIMPIA MODALES CUANDO SE OCULTAN
    $('#añoInfo').on('hidden.bs.modal', function(e) { //ID DEL MODAL
        $('#edita_año').trigger("reset"); //ID DEL FORM
    })

    $('#añoNew').on('hidden.bs.modal', function(e) {
        $('#nuevo_año').trigger("reset");
    })
});

function load(page) {
    var q = $("#q").val(); //q es el "id" de la barra de busqueda
    $("#loader").fadeIn('slow');
    $.ajax({
        url: '../../modelos/tablas/años.php?action=ajax&page=' + page + '&q=' + q, //carga tabla
        beforeSend: function(objeto) {
            $('#loader').html('<img src="./../../recursos/img/loader.gif"> Cargando...'); //circulo de carga
        },
        success: function(data) {
            $(".outer_div").html(data).fadeIn('slow'); //muestra resultados obtenidos
            $('#loader').html(''); //limpia circulo de carga al finalizar

        }
    })
}

function detalles(id) {
    var id = $("#id" + id).val(); //asignamos el input escondido de la tabla a una variable Js
    var año = $("#anio" + id).val();
    var desde = $("#desde" + id).val();
    var hasta = $("#hasta" + id).val();
    var estado = $("#estado" + id).val();

    $("#m_id").val(id); //Convertimos la variable Js a contenido legible para el modal
    $("#m_año").val(año);
    $("#m_desde").val(desde);
    $("#m_hasta").val(hasta);
    $("#m_estado").val(estado);
}

//EDITAR CON MODAL
$("#edita_año").submit(function(event) { //NOMBRE DEL FORM
    $('#guarda_Año').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT    
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "../../controladores/funciones/editar_año.php", //ARCHIVO CON SQL DE EDICIÓN
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
            $('#guarda_Año').attr("disabled", false);
            load(1); //Recarga la tabla detrás del modal
            setTimeout(esconde_modal_edicion, 2000); //LLAMAMOS A FUNCIÓN QUE ESCONDE MODAL, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})

function esconde_modal_edicion() {
    $('#añoInfo').modal('hide'); //ESCONDEMOS MODAL SEGÚN SU NOMBRE
    $("#resultados_ajax").html(""); //LIMPIAMOS MENSAJES
}

//NUEVO REGISTRO
$("#nuevo_año").submit(function() { //NOMBRE DEL FORM
    $('#nuevo_Año').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT
    $.ajax({
        type: "POST",
        url: "../../controladores/funciones/nuevo_año.php", //ARCHIVO CON SQL DE REGISTRO
        data: $(this).serialize(),
        beforeSend: function() {
            $('#nuevo_Año').attr("disabled", true); //DESACTIVAMOS BOTÓN MIENTRAS SE EJECUTA ORDEN 
            $("#resultados_ajax_n").html("Realizando cambios, por favor espere..."); //MENSAJES DE ESPERA, ÉXITO O ERROR
        },
        success: function(datos) {
            $("#resultados_ajax_n").html(datos);
            $('#nuevo_Año').attr("disabled", false);
            load(1); //Recarga la tabla detrás del modal
            setTimeout(esconde_modal_nuevo, 2000); //LLAMAMOS A FUNCIÓN QUE ESCONDE MODAL, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})

function esconde_modal_nuevo() {
    $('#añoNew').modal('hide'); //ESCONDEMOS MODAL SEGÚN SU NOMBRE
    $("#resultados_ajax_n").html(""); //LIMPIAMOS MENSAJES
}