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
            carga();
        }
    })
}

//Cronometro
var cronometro;

function detenerse() {
    clearInterval(cronometro);
}

function carga() {
    contador_s = 0;
    contador_m = 0;
    s = document.getElementById("segundos");
    m = document.getElementById("minutos");

    cronometro = setInterval(
        function() {
            if (contador_s == 60) {
                contador_s = 0;
                contador_m++;
                m.innerHTML = contador_m;

                if (contador_m == 60) {
                    contador_m = 0;
                }
            }

            s.innerHTML = contador_s;
            contador_s++;

        }, 1000);

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