
$(document).ready(function() {
   
   
    for(var i=0;i<5;i++){
        $("#img"+i).click(expandir);
    }
    $(".aImg").click(muestraFrm);
});


function expandir(e) {

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
        
}

function muestraFrm(e) {

	e.preventDefault();
        var sitio=document.getElementById('urlBase').value;
         var id=$(this).attr("data-valor");
         if( document.getElementById('frm'+id).style.display=='none'){
               document.getElementById('frm'+id).style.display='';
                $('.aImg[data-valor="'+id+'"]')[0].src=sitio+"public/img/veo.png";
               cargarPrevias(id);
        }else{
           document.getElementById('frm'+id).style.display='none'
            $('.aImg[data-valor="'+id+'"]')[0].src=sitio+"public/img/search.png";
      
        }
        
        }
        
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
   
   cnn.open("GET",sitio+"asignatura/obtener_previas_ajax/"+idAsignatura,true);   
   cnn.send(null);
       }
       
       function agregarFilaPrevia(previa,idAsignatura){
             var table = document.getElementById("tab"+idAsignatura);
             var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
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