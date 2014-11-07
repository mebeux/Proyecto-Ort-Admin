<div id="contenido">
    <h1 style="text-align: center">Plan <?php echo $plan->get_nombre(); ?></h1>
    <?php
    echo form_open("", array("id" => "frm", "name" => "frm"));
    
    echo "<input type=\"hidden\" id=\"id_plan\" value=\"{$plan->id}\" />\n";
    
    ?>
    <table  class="tbl-acordeon centro ancho1" >
        <?php
        for ($i = 1; $i <= $plan->get_anios(); $i++) {

            echo "<tr  class=\"encabezado-anioplan\"><td colspan=\"3\"><a data-valor=\"$i\" href= #>Año: " . $i . "</a></td></tr>\n";
        
            foreach ($asignaturas as $asignatura) {
            
                if ($asignatura->anio_asignatura == $i) {

                    $tipo = ($asignatura->teorica == 1)? "Teorica" : "Unidad de Proyecto";

                    $fila = "<tr class=\"fila $asignatura->anio_asignatura\" id=\"" . $asignatura->id_asignatura . "\">
                              <td>". $asignatura->nombre . "</td><td  class=\"gris\">$tipo</td>";
                    
                    $fila .="<td><a href=\"#\" class=\"aImg\" 
                             data-valor=\"" . $asignatura->id_asignatura . "\">
                             <img  src=\"" . base_url() . "public/img/search.png\"></a></td></tr>\n";
                    
                    echo $fila;
          
                    /*
                    
                    echo "<tr class=\"formulario oculto\" data-anio=\"" . $i . "\" id=\"frm" . $asignatura->id_asignatura . "\>"
                    . "<td colspan=\"3\">";

                    echo "<div colspan=\"3\" class=\"form\">"
                    . "<p><label>Nombre:</label>"
                            . "<input type=\"text\" value=\"" . $asignatura->nombre . "\" name=\"nombre\" /></p>"
                    . "<p><label>Previas:</label></p>"
                    . "<table  id=\"tab" . $asignatura->id_asignatura . "\" class=\" ancho1\" >"
                    . "</table>"
                    . "<p><label></label><input type=\"button\" class=\"btn\" value=\"modificar\" /><input type=\"button\" class=\"btn-gris\" value=\"quitar\" /></p>"
                    . "</div>"
                    . "</td></tr>\n";

*/

                }
            }
        }
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

