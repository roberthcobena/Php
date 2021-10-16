$(document).ready(function() {
    load(1);
    $('#talInfo').on('hidden.bs.modal', function(e) { //ID DEL MODAL
        $('#edita_tall').trigger("reset"); //ID DEL FORM
    })
    $('#talNew').on('hidden.bs.modal', function(e) {
        $('#nueva_tall').trigger("reset");
    })
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
    var idcurso = $("#idcurso").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url: '../../modelos/tablas/aula_alumno.php?action=ajax&page=' + page + '&q=' + q + '&idcurso=' + idcurso,
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
    var tema = $("#tem" + id).val();
    var curso = $("#cur" + id).val();
    var nombre = $("#taller" + id).val();
    var inicio = $("#inicio" + id).val();
    var fin = $("#fin" + id).val();
    var estado = $("#estado" + id).val();

    $("#m_id").val(id);
    $("#m_tema").val(tema);
    $("#m_curso").val(curso);
    $("#m_nombre").val(nombre);
    $("#m_inicio").val(inicio);
    $("#m_fin").val(fin);
    $("#m_estado").val(estado);
}

$("#edita_tall").submit(function(event) { //NOMBRE DEL FORM
    $('#guarda_Tall').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT    
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "../../controladores/funciones/editar_taller.php", //ARCHIVO CON SQL DE EDICIÓN
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#guarda_Tall').attr("disabled", true); //DESACTIVAMOS BOTÓN MIENTRAS SE EJECUTA ORDEN 
            $("#resultados_ajax").html("Realizando cambios, por favor espere..."); //MENSAJES DE ESPERA, ÉXITO O ERROR
        },
        success: function(datos) {
            $("#resultados_ajax").html(datos);
            $('#guarda_Tall').attr("disabled", false);
            load(1); //Recarga la tabla detrás del modal
            setTimeout(esconde_modal_edicion, 2000); //LLAMAMOS A FUNCIÓN QUE ESCONDE MODAL, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})

function esconde_modal_edicion() {
    $('#talInfo').modal('hide'); //ESCONDEMOS MODAL SEGÚN SU NOMBRE
    $("#resultados_ajax").html(""); //LIMPIAMOS MENSAJES
}

$("#nueva_tall").submit(function() { //NOMBRE DEL FORM
    $('#nuevo_Tall').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT
    $.ajax({
        type: "POST",
        url: "../../controladores/funciones/nuevo_taller.php", //ARCHIVO CON SQL DE REGISTRO
        data: $(this).serialize(),
        beforeSend: function() {
            $('#nuevo_Tall').attr("disabled", true); //DESACTIVAMOS BOTÓN MIENTRAS SE EJECUTA ORDEN 
            $("#resultados_ajax_n").html("Realizando cambios, por favor espere..."); //MENSAJES DE ESPERA, ÉXITO O ERROR
        },
        success: function(datos) {
            $("#resultados_ajax_n").html(datos);
            $('#nuevo_Tall').attr("disabled", false);
            load(1); //Recarga la tabla detrás del modal
            setTimeout(esconde_modal_nuevo, 2000); //LLAMAMOS A FUNCIÓN QUE ESCONDE MODAL, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})


function esconde_modal_nuevo() {
    $('#talNew').modal('hide'); //ESCONDEMOS MODAL SEGÚN SU NOMBRE
    $("#resultados_ajax_n").html(""); //LIMPIAMOS MENSAJES
}

//REALIZAR TALLER
function hacertaller(id) {
    var curso = $("#cur").val();
    event.preventDefault();
    if (confirm("Presione ACEPTAR para resolver taller *Tendrá 20 minutos para realizarlo*")) {
        $.ajax({
            type: "POST",
            url: "../../controladores/funciones/inicia_taller.php?id_taller=" + id,
            data: $(this).serialize(),
            data: "id_taller=" + id,
            success: function(datos) {
                $("#resultados_cierre_f").html(datos);
                window.location = './realizar_taller.php?id_taller=' + id + "&curso=" + curso;
            }
        });
    }
}