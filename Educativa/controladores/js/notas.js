$(document).ready(function() {
    load(1);
    carga(1);
});

function check(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[A-Za-z ñÑ]/;
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
    
    var idcurso = $("#idcurso").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url: '../../modelos/tablas/notas.php?action=ajax&page=' + page + '&idcurso=' + idcurso,
        beforeSend: function(objeto) {
            $('#loader').html('<img src="./../../recursos/img/loader.gif"> Cargando...');
        },
        success: function(data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
}

function carga(page) {
    var q = $("#q").val();
    var idcurso = $("#idcurso").val();
    $("#loader1").fadeIn('slow');
    $.ajax({
        url: '../../modelos/tablas/alum_promedio.php?action=ajax&page=' + page + '&q=' + q + '&idcurso=' + idcurso,
        beforeSend: function(objeto) {
            $('#loader1').html('<img src="./../../recursos/img/loader.gif"> Cargando...');
        },
        success: function(data) {
            $(".outer_div1").html(data).fadeIn('slow');
            $('#loader1').html('');

        }
    })
}


$("#promediot").submit(function() { //NOMBRE DEL FORM
    $('#descargar').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT
    $.ajax({
        type: "POST",
        url: "../../controladores/funciones/filtrotema.php", //ARCHIVO CON SQL DE REGISTRO
        data: $(this).serialize(),
        beforeSend: function() {
            $('#descargar').attr("disabled", true); //DESACTIVAMOS BOTÓN MIENTRAS SE EJECUTA ORDEN 
            $("#resultados_ajax_t").html("Realizando reporte, por favor espere..."); //MENSAJES DE ESPERA, ÉXITO O ERROR
        },
        success: function(datos) {
            $("#resultados_ajax_t").html(datos);
            $('#descargar').attr("disabled", false);
            load(1); //Recarga la tabla detrás del modal
        }
    });
    event.preventDefault();
})




//GESTIÓN
function imprimir_reporte(id, tema, est) {
    VentanaCentrada('../../recursos/pdf/Promedios/ver-reporte.php?id_curso=' + id,'tema=' + tema,'est=' + est, 'Taller', '', '1024', '768', 'true');
}

function imprimir_excel(id, tema, est) {
    location.href ='../../recursos/excel/promedio_Estudiantil.php?id_curso=' + id,'tema=' + tema,'est=' + serialize(est) ;
}

function imprimir_reporteU(id) {
    VentanaCentrada('../../recursos/pdf/unidades/ver-reporte.php?id_curso=' + id, 'Taller', '', '1024', '768', 'true');
}

function imprimir_excelU(id) {
    location.href ='../../recursos/excel/Promedio_temas.php?id_curso=' + id ;
}
