$(document).ready(function() {
    load(1);
});

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
var inicio = 0;
var timeout = 0;

function empezarDetener(elemento) {
    if (timeout == 0) {
        // empezar el cronometro

        elemento.value = "Detener";
        elemento.css("display", "none");
        // Obtenemos el valor actual
        inicio = vuelta = new Date().getTime();

        // iniciamos el proceso
        funcionando();
    } else {
        // detemer el cronometro

        elemento.value = "Empezar";
        clearTimeout(timeout);
        timeout = 0;
    }
}

function funcionando() {
    // obteneos la fecha actual
    var actual = new Date().getTime();

    // obtenemos la diferencia entre la fecha actual y la de inicio
    var diff = new Date(actual - inicio);

    // mostramos la diferencia entre la fecha actual y la inicial
    var result = LeadingZero(diff.getUTCHours()) + ":" + LeadingZero(diff.getUTCMinutes()) + ":" + LeadingZero(diff.getUTCSeconds());
    document.getElementById('crono').innerHTML = result;

    // Indicamos que se ejecute esta función nuevamente dentro de 1 segundo
    timeout = setTimeout("funcionando()", 1000);
}

/* Funcion que pone un 0 delante de un valor si es necesario */
function LeadingZero(Time) {
    return (Time < 10) ? "0" + Time : +Time;
}

//GUARDA RESPUESTAS
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