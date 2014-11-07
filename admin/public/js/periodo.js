$(document).ready(function() {
       iniciar2();
   });
function iniciar2() {
    $(".aImg2").click(buscarAsignatura);
}


function buscarAsignatura() {

       var id=$(this).attr("data-valor");
       var plan=$(this).attr("data-plan");
       var anio=$(this).attr("data-anio");
       var periodo = $("#id_periodo").val();
       if(id.slice(1,3)!="UP"){
       var sitio = $("#urlBase").val()+"asignatura/ver_por_periodo/"+id+"/"+plan+"/"+anio+"/"+periodo+"/2/1/";

        $.ajax({
            url:sitio,
            dataType:"JSON",
            type:"GET",
            success:mostrarAsignatura,
            error:errorAsignatura
        });
        }else{
            var sitio = $("#urlBase").val()+"asignatura/ver_por_periodo/"+id+"/"+plan+"/"+anio+"/"+periodo+"/2/2/";

        $.ajax({
            url:sitio,
            dataType:"JSON",
            type:"GET",
            success:mostrarUnidad,
            error:errorAsignatura
        });
        }
            
}

function mostrarAsignatura(data) {

$("#nombre_asignatura").html(data.nombre);
$("#descripcion").html(data.escala.descripcion);
$("#min_aprobacion").html(data.escala.min_aprobacion);
var escala=" <tr> <td>  Numero  </td> <td>  Concepto  </td> <td>  Aprobado  </td></tr> ";
var nota;
for (nota in data.escala.notas ){
    
  /* escala+="<li>Numero: "+data.escala.notas[nota].numero+
           " Concepto: "+data.escala.notas[nota].concepto+
           " Aprobado: ";if(data.escala.notas[nota].aprobado==1){
               escala+="Aprobado"
           }else{
               escala+="No Aprobado";
           }
           escala+="</li> ";
           }*/
       
        escala+=" <tr> <td> "+ data.escala.notas[nota].numero+
                "</td> <td>"+ data.escala.notas[nota].concepto+
                 "</td> <td>";
                  if(data.escala.notas[nota].aprobado==1){
               escala+="Aprobado"
           }else{
               escala+="No Aprobado";
           }
           escala+="</td></tr> ";
           }
$("#lst-escala").html(escala);
var previa;
var listaPrevias=" ";
for (previa in data.previas){
     listaPrevias+=" <li> "+ data.previas[previa].nombre + " </li> ";
    
}
$("#lst-previas").html(listaPrevias);
mostrarModal();
}

function mostrarUnidad(data) {

$("#nombre_asignatura").html(data.nombre);
$("#descripcion").html(data.escala.descripcion);
$("#min_aprobacion").html(data.escala.min_aprobacion);
var escala=" <tr> <td>  Numero  </td> <td>  Concepto  </td> <td>  Aprobado  </td></tr> ";
var nota;
for (nota in data.escala.notas ){
    
  /* escala+="<li>Numero: "+data.escala.notas[nota].numero+
           " Concepto: "+data.escala.notas[nota].concepto+
           " Aprobado: ";if(data.escala.notas[nota].aprobado==1){
               escala+="Aprobado"
           }else{
               escala+="No Aprobado";
           }
           escala+="</li> ";
           }*/
       
        escala+=" <tr> <td> "+ data.escala.notas[nota].numero+
                "</td> <td>"+ data.escala.notas[nota].concepto+
                 "</td> <td>";
                  if(data.escala.notas[nota].aprobado==1){
               escala+="Aprobado"
           }else{
               escala+="No Aprobado";
           }
           escala+="</td></tr> ";
           }
$("#lst-escala").html(escala);
var previa;
var listaPrevias=" ";
for (previa in data.previas){
     listaPrevias+=" <li> "+ data.previas[previa] + " </li> ";
    
}
$("#lst-previas").html(listaPrevias);
var asignatura;
var listaAsignaturas=" ";
for (asignatura in data.asignaturas){
     listaAsignaturas+=" <li> "+ data.asignaturas[asignatura].nombre + " </li> ";
    
}
$("#lst-asignaturas").html(listaAsignaturas);
mostrarModal();
}

function errorAsignatura() {
    
}
