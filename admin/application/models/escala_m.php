<?php

class Escala_m extends CI_Model {
    
    public $id;
    public $notas = array();
    public $descripcion = "";
    public $min_aprobacion;
    
    public function get($id) {
        
        $sql = "SELECT *
                  FROM escala_notas n
                  INNER JOIN escala_notas_notas e
                  ON n.id_escala = e.id_escala
                  WHERE e.id_escala = ?
                  ORDER BY orden_nota";
        
        $param = array($id);
        
        $cmd = $this->db->query($sql,$param);
        
        if ($cmd->num_rows>0) {
        
            $tabla = $cmd->result();
            
            $salida = new Escala_m();
            
            foreach($tabla as $fila) {
                 if ($salida->descripcion =="") {
                     $salida->descripcion = $fila->descripcion_escala;
                     $salida->id = $id;
                     $salida->min_aprobacion = $fila->numero_min_aprobacion;
                 }
                 
                 $aux = array(  "id"=>$fila->id_nota,
                                "numero"=>$fila->numero_nota,
                                "concepto"=>$fila->concepto_nota,
                                "aprobado"=>$fila->aprobado_nota,
                                "estatus"=>$fila->estatus_nota,
                                "orden" => $fila->orden_nota,
                                "tipo_examen"=>$fila->tipo_examen_nota,
                      );
                 $salida->notas[] = $aux;
            }
            
            return $salida;
        }
        
        return NULL;
    }
    
}
