$(document).ready(function() {
    load(1);
    patrasno();
});

function check(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z ]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function checknum(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function load(page) {
    var q = $("#q").val();
    var idtaller = $("#idtaller").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url: '../../modelos/tablas/preguntas_alumno.php?action=ajax&page=' + page + '&q=' + q + '&idtaller=' + idtaller,
        beforeSend: function(objeto) {
            $('#loader').html('<img src="./../../recursos/img/loader.gif"> Cargando...');
        },
        success: function(data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
}

function detalles(id) {
    var id = $("#id" + id).val();
    var taller = $("#id_taller" + id).val();
    var pregunta = $("#pregunta" + id).val();
    var op1 = $("#op1" + id).val();
    var op2 = $("#op2" + id).val();
    var op3 = $("#op3" + id).val();
    var op4 = $("#op4" + id).val();
    var correcta = $("#correcta" + id).val();
    var estado = $("#estado" + id).val();

    $("#m_id").val(id);
    $("#m_taller").val(taller);
    $("#m_pregunta").val(pregunta);
    $("#m_op1").val(op1);
    $("#m_op2").val(op2);
    $("#m_op3").val(op3);
    $("#m_op4").val(op4);
    $("#m_correcta").val(correcta);
    $("#m_estado").val(estado);
}

//GUARDA TALLER
$("#nuevo_pregu").submit(function() { //NOMBRE DEL FORM
    $('#nuevo_pre').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT
    $.ajax({
        type: "POST",
        url: "../../controladores/funciones/nueva_pregunta.php", //ARCHIVO CON SQL DE REGISTRO
        data: $(this).serialize(),
        beforeSend: function() {
            $('#nuevo_pre').attr("disabled", true); //DESACTIVAMOS BOTÓN MIENTRAS SE EJECUTA ORDEN 
            $("#resultados_ajax_n").html("Realizando cambios, por favor espere..."); //MENSAJES DE ESPERA, ÉXITO O ERROR
        },
        success: function(datos) {
            $("#resultados_ajax_n").html(datos);
            $('#nuevo_pre').attr("disabled", false);
            load(1); //Recarga la tabla detrás del modal
            setTimeout(esconde_modal_nuevo, 5000); //LLAMAMOS A FUNCIÓN QUE ESCONDE MODAL, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})


function esconde_modal_nuevo() {
    $('#preguNew').modal('hide'); //ESCONDEMOS MODAL SEGÚN SU NOMBRE
    $("#resultados_ajax_n").html(""); //LIMPIAMOS MENSAJES
}

//NO PUEDE RETROCEDER
1

function patrasno() {
    window.location.hash = "no-back-button";
    window.location.hash = "Again-No-back-button" //chrome
    window.onhashchange = function() { window.location.hash = "no-back-button"; }
}