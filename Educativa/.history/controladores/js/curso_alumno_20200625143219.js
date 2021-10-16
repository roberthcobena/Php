$(document).ready(function() {
    load(1);

    //LIMPIA MODALES CUANDO SE OCULTAN   
    $('#matriNew').on('hidden.bs.modal', function(e) {
            $('#nuevo_matricula').trigger("reset");
        })
        // id de alumno para matricula
    function nueva_matric(id) {
        var alumno = $("#alumno" + id).val();

        $("#m_alumno").val(alumno);
    }
});

function load(page) {
    var q = $("#q").val(); //q es el "id" de la barra de busqueda
    $("#loader").fadeIn('slow');
    $.ajax({
        url: '../../modelos/tablas/curso_alumno.php?action=ajax&page=' + page + '&q=' + q, //carga tabla
        beforeSend: function(objeto) {
            $('#loader').html('<img src="././../../recursos/img/loader.gif"> Cargando...'); //circulo de carga
        },
        success: function(data) {
            $(".outer_div").html(data).fadeIn('slow'); //muestra resultados obtenidos
            $('#loader').html(''); //limpia circulo de carga al finalizar

        }
    })
}


//NUEVA MATRICULA
$("#nuevo_matricula").submit(function() { //NOMBRE DEL FORM
    $('#nuevo_Matri').attr("disabled", true); //NOMBRE DE BOTÓN QUE HACE SUBMIT
    $.ajax({
        type: "POST",
        url: "../../controladores/funciones/nueva_matricula.php", //ARCHIVO CON SQL DE REGISTRO
        data: $(this).serialize(),
        beforeSend: function() {
            $('#nuevo_Matri').attr("disabled", true); //DESACTIVAMOS BOTÓN MIENTRAS SE EJECUTA ORDEN 
            $("#resultados_ajax_ma").html("Realizando cambios, por favor espere..."); //MENSAJES DE ESPERA, ÉXITO O ERROR
        },
        success: function(datos) {
            $("#resultados_ajax_ma").html(datos);
            $('#nuevo_Matri').attr("disabled", false);
            load(1); //Recarga la tabla detrás del modal
            setTimeout(esconde_modal_matri, 2000); //LLAMAMOS A FUNCIÓN QUE ESCONDE MODAL, TIEMPO (1000 = 1 SEGUNDO)
        }
    });
    event.preventDefault();
})

function esconde_modal_matri() {
    $('#matriNew').modal('hide'); //ESCONDEMOS MODAL SEGÚN SU NOMBRE
    $("#resultados_ajax_ma").html(""); //LIMPIAMOS MENSAJES
}