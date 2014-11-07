<div id="contenido">
    <h1>Periodos</h1>
    <table class="tbl centro ancho2">
        <tr class="encab-lst-desp"><th>mes</th><th>año</th><th>unidad de proyecto</th><th>actual</th><th>ver</th></tr>
        <?php
          $fila="";
        foreach ($periodos as $periodo) {
           
            $fila.= " <tr class=\"fila\" style=\"display: table-row;\" ><td class=\"txt-centro\">" . substr($periodo->periodo, 4) . "</td>"
               . "<td class=\"txt-centro\">" . $periodo->anio . "</td>" 
               . "<td class=\"txt-centro\">";
               if($periodo->unidad_proyecto==1){
                   $fila.="SI";
               }else{
                   $fila.="NO";
               }
                  $fila.= "</td>" 
                . "<td class=\"txt-centro\">";
               if($periodo->actual==1){
                   $fila.="SI";
               }else{
                   $fila.="NO";
               }
                  $fila.= "</td>" 
               . "<td class=\"txt-centro centro\">" . anchor("periodo/ver/{$periodo->periodo}",
                    "<img src=\"" . base_url() . "public/img/search.png\" />")."</td></tr>";
                 
        }
         echo $fila;
        ?>
    </table>
    <input type="hidden" id="urlBase" name="Base" value="<?php echo base_url(); ?>">
    <input type="hidden" class="indi" id="ind" name="In" value="1">
</div>
</div>

<div id="mascara"></div>
