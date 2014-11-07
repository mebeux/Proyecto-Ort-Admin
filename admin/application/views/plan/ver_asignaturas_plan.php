<div id="contenido">
    <h1 style="text-align: center">Plan <?php echo $plan->get_nombre(); ?></h1>
   
        <?php 
        for ($i=1;$i<=$plan->get_anios();$i++){ 
           ?> <table  class="tabla centro ancho2">
        <?php  echo  "<tr><th style=\"text-align: center\">Año: ".$i."</th></tr>";
        ?>
           </table>
<table class="tabla centro ancho2">
    <tr><th style="text-align: center">Asignatura</th><th style="text-align: center">Tipo </th><th style="text-align: center">ver</th></tr>
<?php
foreach($lista_asignaturas as $asignatura){
    if($asignatura->anio_asignatura==$i){
$fila= "<tr><td class=\"txt-centro\">".$asignatura->nombre_asignatura."</td><td>";
if($asignatura->teorica==1){
    $fila.="Teorica";
}else{
    $fila.="Unidad de Proyecto";
}
$fila.= "</td><td><input type=\"button\" name=\"btn-modal\" class=\"btn\" value=\"ver\"></td></tr>";
echo $fila;
    }
}


        ?>
    </table>
        <?php
        
}
        ?>
  
  <input type="hidden" id="urlBase" name="Base" value="<?php echo base_url(); ?>">
</div>
</div>
<div class="dialogo" id="dialogo">

</div>
<div id="mascara"></div>
