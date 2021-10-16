$(document).ready(function() {
    load(1);

    //LIMPIA MODALES CUANDO SE OCULTAN
    $('#destInfo').on('hidden.bs.modal', function(e) { //ID DEL MODAL
        $('edita_dest').trigger("reset"); //ID DEL FORM
    })

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
    var q = $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url: '../../modelos/tablas/curso_docente.php?action=ajax&page=' + page + '&q=' + q,
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
    var nombre = $("#nombre" + id).val();
    var apellido = $("#apellido" + id).val();
    var cur = $("#cur" + id).val();
    var usuario = $("#usuario" + id).val();
    var clave = $("#clave" + id).val();
    var estado = $("#estado" + id).val();

    $("#m_id").val(id);
    $("#m_nombre").val(nombre);
    $("#m_apellido").val(apellido);
    $("#m_curso").val(cur);
    $("#m_usuario").val(usuario);
    $("#m_clave").val(clave);
    $("#m_estado").val(estado);
}

$("#edita_dest").submit(function(event) { //NOMBRE DEL FORM
    $('#guarda_dEst').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT    
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "../../controladores/funciones/edita_dest.php", //ARCHIVO CON SQL DE EDICIÓN
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#guarda_dEst').attr("disabled", true); //DESACTIVAMOS BOTÓN MIENTRAS SE EJECUTA ORDEN 
            $("#resultados_ajax").html("Realizando cambios, por favor espere..."); //MENSAJES DE ESPERA, ÉXITO O ERROR
        },
        success: function(datos) {
            $("#resultados_ajax").html(datos);
            $('#guarda_dEst').attr("disabled", false);
            load(1); //Recarga la tabla detrás del modal
            setTimeout(esconde_modal_edicion, 2000); //LLAMAMOS A FUNCIÓN QUE ESCONDE MODAL, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})

function esconde_modal_edicion() {
    $('#destInfo').modal('hide'); //ESCONDEMOS MODAL SEGÚN SU NOMBRE
    $("#resultados_ajax").html(""); //LIMPIAMOS MENSAJES
}