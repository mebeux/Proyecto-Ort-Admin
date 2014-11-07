
   $(document).ready(function() {
       iniciar();
   });
function iniciar() {
    $(".aImg").click(buscarAsignatura);
}


function buscarAsignatura() {

       var id=$(this).attr("data-valor");
       var plan = $("#id_plan").val();

       var sitio = $("#urlBase").val()+"asignatura/ver_por_plan/"+id+"/"+plan+"/2";

        $.ajax({
            url:sitio,
            dataType:"JSON",
            type:"GET",
            success:mostrarAsignatura,
            error:errorAsignatura
        });

            
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

function errorAsignatura() {
    
}

/*  

	e.preventDefault();
         if( document.getElementById('frm'+id).style.display=='none'){
               document.getElementById('frm'+id).style.display='';
                $('.aImg[data-valor="'+id+'"]')[0].src=sitio+"public/img/veo.png";
               cargarPrevias(id);
        }else{
           document.getElementById('frm'+id).style.display='none'
            $('.aImg[data-valor="'+id+'"]')[0].src=sitio+"public/img/search.png";
      
        }
        
        }
*/        
       function cargarPrevias(idAsignatura){
           var table = document.getElementById("tab"+idAsignatura);
           table.innerHTML="";
              cnn = crearCnn();
   cnn.onreadystatechange=function () {

      if (cnn.readyState==4) {
          var arr = cnn.responseText.split(";");
           for (var i=arr.length-2; i >=0; i--) {
         var previa = eval("(" + arr[i] + ")");
         
         if (previa.id != "") {
          
           
            agregarFilaPrevia(previa,idAsignatura);
 
         }
           }
      }
   }
   var sitio= document.getElementById("urlBase").value;
   
   cnn.open("GET",sitio+"_ajax/"+idAsignatura,true);   
   cnn.send(null);
       }
       
       function agregarFilaPrevia(previa,idAsignatura){
             var table = document.getElementById("tab"+idAsignatura);
             var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    cell1.colSpan.innerHTML=3;
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
  } else return doc;

}