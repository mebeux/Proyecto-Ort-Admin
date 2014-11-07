<div id="contenido">
    <h1 style="text-align: center">Editar Periodo Actual</h1>
    <?php
    echo form_open(base_url() . "periodo/editar", array("id" => "frm", "name" => "frm"));

    echo "<input type=\"hidden\" id=\"id_periodo\" value=\"\" />\n";
    ?>
    <div class="form centro">
        <p><label>Año:</label><input type="number" value="<?php echo $periodo->anio ?>" min="1950" max="2030" name="anio" /></p>
        <p><label>Mes:</label><select name="meses">
                <?php
                if ($periodo->mes == 1) {
                    ?>
                    <option value="01" selected >Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>  
                    <?php
                }
                if ($periodo->mes == 2) {
                    ?>
                    <option value="01"  >Enero</option>
                    <option value="02" selected>Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>  
                    <?php
                }
                if ($periodo->mes == 3) {
                    ?>
                    <option value="01"  >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03" selected>Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>  
                    <?php
                }
                if ($periodo->mes == 4) {
                    ?>
                    <option value="01"  >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04" selected>Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>  
                    <?php
                }
                if ($periodo->mes == 5) {
                    ?>
                    <option value="01"  >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05" selected>Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>  
                    <?php
                }
                if ($periodo->mes == 6) {
                    ?>
                    <option value="01"  >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06" selected>Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>  
                    <?php
                }
                if ($periodo->mes == 7) {
                    ?>
                    <option value="01"  >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07" selected>Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>  
                    <?php
                }
                if ($periodo->mes == 8) {
                    ?>
                    <option value="01"  >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08" selected>Agosto</option>
                    <option value="09">Setiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>  
                    <?php
                }
                if ($periodo->mes == 9) {
                    ?>
                    <option value="01"  >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09" selected>Setiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>  
                    <?php
                }
                if ($periodo->mes == 10) {
                    ?>
                    <option value="01"  >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setiembre</option>
                    <option value="10" selected>Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>  
                    <?php
                }
                if ($periodo->mes == 11) {
                    ?>
                    <option value="01"  >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11" selected>Noviembre</option>
                    <option value="12">Diciembre</option>  
                    <?php
                }
                if ($periodo->mes == 12) {
                    ?>
                    <option value="01"  >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Setiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12" selected>Diciembre</option>  
                    <?php
                }
                ?>

            </select>
            <?php
            if ($periodo->unidad_proyecto == 1) {
                ?>
            <p><label>Unidad de Proyecto:</label><?php echo form_checkbox('up', true, true); ?><br></p>
            <?php
        } else {
            ?>
            <p><label>Unidad de Proyecto:</label><?php echo form_checkbox('up', true, false); ?><br></p>
            <?php
        }
        ?>

        <?php
        if ($periodo->practica_profesional == 1) {
            ?>
            <p><label>Unidad de Proyecto:</label><?php echo form_checkbox('pp', true, true); ?><br></p>
            <?php
        } else {
            ?>
            <p><label>Unidad de Proyecto:</label><?php echo form_checkbox('pp', true, false); ?><br></p>
            <?php
        }
          $data = array(
                        'name' => 'quitar_todos',
                        'id' => 'quitar_todos',
                        'value' => true,
                        'checked' => false
                    );
        ?>
        <p><label>Quitar todos los examenes:</label><?php echo form_checkbox($data); ?><br></p>
        <p><br></p>
    </div>
    <div class="form centro">
        <p><label>Examenes:</label><br></p>
        <table  class="tbl centro ancho1" >

            <?php
            //  for ($i = 1; $i <= 4; $i++) {
//revisar el for
            //   echo "<tr  class=\"encabezado\"><td colspan=\"3\"><a data-valor=\"$i\" href= #>Año: " . $i . "</a></td></tr>\n";
            $i=0;
            if (count($examenes)) {
                $i=1;
                foreach ($examenes as $examen) {

                    //  if ($asignatura->anio_asignatura == $i) {
                    //$tipo = ($asignatura->teorica == 1)? "Teorica" : "Unidad de Proyecto";

                    $fila = "<tr class=\"fila $examen->nombre_plan\" id=\"" . $examen->nombre_asignatura . "\">
                              <td>" . $examen->nombre_plan . "</td><td  class=\"gris\">$examen->nombre_asignatura</td>"
                            . "<td>" . $examen->fecha_examen . "</td><td  class=\"gris\">$examen->categoria</td>";

                    $fila .="<td><a href=\"#\" class=\"aImg2\" 
                             data-valor=\"" . $examen->id . "\">
                             <img  src=\"" . base_url() . "public/img/search.png\"></a></td>";
                    $data = array(
                        'name' => 'eliminar'.$i,
                        'id' => 'eliminar',
                        'value' => $examen->id,
                        'checked' => false,
                        'class' => 'cb_examen',
                    );
                    $fila.="<td>" . form_checkbox($data) . "</td></tr>\n";
                    echo $fila;
                    $i++;
                }
                
            } else {
                echo "<h4 class=\"txt-centro\">No hay examenes.</h4>";
            }
            echo "<input type=\"hidden\" name=\"cantExam\" id=\"cantExam\" value=\"$i\" />\n";
            echo "<input type=\"hidden\" name=\"id_viejo\" id=\"id_viejo\" value=\"$periodo->id\" />\n";
            // }
            //   }
            ?>
        </table>
        <div class="form centro">
            <p><br></p>
            <p><label></label><input  id="crear" type="submit" class="btn" value="editar" /></p>
        </div>
    </div>   
</form>
<input type="hidden" id="urlBase" value="<?php echo base_url(); ?>">
</div>
<div class="dialogo" id="dialogo">
    <a href=# class="cerrar">cerrar</a>
    <div class="header"></div>
    <div class="contenido">
        <ul class="lst-dos-filas">
            <li><span>Nombre: </span><span id="nombre_asignatura"></span></li>
            <li><p>&nbsp;</p></li>
            <li><span>Fecha: </span><span id="fecha"></span></li>
            <li><p>&nbsp;</p></li>
            <li><span>Categoria: </span><span id="categoria"></span></li>
            <li><p>&nbsp;</p></li>
            <li><div>Docentes:</div>
                <ul id="lst-docentes">
                </ul>
            </li>
        </ul>    
    </div>
</div>



