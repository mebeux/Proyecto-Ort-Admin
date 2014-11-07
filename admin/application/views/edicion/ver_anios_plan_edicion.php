<div id="contenido">
    <h1 style="text-align: center">Ediciones del plan: <?php echo $plan->get_nombre(); ?></h1>
    <table class="tbl centro ancho2">
        <tr><th class="txt-centro centro">edicion</th><th>ver</th></tr>
        <?php
        foreach ($ediciones as $edicion) {

            echo "<tr class=\"fila\"><td class=\"txt-centro centro\" >" . $edicion->anio_lectivo . "</td>".
            "<td class=\"txt-centro centro\">" . anchor("edicion/ver/{$edicion->anio_lectivo}/{$plan->id}",
                    "<img src=\"" . base_url() . "public/img/search.png\" />")."</td></tr>";
        }
        ?>
    </table>
    <input type="hidden" id="urlBase" name="Base" value="<?php echo base_url(); ?>">
    <input type="hidden" class="indi" id="ind" name="In" value="1">
</div>
</div>

<div id="mascara"></div>