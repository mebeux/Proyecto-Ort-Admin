<div id="contenido">
    <h1>Planes</h1>
    <table class="tabla centro ancho2">
        <tr><th>plan</th><th>años</th><th>ver</th></tr>
        <?php
        foreach ($planes as $plan) {

            echo "<tr><td>" . $plan->nombre . "</td><td class=\"txt-centro\">" . $plan->anios . "</td>" .
            "<td class=\"txt-centro centro\">" . anchor("plan/ver/{$plan->id}",
                    "<img src=\"" . base_url() . "public/img/search.png\" />")."</td></tr>";
        }
        ?>
    </table>
    <input type="hidden" id="urlBase" name="Base" value="<?php echo base_url(); ?>">
    <input type="hidden" class="indi" id="ind" name="In" value="1">
</div>
</div>

<div id="mascara"></div>
