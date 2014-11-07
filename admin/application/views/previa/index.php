<div id="contenido">
    <?php
    
        foreach($estudiantes as $estudiante) {
            echo ($estudiante->id." $estudiante->id_asignatura<br />");
        }
    
    ?>
</div>