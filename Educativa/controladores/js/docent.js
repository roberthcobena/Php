$(document).ready(function() {
    load(1);
    $('#ddocInfo').on('hidden.bs.modal', function(e) { //ID DEL MODAL
        $('#edita_ddoc').trigger("reset"); //ID DEL FORM
    })
    $('#docNew').on('hidden.bs.modal', function(e) {
        $('#nuevo_doc').trigger("reset");
    })
});

var controladorTiempo = "";

function codigoAJAX() {
    var cad = document.getElementById("cedula").value.trim();
    var total = 0;
    var longitud = cad.length;
    var longcheck = longitud - 1;

    if (cad !== "" && longitud === 10){
      for(i = 0; i < longcheck; i++){
        if (i%2 === 0) {
          var aux = cad.charAt(i) * 2;
          if (aux > 9) aux -= 9;
          total += aux;
        } else {
          total += parseInt(cad.charAt(i)); // parseInt o concatenará en lugar de sumar
        }
      }

      total = total % 10 ? 10 - total % 10 : 0;

      if (cad.charAt(longitud-1) == total) {
        document.getElementById("salida").style.display="block";
        document.getElementById("salida2").style.display="none";
        $('#nuevo_Doc').attr("disabled", false);
    }else{
        document.getElementById("salida2").style.display="block";
        document.getElementById("salida").style.display="none";
        $('#nuevo_Doc').attr("disabled", true);
      }
    }
}

$("#cedula").on("keyup", function() {
    clearTimeout(controladorTiempo);
    controladorTiempo = setTimeout(codigoAJAX, 250);
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
        url: '../../modelos/tablas/docent.php?action=ajax&page=' + page + '&q=' + q,
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
    var ced = $("#ced" + id).val();
    var nombre = $("#nombre" + id).val();
    var apellido = $("#apellido" + id).val();
    var telf = $("#telf" + id).val();
    var correo = $("#correo" + id).val();
    var titulo = $("#titulo" + id).val();
    var cargo = $("#car" + id).val();
    var usuario = $("#usuario" + id).val();
    var clave = $("#clave" + id).val();
    var estado = $("#estado" + id).val();

    $("#m_id").val(id);
    $("#m_cedula").val(ced);
    $("#m_nombre").val(nombre);
    $("#m_apellido").val(apellido);
    $("#m_telf").val(telf);
    $("#m_correo").val(correo);
    $("#m_titulo").val(titulo);
    $("#m_cargo").val(cargo);
    $("#m_usuario").val(usuario);
    $("#m_clave").val(clave);
    $("#m_estado").val(estado);
}

$("#edita_ddoc").submit(function(event) { //NOMBRE DEL FORM
    $('#guarda_dDoc').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT    
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "../../controladores/funciones/edita_ddoc.php", //ARCHIVO CON SQL DE EDICIÓN
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $('#guarda_dDoc').attr("disabled", true); //DESACTIVAMOS BOTÓN MIENTRAS SE EJECUTA ORDEN 
            $("#resultados_ajax").html("Realizando cambios, por favor espere..."); //MENSAJES DE ESPERA, ÉXITO O ERROR
        },
        success: function(datos) {
            $("#resultados_ajax").html(datos);
            $('#guarda_dDoc').attr("disabled", false);
            load(1); //Recarga la tabla detrás del modal
            setTimeout(esconde_modal_edicion, 2000); //LLAMAMOS A FUNCIÓN QUE ESCONDE MODAL, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})

function esconde_modal_edicion() {
    $('#ddocInfo').modal('hide'); //ESCONDEMOS MODAL SEGÚN SU NOMBRE
    $("#resultados_ajax").html(""); //LIMPIAMOS MENSAJES
}

$("#nuevo_doc").submit(function() { //NOMBRE DEL FORM
    $('#nuevo_Doc').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT
    $.ajax({
        type: "POST",
        url: "../../controladores/funciones/nuevo_doc.php", //ARCHIVO CON SQL DE REGISTRO
        data: $(this).serialize(),
        beforeSend: function() {
            $('#nuevo_Doc').attr("disabled", true); //DESACTIVAMOS BOTÓN MIENTRAS SE EJECUTA ORDEN 
            $("#resultados_ajax_n").html("Realizando cambios, por favor espere..."); //MENSAJES DE ESPERA, ÉXITO O ERROR
        },
        success: function(datos) {
            $("#resultados_ajax_n").html(datos);
            $('#nuevo_Doc').attr("disabled", false);
            load(1); //Recarga la tabla detrás del modal
            setTimeout(esconde_modal_nuevo, 2000); //LLAMAMOS A FUNCIÓN QUE ESCONDE MODAL, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})


function esconde_modal_nuevo() {
    $('#docNew').modal('hide'); //ESCONDEMOS MODAL SEGÚN SU NOMBRE
    $("#resultados_ajax_n").html(""); //LIMPIAMOS MENSAJES
}
