$(document).ready(function() {
       iniciar();
   });
function iniciar() {
    $("#quitar_todos").click(CambiarCheckExamenes);
     $(".cb_examen").click(CambiarCheckTodos);
}

function CambiarCheckExamenes(){
    //alert($("#quitar_todos").checked);
    if(document.getElementById('quitar_todos').checked){
       var lista= $(".cb_examen");
       var cb
        for(cb in lista){
            lista[cb].checked=true;
        }
    }else{
       
        var lista= $(".cb_examen");
       var cb
        for(cb in lista){
            lista[cb].checked=false;
        }
    }
    
    
}
function CambiarCheckTodos(){
    //alert($("#quitar_todos").checked);
    document.getElementById('quitar_todos').checked=false;
     
        
  
    
    
}


