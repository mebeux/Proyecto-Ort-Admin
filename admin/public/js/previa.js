
function inic() {
    $("#menu2 a").click(enviar);
}

function enviar() {
    var fnc = $(this).attr("data-func");
    var valor = $(this).attr("data-valor");

    if (fnc=="actas") {
        enviarConsulta(valor);
    }
    
}

function mostrarEsperar() {
    $(".aviso").show();
}

function ocultarEsperar() {
    $(".aviso").hide();
}

function mostrarError() {
    $(".error").show();
}


function enviarConsulta(plan) {

    var url = $("#urlBase").val();
    
    url += "previa/plan/"+ plan;
    
    $.ajax({
        async:true,
        url: url,
        type:"GET",
        dataType:"JSON",
        beforeSend:mostrarEsperar,
        success:mostrarInforme,
        error:mostrarError,
    });
    
    return false;
}

function mostrarInforme(datos) {

    ocultarEsperar();
    
    $("#tbl-informe").remove("td");
    
    $.each(datos,function(i,estudiante) { 
        
        var fila = $("<tr/>");
        var celda = $("<td/>").html(estudiante.id_estudiante);
        $(fila).append(celda);
        var celda = $("<td/>").html(estudiante.nombre);
        $(fila).append(celda);
        $("#tbl-informe").append(fila);
    });
}


