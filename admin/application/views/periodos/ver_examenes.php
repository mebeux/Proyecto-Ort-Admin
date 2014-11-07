<div id="contenido">
    <h1 style="text-align: center">Periodo <?php echo $periodo->mes."/".$periodo->anio; ?></h1>
    <?php
    echo form_open("", array("id" => "frm", "name" => "frm"));
    
    echo "<input type=\"hidden\" id=\"id_periodo\" value=\"{$periodo->id}\" />\n";
    
    ?>
    <table  class="tbl centro ancho1" >
        <?php
      //  for ($i = 1; $i <= 4; $i++) {
//revisar el for
         //   echo "<tr  class=\"encabezado\"><td colspan=\"3\"><a data-valor=\"$i\" href= #>Año: " . $i . "</a></td></tr>\n";
        
            foreach ($examenes as $examen) {
            
              //  if ($asignatura->anio_asignatura == $i) {

                    //$tipo = ($asignatura->teorica == 1)? "Teorica" : "Unidad de Proyecto";

                    $fila = "<tr class=\"fila $examen->nombre_plan\" id=\"" . $examen->nombre_asignatura . "\">
                              <td>". $examen->nombre_plan . "</td><td  class=\"gris\">$examen->nombre_asignatura</td>"
                            . "<td>". $examen->fecha_examen . "</td><td  class=\"gris\">$examen->categoria</td>";
                    
                    $fila .="<td><a href=\"#\" class=\"aImg\" 
                             data-valor=\"" . $examen->id . "\">
                             <img  src=\"" . base_url() . "public/img/search.png\"></a></td></tr>\n";
                    
                    echo $fila;
          

                }
           // }
     //   }
        ?>
    </table>
</form>
<input type="hidden" id="urlBase" value="<?php echo base_url(); ?>">
</div>

<div class="dialogo" id="dialogo">
    <a href=# class="cerrar">cerrar</a>
    <div class="header"></div>
    <div class="contenido">
        <ul class="lst-dos-filas">
            <li><span>Nombre: </span><span id="nombre_asignatura"></span></li>
        
            <li><span>Descripcion: </span><span id="descripcion"></span></li>
          
            <li><span>Minimo de aprobacion: </span><span id="min_aprobacion"></span></li>
             <li><p>&nbsp;</p></li>
              <li><div>Escala:</div><div></div>
            
                  <table id="lst-escala" >
                </table>
            </li>
            <li><p>&nbsp;</p></li>
            <li><div>Previas:</div>
                <ul id="lst-previas">
                </ul>
            </li>
        </ul>    
    </div>
</div>

