
$(document).ready(function() {
    $("#dialogo").draggable();
    /*$("#dialogo").mousedown(moverDialogo);*/
    $("#btn-modal").click(mostrarModal)
    $(".dialogo .cerrar").click(cerrarModal);
    $("#mascara").click(cerrarModal2);

    $(".tbl-acordeon .encabezado a").click(expandirFilasAnios);
     $(".tbl-acordeon .encabezado-anio a").click(expandirFilas);
      $(".tbl-acordeon .encabezado-anioplan a").click(expandirFilas);
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
function mostrarModal() {

//	e.preventDefault();

    // agrega la máscara oscura a la página
/*    
    var mascAlto = $(document).height();
    var mascAncho = $(document).width();

    $("#mascara").css({"width": mascAncho, "height": mascAlto});
    $("#mascara").fadeIn(800);
    $("#mascara").fadeTo("slow", 0.8);
*/
    // centra el formualrio
    var alto = $(window).height();
    var ancho = $(window).width();

    // nombre de la ventana, o clase
    var busco = "#dialogo";
    $(busco).css("top", alto / 2 - $(busco).height() / 2);
    $(busco).css("left", ancho / 2 - $(busco).width() / 2);
    // muestra la ventana
    $(busco).fadeIn(1000);

    // muestra la ventana
    $(busco).fadeIn();
}

function cerrarModal(e) {

    e.preventDefault();
    $(".dialogo").hide();
    //$("#mascara, .dialogo").hide();

}

function cerrarModal2() {
    $(this).hide();
    $(".dialogo").hide();
}
function expandirFilasAnios() {

    var plan = $(this).attr("data-valor");
    $(".encabezado-anio").each(function() {
        var ayp=$(this).data("compuesto");
         if ($(this).data("valor") == plan) {
        if ($(this).css("display") == "none") {
            $(this).show();
        } else {
            $(this).hide();
            cerrarFilas(ayp);
        }
         }
    });
}
function cerrarFilas(ayp) {
    $(".fila." + ayp).each(function() {
       
            $(this).hide();
        
    });
    }
function expandirFilas() {

    var anio = $(this).attr("data-valor");

    $(".fila." + anio).each(function() {
        if ($(this).css("display") == "none") {
            $(this).show();
        } else {
            $(this).hide();
        }
    });

    /*
     e.preventDefault();
     var anio=this.id;
     anio=anio.slice(3,4);
     var sitio=document.getElementById('urlBase').value;
     var elems = document.getElementsByClassName('asig'+anio);
     for (var i=0;i<elems.length;i+=1){
     if($('.asig'+anio)[i].style.display=='none'){
     document.getElementById("img"+anio).src=sitio+"public/img/menosNaranja.png";
     $('.asig'+anio)[i].style.display='';
     }else{
     $('.asig'+anio)[i].style.display='none'
     document.getElementById("img"+anio).src=sitio+"public/img/masNaranja.png";
     $('.formulario[data-anio="'+anio+'"]')[i].style.display='none';
     $('.aImg[data-anio="'+anio+'"]')[i].src=sitio+"public/img/search.png";
     //.style.display='none';
     }
     }
     // if(document.getElementsByClassName(.asig))
     */

}

function muestraFrm(e) {

    e.preventDefault();
    var sitio = document.getElementById('urlBase').value;
    var id = $(this).attr("data-valor");
    if (document.getElementById('frm' + id).style.display == 'none') {
        document.getElementById('frm' + id).style.display = '';
        $('.aImg[data-valor="' + id + '"]')[0].src = sitio + "public/img/veo.png";
        cargarPrevias(id);
    } else {
        document.getElementById('frm' + id).style.display = 'none'
        $('.aImg[data-valor="' + id + '"]')[0].src = sitio + "public/img/search.png";

    }

}

function cargarPrevias(idAsignatura) {
    var table = document.getElementById("tab" + idAsignatura);
    table.innerHTML = "";
    cnn = crearCnn();
    cnn.onreadystatechange = function() {

        if (cnn.readyState == 4) {
            var arr = cnn.responseText.split(";");
            for (var i = arr.length - 2; i >= 0; i--) {
                var previa = eval("(" + arr[i] + ")");

                if (previa.id != "") {


                    agregarFilaPrevia(previa, idAsignatura);

                }
            }
        }
    }
    var sitio = document.getElementById("urlBase").value;

    cnn.open("GET", sitio + "asignatura/obtener_previas_ajax/" + idAsignatura, true);
    cnn.send(null);
}

function agregarFilaPrevia(previa, idAsignatura) {
    var table = document.getElementById("tab" + idAsignatura);
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    cell1.colSpan.innerHTML = 3;
    cell1.innerHTML = previa.nombre;

}


function crearCnn() {
    var doc = null;

    if (window.ActiveXObject) {
        doc = new ActiveXObject("Microsoft.XMLHTTP");
        return doc;
    } else if (window.XMLHttpRequest) {
        doc = new XMLHttpRequest();
        return doc;
    } else
        return doc;

}

