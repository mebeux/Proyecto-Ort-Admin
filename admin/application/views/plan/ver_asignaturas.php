<div id="contenido">
    <h1 style="text-align: center">Plan <?php echo $plan->get_nombre(); ?></h1>
    <?php
    echo form_open("", array("id" => "frm", "name" => "frm"));
    ?>
    <table  class="tabla centro ancho1" >
        <?php
        for ($i = 1; $i <= $plan->get_anios(); $i++) {

            //  echo "<tr><td colspan=\"3\" class=\"encabezado\">Año: " . $i . "<td colspan=\"3\" class=\"encabezado-expandir\"><a href=#><img id=\"img".$i."\"  src=\"".base_url()."public/img/masNaranja.png\"</a></td></td></tr>";
            echo "<tr><td colspan=\"3\" class=\"encabezado\">Año: " . $i . "</td><td colspan=\"3\" class=\"encabezado\"></td> <td colspan=\"1\" class=\"encabezado-expandir\"><a href=#><img id=\"img" . $i . "\"  src=\"" . base_url() . "public/img/masNaranja.png\"</a></td></tr>";
            // echo "<table class=\"tabla centro ancho2\">";
            /*
              <!--<tr><th style="text-align: center">Asignatura</th><th style="text-align: center"
              >Tipo </th><th style="text-align: center">ver</th></tr>-->
             */
            foreach ($asignaturas as $asignatura) {
                if ($asignatura->anio_asignatura == $i) {
                    $fila = "<tr class=\"asig" . $i . "\" id=\"" . $asignatura->id_asignatura . "\" style=\"display: none\"><td>" . $asignatura->nombre . "</td><td  class=\"gris\">";
                    if ($asignatura->teorica == 1) {
                        $fila.="Teorica";
                    } else {
                        $fila.="Unidad de Proyecto";
                    }
                    $fila.= "</td><td><a href=#><img class=\"aImg\" data-anio=\"" . $i . "\"  data-valor=\"" . $asignatura->id_asignatura . "\" src=\"" . base_url() . "public/img/search.png\"</a></td></tr>";
                    echo $fila;
                    /*  echo "<tr class=\"formulario\" id=\"frm".$asignatura->id_asignatura."\" style=\"display: none\">"
                      . "<td><p>Nombre: </p><input type=\"text\" id=\"valor1\" name=\"valor\" value=\"".$asignatura->nombre."\" size=\"30\"></td><td></td><td></td>"

                      . "</tr>"; */
                    echo "<tr class=\"formulario\" data-anio=\"" . $i . "\" id=\"frm" . $asignatura->id_asignatura . "\" style=\"display: none\">"
                    . "<td colspan=\"3\">";

                    echo "<div class=\"form\">"
                    . "<p><label>Nombre:</label>"
                            . "<input type=\"text\" value=\"" . $asignatura->nombre . "\" name=\"nombre\" /></p>"
                    . "<p><label>Previas:</label></p>"
                    . "<table id=\"tab" . $asignatura->id_asignatura . "\" class=\"centro ancho1\" >"
                    . "</table>"
                    . "<p><label></label><input type=\"button\" class=\"btn\" value=\"modificar\" /><input type=\"button\" class=\"btn-gris\" value=\"quitar\" /></p>"
                    . "</div>"
                    . "</td></tr>";

                    /*  echo     ."<table class=\" tabla ancho3\" >"
                      ."<tr><td>Nombre</td><td><input maxlength=\"35\" name=\"nombre\" size=\"20\" value=\"".$asignatura->nombre."\" type=\"text\"></td></tr>"
                      ."<tr><td>Apellido Paterno</td><td><input maxlength=\"35\" name=\"apellidoP\" size=\"20\" type=\"text\"></td></tr>"
                      ."<tr><td>Apellido Materno</td><td><input maxlength=\"35\" name=\"apellidoM\" size=\"20\" type=\"text\"></td></tr>"
                      ."<tr><td>E-mail</td><td><input maxlength=\"35\" name=\"email\" size=\"20\" type=\"text\"></td></tr>"
                      ."<tr><td></td><td class=\"centro\"><input class=\"btn\" name=\"modificar\" title=\"modificar\" type=\"button\" value=\"Modificar\"><input class=\"btn\" name=\"quitar\" title=\"quitar\" type=\"button\" value=\"Quitar\"></td></tr>"
                      ."</table>"
                      ."</td><td></td><td></td></tr>" ; */
                }
            }
        }
        ?>
    </table>
</form>
<input type="hidden" id="urlBase" name="Base" value="<?php echo base_url(); ?>">
</div>
</div>
<div class="dialogo" id="dialogo">

</div>
<div id="mascara"></div>
