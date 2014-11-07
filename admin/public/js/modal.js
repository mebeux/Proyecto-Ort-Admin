
$(document).ready(function() {
    $("#dialogo").draggable();
	/*$("#dialogo").mousedown(moverDialogo);*/
        if($('.indi').length > 0){
             $(".btn").click(mostrarPlan)
        }else{
            $(".btn").click(mostrarModal)
        }

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

function mostrarPlan(e){
 e.preventDefault();

    var id_plan= this.name;
     var sitio= document.getElementById("urlBase").value;
      window.location= sitio+"index.php/plan/traer_plan/"+id_plan;
}
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
       var sitio= document.getElementById("urlBase").value;
    //$(busco).load(sitio+"views/plan/asignatura_datos");
  $(busco).textContent="<a href=# class=\"cerrar\">cerrar</a><p>Hola<p>";
  // $(busco).body.innerHTML="<a href=# class=\"cerrar\">cerrar</a><p>Hola<p>";
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

