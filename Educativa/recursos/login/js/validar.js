// JavaScript Document
var expr = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
var expr1 = /^[a-zA-ZñÑ ]*$/;
 
$(document).ready(function () {
    $("#registrar").click(function (){ 
        var nombre = $("#nombre").val();
        var apellidos = $("#apellido").val();
        var usuario = $("#username").val();
        var pass = $("#pass").val();
        var repass = $("#repass").val();
 
        //Secuencia de if's para verificar contenido de los inputs
 
        //Verifica que no este vacío y que sean letras
        if(nombre == "" || !expr1.test(nombre)){
            $("#mensaje1").fadeIn("slow"); //Muestra mensaje de error
            return false;                  // con false sale de la secuencia
        }
        else{
            $("#mensaje1").fadeOut();
 
            if(apellidos == "" || !expr1.test(apellidos)){
                $("#mensaje2").fadeIn("slow");
                return false;
            }
            else{
                $("#mensaje2").fadeOut();
 
            }
        }
 
    });
	
	
    $("#nombre, #apellidos, #usuario").keyup(function(){
        if( $(this).val() != "" && expr1.test($(this).val())){
            $("#mensaje1, #mensaje2, #mensaje3").fadeOut();
            return false;
        }
    });
 
    var valido=false;
    $("#repass").keyup(function(e) {
        var pass = $("#pass").val();
        var re_pass=$("#repass").val();
 
        if(pass != re_pass)
        {
            $("#repass").css({"background":"#F22" }); //El input se pone rojo
            $("#mensaje6").fadeIn("slow");;
            valido=true;
        }
        else if(pass == re_pass)
        {
            $("#repass").css({"background":"#8F8"}); //El input se ponen verde
            $("#mensaje6").fadeOut();
            valido=true;
        }
    });//fin keyup repass
	
 
});//fin ready