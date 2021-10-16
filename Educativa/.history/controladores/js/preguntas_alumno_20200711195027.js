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

            funcionando()
        }
    })
}

function funcionando() {
    var fecha = $("#inicio").val();
    var inicio = new Date(fecha);
    // obteneos la fecha actual
    var actual = new Date().getTime();

    // obtenemos la diferencia entre la fecha actual y la de inicio
    var diff = new Date(actual - inicio);

    // mostramos la diferencia entre la fecha actual y la inicial
    var result = "&nbsp;" + LeadingZero(diff.getUTCMinutes()) + "&nbsp;minutos&nbsp;" + LeadingZero(diff.getUTCSeconds()) + "&nbsp;segundos";
    document.getElementById('crono').innerHTML = result;

    // Indicamos que se ejecute esta función nuevamente dentro de 1 segundo
    timeout = setTimeout("funcionando()", 1000);
}

/* Funcion que pone un 0 delante de un valor si es necesario */
function LeadingZero(Time) {
    return (Time < 10) ? "0" + Time : +Time;
}

//GUARDA RESPUESTAS
$("#fin_taller").submit(function() { //NOMBRE DEL FORM
    $('#fin_taller').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT
    $.ajax({
        type: "POST",
        url: "../../controladores/funciones/nueva_pregunta.php", //ARCHIVO CON SQL DE REGISTRO
        data: $(this).serialize(),
        beforeSend: function() {
            $('#fin_taller').attr("disabled", true); //DESACTIVAMOS BOTÓN MIENTRAS SE EJECUTA ORDEN 
            $("#resultados_ajax_n").html("Realizando cambios, por favor espere..."); //MENSAJES DE ESPERA, ÉXITO O ERROR
        },
        success: function(datos) {
            $("#resultados_ajax_n").html(datos);
            $('#fin_taller').attr("disabled", false);
            load(1); //Recarga la tabla detrás del modal
            setTimeout(termina_taller, 2000); //LLAMAMOS A FUNCIÓN QUE ESCONDE MODAL, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})


function termina_taller() {
    $("#resultados_ajax_n").html(""); //LIMPIAMOS MENSAJES
}