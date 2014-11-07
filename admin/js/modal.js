
$(document).ready(function() {
    $("#dialogo").draggable();
	/*$("#dialogo").mousedown(moverDialogo);*/
    $("#btn-modal").click(mostrarModal)
	$(".dialogo .cerrar").click(cerrarModal);
    $("#mascara").click(cerrarModal2);
});

/*
function moverDialogo() {

    $(this).addClass("arrastrable").parents().on(
	 "mousemove",function(e) {

	$(".dialogo").offset({
        top:  e.pageY - $(".dialogo").outerHeight()/2,
        left: e.pageX - $(".dialogo").outerWidth()/2 
    }).on("mouseup",function() {
         $(".arrastrable").removeClass("arrastrable"); 
    });

	e.preventDefault();	
});

}
*/


// muestra el diálogo modal
function mostrarModal(e) {

	e.preventDefault();

	// agrega la máscara oscura a la página
	var mascAlto  = $(document).height();
	var mascAncho = $(document).width();
    
/*
    $("#mascara").css({"width":mascAncho, "height": mascAlto});

    $("#mascara").fadeIn(800);
	$("#mascara").fadeTo("slow",0.8);   
*/    
    // centra el formualrio
    var alto  = $(window).height();
    var ancho = $(window).width();

	// nombre de la ventana, o clase
    var busco = "#dialogo";
    $(busco).css("top" , alto/2- $(busco).height()/2);
    $(busco).css("left",ancho/2- $(busco).width()/2);
/*
	// muestra la ventana
    $(busco).fadeIn(1000);

*/
    // muestra la ventana
    $(busco).fadeIn();
}

function cerrarModal(e) {
	
e.preventDefault();
$("#mascara, .dialogo").hide();

}

function cerrarModal2() {
	$(this).hide();
    $(".dialogo").hide();
}

