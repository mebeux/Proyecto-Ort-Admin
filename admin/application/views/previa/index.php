<div id="contenido">
    <input type="hidden" id="urlBase" name="Base" value="<?php echo base_url(); ?>">
    <div class="aviso">Espere por favor mientras carga el informe, la tarea puede demorar algunos minutos...
        <img src="<?php echo base_url(); ?>public/img/ajax-loader-amarillo.gif" /></div>
    <div id="informe">
        <div class="panel">
            <div class="panel-titulo">Errores</div>
            <div class="panel-cuerpo">
                <table id="tbl-informe" class="ancho1">
                    <th>CI</th><th>Nombre</th><th>Error</th>
                </table>
            </div>
        </div>    
    </div>
</div>
</div>
