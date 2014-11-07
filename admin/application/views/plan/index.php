<div id="contenido">
    <h1 style="text-align: center">Planes</h1>
   
       
<table class="tabla centro ancho2">
    <tr><th style="text-align: center">Plan</th><th style="text-align: center">Años </th><th style="text-align: center">ver</th></tr>
<?php
foreach($planes as $plan){
  
echo "<tr><td class=\"txt-centro\">".$plan->nombre_plan."</td><td>".$plan->anios." </td><td><input type=\"button\" name=\"".$plan->id_plan."\" class=\"btn\" value=\"ver\"></td></tr>";
    }

        ?>
    </table>
    <input type="hidden" id="urlBase" name="Base" value="<?php echo base_url(); ?>">
    <input type="hidden" class="indi" id="ind" name="In" value="1">
</div>
</div>

<div id="mascara"></div>
