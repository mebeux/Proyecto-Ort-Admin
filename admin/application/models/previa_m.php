<?php

class previa_m extends CI_Model {
    
    var $id;
    var $previas = array();
    
    //put your code here
    private function get($id) {

        
        $sql = "SELECT id_previa FROM previas WHERE anio_lectivo=$anio AND id_curso = \"$id_curso\"";
        $tabla = $bd->listar($sql);

        if (count($tabla)==0) return;
        else {
            for ($i=0; $i<count($tabla); $i++) {
                $this->previas[] = $tabla[$i]["id_previa"]; 
                $this->obtener_previas($tabla[$i]["id_previa"],$anio,$bd);
            }
        }

}

    
}
