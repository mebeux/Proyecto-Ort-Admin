<div id="contenido">
    <h1 style="text-align: center">Crear Nuevo Periodo </h1>
    <?php
  echo form_open(base_url()."periodo/crear", array("id" => "frm", "name" => "frm"));
    
    echo "<input type=\"hidden\" id=\"id_periodo\" value=\"\" />\n";
      ?>
    <div class="form centro">
    <p><label>Año:</label><input type="number" value="<?php echo date("Y") ?>" min="1950" max="2030" name="anio" /></p>
	<p><label>Mes:</label><select name="meses">
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
 </select>
	<p><label>Unidad de Proyecto:</label><?php echo form_checkbox('up', true, false);?><br></p>
        <p><label>Practica Profesional:</label><?php echo form_checkbox('pp', true, false);?><br></p>
    <p><label></label><input  id="crear" type="submit" class="btn" value="crear" /></p>
    </div>
</form>
<input type="hidden" id="urlBase" value="<?php echo base_url(); ?>">
</div>



