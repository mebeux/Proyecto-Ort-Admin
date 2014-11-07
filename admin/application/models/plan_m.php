<?php


class plan_m extends CI_Model {
    
    var $nombre;
    var $id;
    var $anios;
    
    public function traer($id_plan) {
        
        $aux = new plan_m();
        
        $this->db->where("id_plan",$id_plan);
        $cmd  = $this->db->get("plan");
        $fila = $cmd->row_array();
        $aux->nombre = $fila["nombre_plan"];
        $aux->id = $fila["id_plan"];
         $aux->anios= $fila["anios"];
        return $aux;
       
    }
    
    public function get_nombre(){
        return $this->nombre;
    }
    
    public function get_id() {
        return $this->id;
    }
    public function get_anios(){
        return $this->anios;
    }
    
     public function get_todos() {
        $cmd  = $this->db->get("plan");
        $filas = $cmd->result();   
        return $filas;
       
    }
    
}