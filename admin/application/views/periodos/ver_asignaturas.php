<div id="contenido">
    <h1 style="text-align: center">Periodo <?php echo $periodo->mes."/".$periodo->anio; ?></h1>
    <?php
  //  echo form_open("", array("id" => "frm", "name" => "frm"));
    
    echo "<input type=\"hidden\" id=\"id_periodo\" value=\"{$periodo->id}\" />\n";
    
    ?>
  <table  class="tbl-acordeon centro ancho1" >
        <?php
        foreach ($planes as $plan) {
            
         echo "<tr  class=\"encabezado\" data-valor=\"$plan->id\"><td colspan=\"3\"><a data-valor=\"$plan->id\" href= #>" . $plan->nombre . "</a></td></tr>\n";
        for ($i = 1; $i <= $plan->anios; $i++) {

            echo "<tr  class=\"encabezado-anio\" data-compuesto=\"".$i.$plan->id."\" data-valor=\"".$plan->id."\"><td colspan=\"3\"><a data-valor=\"".$i.$plan->id."\" href= #>Año: " . $i . "</a></td></tr>\n";
        if (is_array($asignaturas)){
            foreach ($asignaturas as $asignatura) {
            
                if ($asignatura->anio == $i && $asignatura->id_plan_Num==$plan->id) {

                    $tipo = ($asignatura->teorica == 1)? "Teorica" : "Unidad de Proyecto";

                    $fila = "<tr class=\"fila $asignatura->anio$plan->id\" id=\"" . $asignatura->id_asignatura . "\">
                              <td>". $asignatura->nombre_asignatura_examen . "</td><td  class=\"gris\">$tipo</td>";
                    
                    $fila .="<td><a href=\"#\" class=\"aImg2\" 
                             data-valor=\"" . $asignatura->id_asignatura ."\" data-plan=\"" . $asignatura->id_plan_Num ."\" data-anio=\"" . $asignatura->anio. "\">
                             <img  src=\"" . base_url() . "public/img/search.png\"></a></td></tr>\n";
                    
                    echo $fila;
          

                }
            }
        }else{
             echo "<tr class=\"fila $i$plan->id\" id=\"$i\"><td><h4 class=\"txt-centro\">No hay asignaturas.</h4><td></tr>";
        }
        }
        }
        ?>
    </table>
<!--</form>-->
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
            <li><div>Asignaturas:</div>
                <ul id="lst-asignaturas">
                </ul>
            </li>
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

