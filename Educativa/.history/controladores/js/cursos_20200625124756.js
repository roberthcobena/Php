$(document).ready(function() {
    load(1);

    //LIMPIA MODALES CUANDO SE OCULTAN
    $('#cursoInfo').on('hidden.bs.modal', function(e) { //ID DEL MODAL
        $('#edita_curso').trigger("reset"); //ID DEL FORM
    })

    $('#cursoNew').on('hidden.bs.modal', function(e) {
        $('#nuevo_curso').trigger("reset");
    })
});

function load(page) {
    var q = $("#q").val(); //q es el "id" de la barra de busqueda
    $("#loader").fadeIn('slow');
    $.ajax({
        url: '../modelos/tablas/curso.php?action=ajax&page=' + page + '&q=' + q, //carga tabla
        beforeSend: function(objeto) {
            $('#loader').html('<img src="././../recursos/img/loader.gif"> Cargando...'); //circulo de carga
        },
        success: function(data) {
            $(".outer_div").html(data).fadeIn('slow'); //muestra resultados obtenidos
            $('#loader').html(''); //limpia circulo de carga al finalizar

        }
    })
}

function detalles(id) {
    var id = $("#id" + id).val(); //asignamos el input escondido de la tabla a una variable Js
    var codigo = $("#cod" + id).val();
    var curso = $("#curso" + id).val();
    var seccion = $("#seccion" + id).val();
    var jornada = $("#jornada" + id).val();
    var estado = $("#estado" + id).val();

    $("#m_id").val(id); //Convertimos la variable Js a contenido legible para el modal
    $("#m_cod").val(codigo);
    $("#m_curso").val(curso);
    $("#m_seccion").val(seccion);
    $("#m_jornada").val(jornada);
    $("#m_estado").val(estado);
}

//EDITAR CON MODAL
$("#edita_curso").submit(function(event) { //NOMBRE DEL FORM
    $('#guarda_Curso').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT    
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
            load(1); //Recarga la tabla detrás del modal
            setTimeout(esconde_modal_edicion, 2000); //LLAMAMOS A FUNCIÓN QUE ESCONDE MODAL, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})

function esconde_modal_edicion() {
    $('#cursoInfo').modal('hide'); //ESCONDEMOS MODAL SEGÚN SU NOMBRE
    $("#resultados_ajax").html(""); //LIMPIAMOS MENSAJES
}

//NUEVO REGISTRO
$("#nuevo_curso").submit(function() { //NOMBRE DEL FORM
    $('#nuevo_Curso').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT
    $.ajax({
        type: "POST",
        url: "../controladores/funciones/nuevo_curso.php", //ARCHIVO CON SQL DE REGISTRO
        data: $(this).serialize(),
        beforeSend: function() {
            $('#nuevo_Curso').attr("disabled", true); //DESACTIVAMOS BOTÓN MIENTRAS SE EJECUTA ORDEN 
            $("#resultados_ajax_n").html("Realizando cambios, por favor espere..."); //MENSAJES DE ESPERA, ÉXITO O ERROR
        },
        success: function(datos) {
            $("#resultados_ajax_n").html(datos);
            $('#nuevo_Curso').attr("disabled", false);
            load(1); //Recarga la tabla detrás del modal
            setTimeout(esconde_modal_nuevo, 2000); //LLAMAMOS A FUNCIÓN QUE ESCONDE MODAL, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})

function esconde_modal_nuevo() {
    $('#cursoNew').modal('hide'); //ESCONDEMOS MODAL SEGÚN SU NOMBRE
    $("#resultados_ajax_n").html(""); //LIMPIAMOS MENSAJES
}